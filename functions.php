<?php

require 'database.php';

// koneksi ke database
$conn = mysqli_connect("$koneksi", "$user", "$pass", "$db");

//Pengaturan
$namaapp = "Arsip Surat";
$instansi = "Tarigan Hosting";
$lokasi = "Indonesia";
$versi = "Versi 1.0.0";

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai')
            </script>";
        return false;
    }
    //enksripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username, pass) VALUE ('$username', '$password')");
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namafile = $_FILES['berkas']['name'];
    $ukuranfile = $_FILES['berkas']['size'];
    $error = $_FILES['berkas']['error'];
    $tmpname = $_FILES['berkas']['tmp_name'];

    //cek apakah tidak ada berkas yang diupload
    if ($error === 4) {
        echo "<script>
            alert('Pilih berkas terlebih dahulu');
            </script>";
        return false;
    }

    //cek apakah yang diupload adalah berkas
    $ekstensiberkasvalid = ['pdf'];
    $ekstensiberkaspecah = explode('.', $namafile);
    $ekstensiberkas = strtolower(end($ekstensiberkaspecah));
    if (!in_array($ekstensiberkas, $ekstensiberkasvalid)) {
        echo "<script>
            alert('Yang anda upload bukan berkas');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranfile > 10485760) {
        echo "<script>
            alert('Ukuran berkas terlalu besar');
            </script>";
        return false;
    }

    // lolos penegcekan, berkas siap diupload
    // generate nama berkas baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiberkas;
    move_uploaded_file($tmpname, 'berkas/' . $namafilebaru);
    return $namafilebaru;
}

function tambahmasuk($data)
{
    global $conn;

    $nmr_surat = htmlspecialchars($data["nmr_surat"]);
    $hal_surat = strtoupper(htmlspecialchars($data["hal_surat"]));
    $tgl_surat = strtoupper(htmlspecialchars($data["tgl_surat"]));
    $tgl_diterima = htmlspecialchars($data["tgl_diterima"]);
    $pengirim = htmlspecialchars($data["pengirim"]);
    // upload berkas
    $berkas = upload();
    if (!$berkas) {
        return false;
    }

    $query = "INSERT INTO masuk (nmr_surat, hal_surat, tgl_surat, tgl_diterima, pengirim, berkas)
    VALUES ('$nmr_surat', '$hal_surat', '$tgl_surat', '$tgl_diterima', '$pengirim', '$berkas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusmasuk($id)
{
    global $conn;

    $berkas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM masuk WHERE id='$id'"));
    mysqli_query($conn, "DELETE FROM masuk WHERE id = $id");
    unlink('berkas/' . $berkas["berkas"]);
    return mysqli_affected_rows($conn);
}

function carimasuk($keyword)
{
    $query = "SELECT * FROM masuk WHERE
    nmr_surat LIKE '%$keyword%' OR
    hal_surat LIKE '%$keyword%' OR
    pengirim LIKE '%$keyword%'";

    return query($query);
}

function tambahkeluar($data)
{
    global $conn;

    $nmr_surat = htmlspecialchars($data["nmr_surat"]);
    $hal_surat = strtoupper(htmlspecialchars($data["hal_surat"]));
    $tgl_surat = strtoupper(htmlspecialchars($data["tgl_surat"]));
    $tujuan = htmlspecialchars($data["tujuan"]);
    // upload berkas
    $berkas = upload();
    if (!$berkas) {
        return false;
    }

    $query = "INSERT INTO keluar (nmr_surat, hal_surat, tgl_surat, tujuan, berkas)
    VALUES ('$nmr_surat', '$hal_surat', '$tgl_surat', '$tujuan', '$berkas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapuskeluar($id)
{
    global $conn;

    $berkas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM keluar WHERE id='$id'"));
    mysqli_query($conn, "DELETE FROM keluar WHERE id = $id");
    unlink('berkas/' . $berkas["berkas"]);
    return mysqli_affected_rows($conn);
}

function carikeluar($keyword)
{
    $query = "SELECT * FROM keluar WHERE
    nmr_surat LIKE '%$keyword%' OR
    hal_surat LIKE '%$keyword%' OR
    tujuan LIKE '%$keyword%'";

    return query($query);
}

function tambahmutasimsk($data)
{
    global $conn;

    $nisn = htmlspecialchars($data["nisn"]);
    $nm_siswa = strtoupper(htmlspecialchars($data["nm_siswa"]));
    $asal = strtoupper(htmlspecialchars($data["asal"]));
    $nsm = htmlspecialchars($data["nsm"]);
    $nmr_surat = htmlspecialchars($data["nmr_surat"]);
    $tgl_mutasi = htmlspecialchars($data["tgl_mutasi"]);
    $kls_mutasi = htmlspecialchars($data["kls_mutasi"]);
    // upload berkas
    $berkas = upload();
    if (!$berkas) {
        return false;
    }

    $query = "INSERT INTO mutasimsk (nisn, nm_siswa, asal, nsm, nmr_surat, tgl_mutasi, kls_mutasi, berkas)
    VALUES ('$nisn', '$nm_siswa', '$asal', '$nsm', '$nmr_surat', '$tgl_mutasi', '$kls_mutasi', '$berkas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusmutasimsk($id)
{
    global $conn;

    $berkas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mutasimsk WHERE id='$id'"));
    mysqli_query($conn, "DELETE FROM mutasimsk WHERE id = $id");
    unlink('berkas/' . $berkas["berkas"]);
    return mysqli_affected_rows($conn);
}

function carimutasimsk($keyword)
{
    $query = "SELECT * FROM mutasimsk WHERE
    nisn LIKE '%$keyword%' OR
    nm_siswa LIKE '%$keyword%' OR
    asal LIKE '%$keyword%' OR
    nsm LIKE '%$keyword%' OR
    nmr_surat LIKE '%$keyword%' OR
    kls_mutasi LIKE '%$keyword%'";

    return query($query);
}

function tambahmutasiklr($data)
{
    global $conn;

    $nisn = htmlspecialchars($data["nisn"]);
    $nm_siswa = strtoupper(htmlspecialchars($data["nm_siswa"]));
    $tujuan = strtoupper(htmlspecialchars($data["tujuan"]));
    $nmr_surat = strtoupper(htmlspecialchars($data["nmr_surat"]));
    $tgl_mutasi = htmlspecialchars($data["tgl_mutasi"]);
    $kls_mutasi = htmlspecialchars($data["kls_mutasi"]);
    // upload berkas
    $berkas = upload();
    if (!$berkas) {
        return false;
    }

    $query = "INSERT INTO mutasiklr (nisn, nm_siswa, tujuan, nmr_surat, tgl_mutasi, kls_mutasi, berkas)
    VALUES ('$nisn', '$nm_siswa', '$tujuan', '$nmr_surat', '$tgl_mutasi', '$kls_mutasi', '$berkas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusmutasiklr($id)
{
    global $conn;

    $berkas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mutasiklr WHERE id='$id'"));
    mysqli_query($conn, "DELETE FROM mutasiklr WHERE id = $id");
    unlink('berkas/' . $berkas["berkas"]);
    return mysqli_affected_rows($conn);
}

function carimutasiklr($keyword)
{
    $query = "SELECT * FROM mutasiklr WHERE
    nisn LIKE '%$keyword%' OR
    nm_siswa LIKE '%$keyword%' OR
    tujuan LIKE '%$keyword%' OR
    nmr_surat LIKE '%$keyword%' OR
    kls_mutasi LIKE '%$keyword%'";

    return query($query);
}

function tambahsk($data)
{
    global $conn;

    $nmr_sk = htmlspecialchars($data["nmr_sk"]);
    $tentang = strtoupper(htmlspecialchars($data["tentang"]));
    $tgl_sk = strtoupper(htmlspecialchars($data["tgl_sk"]));
    // upload berkas
    $berkas = upload();
    if (!$berkas) {
        return false;
    }

    $query = "INSERT INTO keputusan (nmr_sk, tentang, tgl_sk, berkas)
    VALUES ('$nmr_sk', '$tentang', '$tgl_sk', '$berkas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapussk($id)
{
    global $conn;

    $berkas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM keputusan WHERE id='$id'"));
    mysqli_query($conn, "DELETE FROM keputusan WHERE id = $id");
    unlink('berkas/' . $berkas["berkas"]);
    return mysqli_affected_rows($conn);
}

function carikeputusan($keyword)
{
    $query = "SELECT * FROM keputusan WHERE
    nmr_sk LIKE '%$keyword%' OR
    tentang LIKE '%$keyword%'";

    return query($query);
}
