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
    <title>User Login | The Daily Mix</title>
    <link rel="stylesheet" href="dist/css/vendors.min.css" />
    <link rel="stylesheet" href="dist/css/style.css" />
</head>

<body>
    <section class="login-wrapper">
        <div class="login-box">
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
                        <h3>Login to continue your blogging journey!</h3>
                        <form id="user-login-form">
                            <label for="identifier">Username or Email:</label>
                            <input type="text" name="identifier" id="identifier" required placeholder="Enter your username or email" />
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required placeholder="Password" />
                            <button type="submit" class="login-register-btn">Login</button>
                        </form>
                        <div class="register-link">
                            <p>Not registered yet? <a href="user-registeration">Click here to register</a></p>
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