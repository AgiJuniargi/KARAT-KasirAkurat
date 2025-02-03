<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark shadow" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">FITUR UTAMA</div>

                <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link <?= $page == 'order-create.php' ? 'active' : ''; ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list fa-lg"> </i></div>
                    Buat Pesanan
                </a>
                <a class="nav-link <?= $page == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-clock-rotate-left"></i></div>
                    Riwayat Transaksi
                </a>



                <div class="sb-sidenav-menu-heading">TOKO</div>

                <a class="nav-link collapsed" href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                    Kategori
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse 
                <?= $page == 'categories-create.php' ? 'show' : ''; ?>
                <?= $page == 'categories.php' ? 'show' : ''; ?>
                " id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'categories-create.php' ? 'active' : ''; ?>" href="categories-create.php"><i class="fa-solid fa-plus me-2"></i>Tambah Kategori</a>
                        <a class="nav-link <?= $page == 'categories.php' ? 'active' : ''; ?>" href="categories.php"><i class="fa-solid fa-list me-2"></i>List Kategori</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                    Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse 
                <?= $page == 'products-create.php' ? 'show' : ''; ?>
                <?= $page == 'products.php' ? 'show' : ''; ?>
                " id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'products-create.php' ? 'active' : ''; ?>" href="products-create.php"><i class="fa-solid fa-plus me-2"></i>Tambah Produk</a>
                        <a class="nav-link <?= $page == 'products.php' ? 'active' : ''; ?>" href="products.php"><i class="fa-solid fa-list me-2"></i>List Produk</a>
                    </nav>
                </div>



                <div class="sb-sidenav-menu-heading">PENGGUNA</div>

                <a class="nav-link collapsed" href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseAdmins"
                    aria-expanded="false" aria-controls="collapseAdmins">

                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Admin
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse
                <?= $page == 'admins-create.php' ? 'show' : ''; ?>
                <?= $page == 'admins.php' ? 'show' : ''; ?>
                    " id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'admins-create.php' ? 'active' : ''; ?>" href="admins-create.php"><i class="fa-solid fa-plus me-2"></i>Tambah Admin</a>
                        <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php"><i class="fa-solid fa-list me-2"></i>List Admin</a>
                    </nav>
                </div>

            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>