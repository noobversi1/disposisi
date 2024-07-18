<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
$jumlahdataperhalaman = 20;
$jumlahdata = count(query("SELECT * FROM keputusan"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$halamantengah = ceil($jumlahhalaman / 2);

$keputusan = query("SELECT * FROM keputusan ORDER BY id DESC");

if (isset($_POST["cari"])) {
    $keputusan = carikeputusan($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Arsip Surat Keputusan</title>
</head>

<body>
    <div class="container">
        <?php include 'asset/header.php' ?>
        <a href="tambahsk.php" class="my-4 mb-4 btn btn-success">Tambah Surat Keputusan</a>
        <?php include 'asset/cari.php' ?>
        <?php include 'asset/pagination.php' ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No. SK</th>
                    <th scope="col">Tentang</th>
                    <th scope="col">Tgl. SK</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($keputusan as $row) : ?>
                <tbody>
                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td><?= $row["nmr_sk"]; ?></td>
                        <td><?= $row["tentang"]; ?></td>
                        <td><?= $row["tgl_sk"]; ?></td>
                        <td>
                            <a href="berkas/<?= $row["berkas"]; ?>" target="_blank" class="badge text-bg-primary text-wrap" style="width: 6rem;">Lihat</a>
                            <a href="hapussk.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="badge text-bg-warning text-wrap" style="width: 6rem;">Hapus</a><br>
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