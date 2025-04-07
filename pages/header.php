<?php
session_start(); ?>
<nav class="navbar navbar-expand-md fixed-top my-navbar">
    <div class="container">
        <a class="navbar-brand navbar-logo" href="index">The Daily Mix</a>
        <button class="navbar-toggler navbar-menu-burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            MENU
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto navbar-ul">
                <li class="nav-item">
                    <form class="search-form" id="search-form">
                        <input class="search-bar query" type="text" name="query" id="query" placeholder="Search blogs..." required />
                        <button type="submit" class="search-btn"><i class="fas fa-search search-icon"></i></button>
                        <ul class="suggestions"></ul>
                    </form>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item"><a class="navbar-link" href="index">HOME</a>
                    <li class="nav-item"><a class="navbar-link" href="admin/dashboard">DASHBOARD</a>
                    <li class="nav-item"><a class="navbar-link d-sm-block d-md-none d-lg-none" href="search-blog">SEARCH BLOG</a>
                    <li class="nav-item"><a class="navbar-link" href="includes/logout">LOGOUT</a>
                    <?php else: ?>
                    <li class="nav-item"><a class="navbar-link" href="index">HOME</a>
                    <li class="nav-item"><a class="navbar-link" href="login">LOGIN</a></li>
                    <li class="nav-item"><a class="navbar-link" href="user-registeration">SIGN UP</a></li>
                    <li class="nav-item"><a class="navbar-link d-sm-block d-md-none d-lg-none" href="search-blog">SEARCH BLOG</a>
                    <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>