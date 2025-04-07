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
        <div class="hero-section-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 col-md-10">
                        <h1 class="main-heading text-start mb-4">Looking for inspiration? Start typing...</h1>
                        <form class="search-form" id="search-form">
                            <input class="search-bar query" type="text" name="query" id="query" placeholder="Search blogs..." required />
                            <button type="submit" class="search-btn"><i class="fas fa-search search-icon"></i></button>
                            <ul class="suggestions"></ul>
                        </form>
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