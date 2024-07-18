<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
$jumlahdataperhalaman = 20;
$jumlahdata = count(query("SELECT * FROM mutasiklr"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$halamantengah = ceil($jumlahhalaman / 2);

$mutasiklr = query("SELECT * FROM mutasiklr ORDER BY id DESC");

if (isset($_POST["cari"])) {
    $masuk = carimutasiklr($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Arsip Surat Mutasi Keluar</title>
</head>

<body>
    <div class="container">
        <?php include 'asset/header.php' ?>
        <a href="tambahmutasiklr.php" class="my-4 mb-4 btn btn-success">Tambah Surat Mutasi Keluar</a>
        <form class="row g-3" action="" method="post">
            <div class="col-auto">
                <input class="form-control" type="text" name="keyword" autofocus placeholder="Masukkan Keyword ..." autocomplete="off" id="keyword">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary mb-3" type="submit" name="cari">Cari</button>
            </div>
        </form>
        <?php include 'asset/cari.php' ?>
        <?php include 'asset/pagination.php' ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">No. Surat Mutasi</th>
                    <th scope="col">Tanggal Mutasi</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($mutasiklr as $row) : ?>
                <tbody>
                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td><?= $row["nisn"]; ?></td>
                        <td><?= $row["nm_siswa"]; ?></td>
                        <td><?= $row["tujuan"]; ?></td>
                        <td><?= $row["nmr_surat"]; ?></td>
                        <td><?= $row["tgl_mutasi"]; ?></td>
                        <td><?= $row["kls_mutasi"]; ?></td>
                        <td>
                            <a href="berkas/<?= $row["berkas"]; ?>" target="_blank" class="badge text-bg-primary text-wrap" style="width: 6rem;">Lihat</a>
                            <a href="hapusmutasiklr.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="badge text-bg-warning text-wrap" style="width: 6rem;">Hapus</a><br>
                        </td>
                    </tr>
                </tbody>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
        <div class="my-5 bg-body-tertiary">
            <?php include 'asset/footer.php' ?>
        </div>
    </div>
    <script src="bootstrap\js\bootstrap.bundle.js"></script>
</body>

</html>