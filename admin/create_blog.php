<?php
session_start();
include("../includes/database.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create New Blog | The Daily Mix</title>
    <link rel="icon" type="image/png" href="../dist/img/favicon.ico" />
    <link rel="stylesheet" href="../dist/css/vendors.min.css" />
    <link rel="stylesheet" href="../dist/css/style.css" />
</head>

<body>
    <?php include("../pages/dashboard_nav.php") ?>
    <div class="dashboard">
        <?php include("../pages/dashboard_sidebar.php") ?>
        <main class="new-blog-content">
            <div class="header">
                <h1>Create a New Blog</h1>
            </div>
            <div class="form-container">
                <form class="create-blog-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" id="subtitle" name="subtitle">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" rows="8"></textarea>
                    </div>

                    <button type="submit" class="submit-btn action-btn create-blog-btn">Publish Blog</button>
                </form>
            </div>
        </main>
    </div>
    <script src="../dist/tinymce-text-editor/tinymce.min.js"></script>
    <script src="../dist/js/editor.js"></script>
    <script type="text/javascript" src="../dist/js/vendors.min.js"></script>
    <script type="text/javascript" src="../dist/js/script.min.js"></script>
</body>

</html>