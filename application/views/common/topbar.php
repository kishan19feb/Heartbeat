<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard">Sri Shilpa Jewellers</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Search on Navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <font color="#E1E1E1"><?php echo isset($_SESSION['AT_SESSION']) ? $_SESSION['AT_SESSION']['NAME'] : EMPTY_STRING; ?></font>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="settings">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logout();">Logout</a>
            </div>
        </li>
    </ul>
</nav>