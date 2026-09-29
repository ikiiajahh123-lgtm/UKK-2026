<?php

include "cek_session.php";
include "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Catatan Pelanggaran</title>
</head>

<body>

<h2>Catatan Pelanggaran</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>

<br><br>

<form method="POST">

    <label>Siswa</label><br>

    <select name="id_siswa" required>

        <option value="">-- Pilih Siswa --</option>

        <?php

        $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");

        while ($data = mysqli_fetch_assoc($siswa)) {

        ?>

        <option value="<?php echo $data['id_siswa']; ?>">

            <?php
            echo $data['nis'] . " - " . $data['nama_siswa'];
            ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Jenis Pelanggaran</label><br>

    <select name="id_pelanggaran" required>

        <option value="">-- Pilih Pelanggaran --</option>

        <?php

        $pelanggaran = mysqli_query(
            $koneksi,
            "SELECT * FROM pelanggaran"
        );

        while ($data = mysqli_fetch_assoc($pelanggaran)) {

        ?>

        <option value="<?php echo $data['id_pelanggaran']; ?>">

            <?php
            echo $data['nama_pelanggaran'] .
                 " - " .
                 $data['poin'] .
                 " poin";
            ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Tanggal</label><br>

    <input
        type="date"
        name="tanggal"
        required
    >

    <br><br>

    <label>Keterangan</label><br>

    <textarea
        name="keterangan"
        required
    ></textarea>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

<?php

if (isset($_POST['simpan'])) {

    $id_siswa = $_POST['id_siswa'];
    $id_pelanggaran = $_POST['id_pelanggaran'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO catatan_pelanggaran
        (id_siswa, id_pelanggaran, tanggal, keterangan)
        VALUES
        ('$id_siswa',
         '$id_pelanggaran',
         '$tanggal',
         '$keterangan')
    ");

    echo "<p>Catatan pelanggaran berhasil disimpan.</p>";

}

?>

</body>
</html>