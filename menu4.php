<?php

include "cek_session.php";
include "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pelanggaran</title>
</head>

<body>

<h2>Riwayat Pelanggaran</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>

<br><br>

<table border="1" cellpadding="8">

<tr>

    <th>No</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Pelanggaran</th>
    <th>Tanggal</th>
    <th>Poin</th>
    <th>Keterangan</th>

</tr>

<?php

$no = 1;

$query = mysqli_query($koneksi, "

    SELECT
        catatan_pelanggaran.*,
        siswa.nis,
        siswa.nama_siswa,
        siswa.kelas,
        pelanggaran.nama_pelanggaran,
        pelanggaran.poin

    FROM catatan_pelanggaran

    JOIN siswa
    ON catatan_pelanggaran.id_siswa = siswa.id_siswa

    JOIN pelanggaran
    ON catatan_pelanggaran.id_pelanggaran =
       pelanggaran.id_pelanggaran

    ORDER BY catatan_pelanggaran.id_catatan DESC

");

while ($data = mysqli_fetch_assoc($query)) {

?>

<tr>

    <td><?php echo $no++; ?></td>

    <td><?php echo $data['nis']; ?></td>

    <td><?php echo $data['nama_siswa']; ?></td>

    <td><?php echo $data['kelas']; ?></td>

    <td><?php echo $data['nama_pelanggaran']; ?></td>

    <td><?php echo $data['tanggal']; ?></td>

    <td><?php echo $data['poin']; ?></td>

    <td><?php echo $data['keterangan']; ?></td>

</tr>

<?php } ?>

</table>

</body>
</html>