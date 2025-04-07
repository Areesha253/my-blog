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
    <title>Dashboard | The Daily Mix</title>
    <link rel="icon" type="image/png" href="../dist/img/favicon.ico" />
    <link rel="stylesheet" href="../dist/css/vendors.min.css" />
    <link rel="stylesheet" href="../dist/css/style.css" />
</head>

<body>
    <?php include("../pages/dashboard_nav.php") ?>
    <div class="dashboard">
        <?php include("../pages/dashboard_sidebar.php") ?>
        <div class="blog-wrapper">
            <div class="container">
                <div class="blog-content">
                    <div class="header">
                        <h1>Dashboard</h1>
                        <a href="create_blog" class="add-btn">+ Create New Blog</a>
                    </div>
                    <div class="blog-list">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-blog-content">
                <div class="header">
                    <h1>Edit Blog</h1>
                    <button class="close-edit">✖</button>
                </div>
                <div class="form-container">
                    <form id="edit-blog-form">
                        <input type="hidden" id="edit-id" name="id" />
                        <div class="form-group">
                            <label for="edit-title">Title</label>
                            <input class="edit-blog-data" type="text" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-subtitle">Subtitle</label>
                            <input class="edit-blog-data" type="text" id="subtitle" name="subtitle">
                        </div>

                        <div class="form-group">
                            <label for="edit-author">Author</label>
                            <input class="edit-blog-data" type="text" id="author" name="author" required>
                        </div>

                        <div class="form-group">
                            <label for="edit-content">Content</label>
                            <textarea class="edit-blog-data" id="content" name="content" rows="8" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn edit-blog-btn action-btn">Update Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/tinymce-text-editor/tinymce.min.js"></script>
    <script src="../dist/js/editor.js"></script>
    <script type="text/javascript" src="../dist/js/vendors.min.js"></script>
    <script type="text/javascript" src="../dist/js/script.min.js"></script>
</body>

</html>