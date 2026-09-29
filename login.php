<!DOCTYPE html>
<html>
<head>
    <title>Login - Pelanggaran Siswa</title>
</head>
<body>

    <h2>LOGIN</h2>

    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "Username atau password salah!";
        }
    }
    ?>

    <form action="proses_login.php" method="POST">

        <label>Username</label><br>
        <input type="text" name="username" required>
        <br><br>

        <label>Password</label><br>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Login</button>

    </form>

</body>
</html>