<?php
include "database.php";
session_start();

header('Content-Type: application/json; charset=utf-8');
function sanitize_input($conn, $data)
{
    return mysqli_real_escape_string($conn, trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $method_name = $_GET['name'];
    if ($method_name === 'get_all' && !isset($_GET['id'])) {
        $scope = $_GET['scope'] ?? 'all';

        if ($scope === 'user') {
            if (!isset($_SESSION['username'])) {
                echo json_encode(["status" => "error", "message" => "User not authenticated."]);
                exit();
            }
            $created_by = $_SESSION['username'];
            $stmt = $conn->prepare("SELECT * FROM blogs WHERE created_by = ? ORDER BY created_at DESC");
            $stmt->bind_param("s", $created_by);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();
        }

        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }

        if (!empty($blogs)) {
            echo json_encode(["status" => "success", "message" => "Blogs loaded successfully", "blogs" => $blogs]);
        } else {
            echo json_encode(["status" => "empty", "message" => "No Blogs Found"]);
        }

        $stmt->close();
    }
    if ($method_name === 'get_single_blog' && isset($_GET['id'])) {
        $postId = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["error" => "No blog post found"]);
        }

        $stmt->close();
    }
    if ($method_name === 'search_blog') {
        $query = $_GET["query"] ?? '';
        if (empty(trim($query))) {
            echo json_encode([]);
            exit();
        }

        $searchQuery = "%" . $query . "%";
        $stmt = $conn->prepare("SELECT id, title FROM blogs WHERE title LIKE ?");
        $stmt->bind_param("s", $searchQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }

        echo json_encode($blogs);
        $stmt->close();
        exit();
    }
    $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $method_name = $_POST['name'];

    if ($method_name === 'user_register') {
        $username = sanitize_input($conn, $_POST['username'] ?? '');
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = sanitize_input($conn, $_POST['password'] ?? '');

        if (!$email || empty($username) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "All fields are required!"]);
            exit();
        }

        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            echo json_encode(["status" => "error", "message" => "Username or Email already exists!"]);
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Something went wrong, try again!"]);
        }
    }

    if ($method_name === 'user_login') {
        $identifier = sanitize_input($conn, $_POST['identifier'] ?? '');
        $password = sanitize_input($conn, $_POST['password'] ?? '');

        if (empty($identifier) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "All fields are required!"]);
            exit();
        }

        $sql = filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? "SELECT * FROM users WHERE email = ?"
            : "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $identifier);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];

                $login_time = date("Y-m-d H:i:s");
                $hashed_password = $row['password'];

                $log_sql = "INSERT INTO logins (identifier, password, login_time) VALUES (?, ?, ?)";
                $log_stmt = mysqli_prepare($conn, $log_sql);
                mysqli_stmt_bind_param($log_stmt, "sss", $identifier, $hashed_password, $login_time);
                mysqli_stmt_execute($log_stmt);

                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Invalid Credentials!"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "User not found!"]);
        }
    }
    if ($method_name === 'create_blog') {
        $title = sanitize_input($conn, $_POST['title'] ?? '');
        $subtitle = sanitize_input($conn, $_POST['subtitle'] ?? '');
        $author = sanitize_input($conn, $_POST['author'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $created_by = $_SESSION['username'] ?? null;

        if (empty($title) || empty($author) || empty($content) || !$created_by) {
            echo json_encode(["status" => "error", "message" => "All required fields must be filled."]);
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO blogs (title, subtitle, author, content, created_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $subtitle, $author, $content, $created_by);

        echo json_encode(
            $stmt->execute()
                ? ["status" => "success", "message" => "Blog created successfully"]
                : ["status" => "error", "message" => "Database error"]
        );

        $stmt->close();
        $conn->close();
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    $blog_id = intval($inputData['id']);

    $title = sanitize_input($conn, $inputData['title'] ?? '');
    $subtitle = sanitize_input($conn, $inputData['subtitle'] ?? '');
    $author = sanitize_input($conn, $inputData['author'] ?? '');
    $content = $inputData['content'] ?? '';

    $query = "UPDATE blogs SET title=?, subtitle=?, author=?, content=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $title, $subtitle, $author, $content, $blog_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Blog updated successfully"], JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update blog", "error" => $stmt->error]);
        error_log("MySQL Execution Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $input = json_decode(file_get_contents("php://input"), true);
    $blog_id = intval($input['id']);
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $blog_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Blog deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting blog."]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
