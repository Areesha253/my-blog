<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Mix - A Blend of Ideas, Trends, and Stories</title>
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
                    <div class="col-lg-8 col-md-10">
                        <h1 class="main-heading">Daily Mix</h1>
                        <p class="sub-heading">A Blog Platform for Ideas, Insights, and Inspiration</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-posts-section" id="blog-posts-section" data-aos="fade-right">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="post-cards">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
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