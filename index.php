<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Dashboard Arsip</title>
</head>

<body>
    <div class="container">
        <?php include 'asset/header.php' ?>
        <h1 class=" my-4 text-center">APLIKASI ARSIP SURAT</h1>
        <h2 class="text-center"><?= $instansi; ?></h2>
        <img class="my-4 mb-4 mx-auto d-block" width="400" src="asset/logo.png">
        <p class="text-center">Alamat anda disini sampe ke tingkat kelurahan<br>disini kecamatan dan kabuaten<br>Sumatera Utara - 21151</p>
        <div class="my-5 bg-body-tertiary">
            <?php include 'asset/footer.php' ?>
        </div>
    </div>
    <script src="bootstrap\js\bootstrap.bundle.js"></script>
</body>

</html>