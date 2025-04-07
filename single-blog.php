<?php
include('includes/database.php');
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pageTitle = "Blog Not Found";
if ($blog_id > 0) {
    $stmt = $conn->prepare("SELECT title FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($blog = $result->fetch_assoc()) {
        $pageTitle = htmlspecialchars($blog['title']);
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?> | The Daily Mix</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico" />
    <link rel="stylesheet" href="dist/css/vendors.min.css" />
    <link rel="stylesheet" href="dist/css/style.css" />
</head>

<body>
    <?php include('pages/header.php'); ?>
    <section class="hero-section" id="hero-section">
        <div class="hero-section-wrapper" data-aos="fade-down">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center text-center">
                    <div class="col-md-10 col-lg-6">
                        <div class="single-blog">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="article" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-8 col-md-10">
                    <div class="content-body">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('pages/footer.php'); ?>

    <script type="text/javascript" src="dist/js/vendors.min.js"></script>
    <script type="text/javascript" src="dist/js/script.min.js"></script>
</body>

</html>