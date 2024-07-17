<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('User baru berhasil ditambahkan');
            document.location.href = 'login.php';
            </script>";
    } else {
        echo mysqli_error($conn);
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
    <title>Registrasi - Arsip</title>
</head>

<body>
    <div class="p-4">
        <div class="container">
            <img class="my-4 mb-4 mx-auto d-block" width="200" src="asset/logo.png">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-lg-3 mx-auto">
                    <div class="formContainer">
                        <h2 class="p-2 text-center mb-4 h4" id="formHeading">Registrasi</h2>
                        <form action="" method="post">
                            <div class="form-group mt-3">
                                <label class="mb-2" for="username">Username</label>
                                <input class="form-control" type="text" id="username" name="username" required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="password">Password</label>
                                <input class="form-control" type="password" id="password" name="password" required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="password2">Konfirmasi Password</label>
                                <input class="form-control" type="password" id="password2" name="password2" required />
                            </div>
                            <button class="btn btn-success btn-lg w-100 mt-4" type="submit" name="register">Registrasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5 bg-body-tertiary">
            <footer class="text-center text-lg-start text-dark">
                <div class="text-center p-3">
                    Developed by:
                    <a class="text-dark" href="https://tarigan.web.id/">Tarigan Hosting</a><i><small> - <?= $versi; ?></small></i>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>