<?php

session_start();

include "config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.php");
    exit();
}

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

if ($username == "" || $password == "") {
    header("Location: login.php?pesan=gagal");
    exit();
}

$username = mysqli_real_escape_string($koneksi, $username);

/*
    Login bisa menggunakan:
    - name
    - atau email
*/

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM t_users
     WHERE name = '$username'
     OR email = '$username'
     LIMIT 1"
);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($query) == 1) {

    $user = mysqli_fetch_assoc($query);


    if ($password === trim($user["password"])) {

        $_SESSION["login"] = true;
        $_SESSION["nama_user"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["role"] = $user["role"];

        header("Location: dashboard.php");
        exit();

    } else {

        header(
            "Location: login.php?pesan=gagal&username="
            . urlencode($username)
        );
        exit();
    }

} else {

    header(
        "Location: login.php?pesan=gagal&username="
        . urlencode($username)
    );
    exit();
}

?>