<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body>

<h2>Dashboard</h2>

<p>
    Selamat datang,
    <?php echo $_SESSION['nama_user']; ?>
</p>

<p>
    Role:
    <?php echo $_SESSION['role']; ?>
</p>

<hr>

<a href="dashboard.php"></a>

<br><br>

<?php

if ($_SESSION['role'] == "admin") { ?>

        <h3>menu admin</h3>
    <a href="menu1.php">Menu 1</a>

    <br><br>

    <a href="menu2.php">Menu 2</a>

    <br><br>

    <a href="menu3.php">Menu 3</a>

    <br><br>

    <a href="menu4.php">Menu 4</a>

    <br><br>

<?php

} else if ($_SESSION['role'] == "guru") { ?>
        
        <h3>menu guru</h3>
    <a href="menu3.php">Menu 3</a>

    <br><br>

    <a href="menu4.php">Menu 4</a>

    <br><br>

<?php

}

?>

<a href="logout.php">Logout</a>

</body>
</html>