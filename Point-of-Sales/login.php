<?php

require 'config/function.php';

if (isset($_SESSION['loggedIn'])) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
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
            background-image: url('includes/bg-login.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.php'); ?>
        <div class="py-5">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-lg border-0">
                            <?php alertMessages(); ?>
                            <div class="p-4">
                                <h4 class="text-center mb-3 fw-bold" style="color: #9BBA3B;">SIGN IN</h4>
                                <hr style="height: 2px; background-color: #000000;">
                                <form action="login-code.php" method="POST">
                                    <div class="mb-3">
                                        <label class="fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control" style="background-color: #D9D9D9;" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control" style="background-color: #D9D9D9;" required />
                                    </div>

                                    <hr class="mt-2" style="height: 2px; background-color: #000000;">
                                    <div class="my-3 text-center">
                                        <button type="submit" name="loginBtn" class="btn btn-dark fw-bold w-25 mt-2">
                                            Sign In
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>