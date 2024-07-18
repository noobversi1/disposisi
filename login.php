<?php

session_start();

require 'functions.php';

//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek user
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["pass"])) {
            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Login - Arsip</title>
</head>

<body>
    <div class="p-4">
        <div class="container">
            <img class="my-4 mb-4 mx-auto d-block" width="200" src="asset/logo.png">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-lg-3 mx-auto">
                    <div class="formContainer">
                        <h2 class="p-2 text-center mb-4 h4" id="formHeading">Login</h2>
                        <?php if (isset($error)) : ?>
                            <p style="color: red; font-style: italic;">Username / Password salah</p>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="form-group mt-3">
                                <label class="mb-2" for="username">Username</label>
                                <input class="form-control" type="text" id="username" name="username" />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="password">Password</label>
                                <input class="form-control" type="password" id="password" name="password" />
                            </div>
                            <div class="mt-3">
                                <input type="checkbox" name="remember" id="remember" /> Remember me
                            </div>
                            <button class="btn btn-success btn-lg w-100 mt-4" type="submit" name="login">Login</button>
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