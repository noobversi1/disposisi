<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
$jumlahdataperhalaman = 20;
$jumlahdata = count(query("SELECT * FROM mutasimsk"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$halamantengah = ceil($jumlahhalaman / 2);

$mutasimsk = query("SELECT * FROM mutasimsk ORDER BY id DESC");

if (isset($_POST["cari"])) {
    $masuk = carimutasimsk($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Arsip Surat Mutasi Masuk</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
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
        <a href="tambahmutasimsk.php" class="my-4 mb-4 btn btn-success">Tambah Surat Mutasi Masuk</a>
        <form class="row g-3" action="" method="post">
            <div class="col-auto">
                <input class="form-control" type="text" name="keyword" autofocus placeholder="Masukkan Keyword ..." autocomplete="off" id="keyword">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary mb-3" type="submit" name="cari">Cari</button>
            </div>
        </form>
        <nav aria-label="...">
            <ul class="pagination">
                <?php if ($jumlahhalaman > 10) : ?>
                    <?php if ($halamanaktif > 1) : ?>
                        <li class="page-item">
                            <a href="?halaman=1" class="page-link"> First </a>
                        </li>
                        <li class="page-item">
                            <a href="?halaman=<?= $halamanaktif - 1; ?>" class="page-link"> &laquo; </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                        <?php if ($i == $halamanaktif) : ?>
                            <li class="page-item active">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php for ($i = $jumlahhalaman - 2; $i <= $jumlahhalaman; $i++) : ?>
                        <?php if ($i == $halamanaktif) : ?>
                            <li class="page-item active">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($halamanaktif < $jumlahhalaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanaktif + 1; ?>"> &raquo; </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $jumlahhalaman; ?>"> Last </a>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($halamanaktif > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanaktif - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
                        <?php if ($i == $halamanaktif) : ?>
                            <li class="page-item active">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($halamanaktif < $jumlahhalaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanaktif + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
        <p><small>Halaman : <?= $halamanaktif; ?> dari <?= $jumlahhalaman; ?> halaman</small></p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Asal Sekolah</th>
                    <th scope="col">NSM/NPSN</th>
                    <th scope="col">No. Surat Mutasi</th>
                    <th scope="col">Tanggal Mutasi</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($mutasimsk as $row) : ?>
                <tbody>
                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td><?= $row["nisn"]; ?></td>
                        <td><?= $row["nm_siswa"]; ?></td>
                        <td><?= $row["asal"]; ?></td>
                        <td><?= $row["nsm"]; ?></td>
                        <td><?= $row["nmr_surat"]; ?></td>
                        <td><?= $row["tgl_mutasi"]; ?></td>
                        <td><?= $row["kls_mutasi"]; ?></td>
                        <td>
                            <a href="berkas/<?= $row["berkas"]; ?>" target="_blank" class="badge text-bg-primary text-wrap" style="width: 6rem;">Lihat</a>
                            <a href="hapusmutasimsk.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="badge text-bg-warning text-wrap" style="width: 6rem;">Hapus</a><br>
                        </td>
                    </tr>
                </tbody>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
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