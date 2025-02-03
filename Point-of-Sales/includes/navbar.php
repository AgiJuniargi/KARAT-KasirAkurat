<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<nav class="navbar navbar-expand-lg">
  <div class="container">

    <!-- Navbar Text -->
    <a class="navbar-brand fw-bold mt-3" href="#">
        KARAT
    </a>

    <!-- Navbar Items -->
    <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?> fw-bold" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(isset($_SESSION['loggedIn'])) : ?>
        <li class="nav-item">
          <a class="btn btn-danger fw-bold" href="logout.php">Logout</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link <?= $page == 'login.php' ? 'active' : ''; ?> fw-bold" href="login.php">Login</a>
        </li>
        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>