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
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><?= $namaapp; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="masuk.php">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="keluar.php">Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="mutasimsk.php">Mutasi Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="mutasiklr.php">Mutasi Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="sk.php">Surat Keputusan (SK)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 class=" my-4 text-center">APLIKASI ARSIP SURAT</h1>
        <h2 class="text-center"><?= $instansi; ?></h2>
        <img class="my-4 mb-4 mx-auto d-block" width="400" src="asset/logo.png">
        <p class="text-center">Alamat anda disini sampe ke tingkat kelurahan<br>disini kecamatan dan kabuaten<br>Sumatera Utara - 21151</p>
        <div class="my-5 bg-body-tertiary">
            <footer class="text-center text-lg-start text-dark">
                <div class="text-center p-3">
                    Developed by:
                    <a class="text-dark" href="https://tarigan.web.id/">Tarigan Hosting</a><i><small> - <?= $versi; ?></small></i>
                </div>
            </footer>
        </div>
    </div>
    <script src="bootstrap\js\bootstrap.bundle.js"></script>
</body>

</html>