<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambahsk($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'sk.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
                document.location.href = 'sk.php';
            </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Tambah Surat Keputusan</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="sk.php">Kembali</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="p-4">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-lg-5 mx-auto">
                    <div class="formContainer">
                        <h2 class="p-2 text-center mb-4 h4" id="formHeading">Tambah Surat Keputusan</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group mt-3">
                                <label class="mb-2" for="nmr_sk">No. SK</label>
                                <input class="form-control" type="text" id="nmr_sk" name="nmr_sk" required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="tentang">Tentang</label>
                                <input class="form-control" type="text" id="tentang" name="tentang" required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="tgl_sk">Tgl. SK</label>
                                <input class="form-control" type="date" id="tgl_sk" name="tgl_sk" required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="berkas">Berkas .pdf</label>
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="file" id="berkas" name="berkas" required>
                                <label class="input-group-text" for="berkas">.pdf</label>
                            </div>
                            <button class="btn btn-primary btn-lg w-100 mt-4" type="submit" name="submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5 bg-body-tertiary">
            <?php include 'asset/footer.php' ?>
        </div>
    </div>
    <script src="bootstrap\js\bootstrap.bundle.js"></script>
</body>

</html>