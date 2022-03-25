<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <!-- Dashboard -->
            <a class="nav-link <?php echo $screen == "dashboard" ? "active" : "";?>" href="dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <!-- Billing -->
            <a class="nav-link collapsed <?php echo $screen == "billing" ? "active" : "";?>" href="billing" data-toggle="collapse" data-target="#billing" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                Billing
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="billing" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="sales">Sales</a>
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="purchase">Purchase</a>
                </nav>
            </div>
            <!-- Configurations -->
            <?php if(isset($_SESSION['AT_SESSION']) && $_SESSION['AT_SESSION']['TYPE'] < 2) : ?>
                <a class="nav-link collapsed <?php echo $screen == "configurations" ? "active" : "";?>" href="configurations" data-toggle="collapse" data-target="#configurations" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                    Configurations
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="configurations" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="taxes">Taxes</a>
                    </nav>
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="keys">Key Combinations</a>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>            