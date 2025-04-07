<?php
session_start();
include("database.php");
header("Content-Type: application/json");

try {
    if (!isset($_FILES["file"])) {
        throw new Exception("No file uploaded.");
    }

    $file = $_FILES["file"];
    $filename = time() . "_" . basename($file["name"]);
    $uploadDir = "../uploads/";
    $filePath = $uploadDir . $filename;

    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!in_array($file["type"], $allowedTypes)) {
        throw new Exception("Invalid file type. Only JPG, PNG, and GIF are allowed.");
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    if (!move_uploaded_file($file["tmp_name"], $filePath)) {
        throw new Exception("Upload failed. Could not save file.");
    }

    $imageUrl = "http://localhost/my-blog/uploads/" . $filename;
    echo json_encode(["status" => "success", "url" => $imageUrl]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
