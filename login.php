<!DOCTYPE html>
<html>
<head>
    <title>Login - Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="card shadow p-4" style="width: 400px;">

            <div class="card-body">

                <h2 class="text-center mb-4">Login</h2> 

<h2>LOGIN</h2>

<?php

$username_lama = "";

if (isset($_GET['username'])) {
    $username_lama = htmlspecialchars($_GET['username']);
}

if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') {
    echo "<p style='color:red;'>Username atau password salah!</p>";
}

?>

<form action="proses_login.php" method="POST" autocomplete="off">

    <label>Username / Email</label><br>

    <input
        type="text"
        name="username"
        value="<?php echo $username_lama; ?>"
        autocomplete="off"
        required
    >

    <br><br>

    <label>Password</label><br>

    <input
        type="password"
        name="password"
        autocomplete="new-password"
        required
    >

    <br><br>

    <button type="submit"class="btn btn-primary">Login</button>

</form>

</body>
</html>
<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
