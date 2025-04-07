<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: admin/dashboard");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Registration | The Daily Mix</title>
    <link rel="stylesheet" href="dist/css/vendors.min.css" />
    <link rel="stylesheet" href="dist/css/style.css" />
</head>

<body>
    <section class="registeration-wrapper login-wrapper">
        <div class="registeration-box login-box">
            <div class="container">
                <a href="index" class="back-btn-with-icon">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="go-back-btn">Go to homepage</span>
                </a>
                <div class="row justify-content-center align-items-center gy-4">
                    <div class="col-12 col-lg-6">
                        <img src="dist/img/draw2.png" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-12 col-lg-6">
                        <h3>Not registered yet? Join us and start sharing your stories!</h3>
                        <form id="user-registeration-form">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="register-username" required placeholder="Username">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="register-email" required placeholder="Enter your Email" />
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="register-password" required placeholder="Password" />
                            <button type="submit" class="login-register-btn">Register</button>
                        </form>
                        <div class="login-link register-link">
                            <p>Already registered? <a href="login">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="dist/js/vendors.min.js"></script>
    <script type="module" src="dist/js/script.min.js"></script>
</body>

</html>