<?php

session_start();

include "config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama_user'] = $data['nama_user'];
    $_SESSION['role'] = $data['role'];

    header("Location: dashboard.php");
    exit;

} else {

    header("Location: login.php?pesan=gagal");
    exit;

}

?>