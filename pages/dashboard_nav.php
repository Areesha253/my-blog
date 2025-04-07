<nav class="navbar dashboard-navbar fixed-top">
    <div class="container">
        <div class="navbar-logo-with-burger">
            <a class="navbar-brand navbar-logo" href="../index">The Daily Mix</a>
            <div class="username-with-icon-dashboard">
                <i class="fa-solid fa-user user-icon"></i>
                <span class="logged-in-username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <button class="sidebar-toggle navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#sidebarCollapse"
                    aria-controls="sidebarCollapse"
                    aria-expanded="true"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars menu-icon navbar-toggler-icon"></i>
                </button>
            </div>
        </div>
    </div>
</nav>