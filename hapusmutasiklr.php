<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if (hapusmutasiklr($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'mutasiklr.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus');
            document.location.href = 'mutasiklr.php';
        </script>
    ";
}
