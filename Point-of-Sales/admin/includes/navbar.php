<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 ms-4 me-lg-0" id="sidebarToggle" href="#!"><b><i class="fas fa-bars fa-lg" style="color: #FFFFFF;"></i></b></button>
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#"><b>KARAT : Kasir Akurat</b></a>

    <!-- Navbar Search-->
    <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form> -->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                <?= $_SESSION['loggedInUser']['name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-gear me-2"></i>Pengaturan</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>