<?php

include "cek_session.php";
include "koneksi.php";

if ($_SESSION['role'] != "admin") {
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
</head>

<body>

<h2>Data Siswa</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>

<br><br>

<form method="POST">

    <label>NIS</label><br>
    <input type="text" name="nis" required>

    <br><br>

    <label>Nama Siswa</label><br>
    <input type="text" name="nama_siswa" required>

    <br><br>

    <label>Kelas</label><br>
    <input type="text" name="kelas" required>

    <br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan" required>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<?php

if (isset($_POST['simpan'])) {

    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi, "INSERT INTO siswa
        (nis, nama_siswa, kelas, jurusan)
        VALUES
        ('$nis', '$nama_siswa', '$kelas', '$jurusan')
    ");

    echo "<p>Data siswa berhasil disimpan.</p>";

}

?>

<hr>

<h3>Daftar Siswa</h3>

<table border="1" cellpadding="8">

<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Jurusan</th>
</tr>

<?php

$no = 1;

$query = mysqli_query($koneksi, "SELECT * FROM siswa");

while ($data = mysqli_fetch_assoc($query)) {

?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nis']; ?></td>
    <td><?php echo $data['nama_siswa']; ?></td>
    <td><?php echo $data['kelas']; ?></td>
    <td><?php echo $data['jurusan']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>