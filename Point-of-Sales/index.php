<?php
require 'config/function.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KARAT : Kasir Akurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('includes/bg-landing.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.php'); ?>

        <div class="container py-2">
            <div class="row align-items-center">
                <!-- Bagian Kiri -->
                <div class="col-md-6">
                    <h2 class="fw-semibold" style="color: #9BBA3B;">Halo, selamat datang</h2>
                    <h1 class="fw-bold">Gunakan KARAT untuk meningkatkan kualitas UMKM anda!</h1>
                    <p style="font-size: large;">KARAT merupakan sebuah aplikasi web yang <br> dirancang untuk membantu anda mengelola <br> produk, penjualan dan mencatat transaksi <br> dengan mudah.</p>
                    <div class="d-flex gap-3">
                        <a href="https://wa.me/+6281912667147" class="btn btn-dark fw-bold w-25" target="_blank">Daftar</a>
                        <a href="login.php" class="btn btn-outline-dark fw-bold w-25">Login</a>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="col-md-6 d-flex justify-content-center mt-4 mt-md-0">
                    <img src="includes/kanan-2.png" alt="Ilustrasi UMKM" class="img-fluid;" width="372px" height="494px">
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>