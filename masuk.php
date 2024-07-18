<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
$jumlahdataperhalaman = 20;
$jumlahdata = count(query("SELECT * FROM masuk"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$halamantengah = ceil($jumlahhalaman / 2);

$masuk = query("SELECT * FROM masuk ORDER BY id DESC");

if (isset($_POST["cari"])) {
    $masuk = carimasuk($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Arsip Surat Masuk</title>
</head>

<body>
    <div class="container">
        <?php include 'asset/header.php' ?>
        <a href="tambahmasuk.php" class="my-4 mb-4 btn btn-success">Tambah Surat Masuk</a>
        <?php include 'asset/cari.php' ?>
        <?php include 'asset/pagination.php' ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No. Surat</th>
                    <th scope="col">Hal Surat</th>
                    <th scope="col">Tgl Surat</th>
                    <th scope="col">Tgl Diterima</th>
                    <th scope="col">Pengirim</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($masuk as $row) : ?>
                <tbody>
                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td><?= $row["nmr_surat"]; ?></td>
                        <td><?= $row["hal_surat"]; ?></td>
                        <td><?= $row["tgl_surat"]; ?></td>
                        <td><?= $row["tgl_diterima"]; ?></td>
                        <td><?= $row["pengirim"]; ?></td>
                        <td>
                            <a href="berkas/<?= $row["berkas"]; ?>" target="_blank" class="badge text-bg-primary text-wrap" style="width: 6rem;">Lihat</a>
                            <a href="hapusmasuk.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="badge text-bg-warning text-wrap" style="width: 6rem;">Hapus</a><br>
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