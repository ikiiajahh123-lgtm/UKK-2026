\<?php

include "includes/cek_session.php";
include "config/koneksi.php";

/*
|--------------------------------------------------------------------------
| CEK KOLOM TABEL GURU
|--------------------------------------------------------------------------
*/

$kolom = [];

$hasil_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM guru");

if (!$hasil_kolom) {
    die("Tabel guru tidak ditemukan: " . mysqli_error($koneksi));
}

while ($row = mysqli_fetch_assoc($hasil_kolom)) {
    $kolom[] = $row['Field'];
}


/*
|--------------------------------------------------------------------------
| FUNGSI MENCARI NAMA KOLOM
|--------------------------------------------------------------------------
*/

function cariKolom($daftar, $pilihan)
{
    foreach ($pilihan as $nama) {
        if (in_array($nama, $daftar)) {
            return $nama;
        }
    }

    return null;
}


/*
|--------------------------------------------------------------------------
| TENTUKAN KOLOM DATABASE
|--------------------------------------------------------------------------
*/

$kolom_id = cariKolom($kolom, [
    'id_guru',
    'id',
    'guru_id'
]);

$kolom_nip = cariKolom($kolom, [
    'nip',
    'NIP'
]);

$kolom_nama = cariKolom($kolom, [
    'nama',
    'nama_guru',
    'namaGuru',
    'nama_guru'
]);

$kolom_jk = cariKolom($kolom, [
    'jenis_kelamin',
    'jenisKelamin',
    'jk'
]);

$kolom_mapel = cariKolom($kolom, [
    'mata_pelajaran',
    'mata_pelajaran',
    'mapel',
    'mataPelajaran'
]);

$kolom_hp = cariKolom($kolom, [
    'no_hp',
    'nohp',
    'nomor_hp',
    'no_telepon',
    'telepon'
]);

$kolom_alamat = cariKolom($kolom, [
    'alamat',
    'address'
]);


/*
|--------------------------------------------------------------------------
| TAMBAH DATA
|--------------------------------------------------------------------------
*/

if (isset($_POST['tambah'])) {

    $nip = mysqli_real_escape_string(
        $koneksi,
        $_POST['nip']
    );

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama']
    );

    $jenis_kelamin = mysqli_real_escape_string(
        $koneksi,
        $_POST['jenis_kelamin']
    );

    $mata_pelajaran = mysqli_real_escape_string(
        $koneksi,
        $_POST['mata_pelajaran']
    );

    $no_hp = mysqli_real_escape_string(
        $koneksi,
        $_POST['no_hp']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi,
        $_POST['alamat']
    );


    /*
    |----------------------------------------------------------
    | Pastikan kolom wajib ditemukan
    |----------------------------------------------------------
    */

    if (
        !$kolom_nip ||
        !$kolom_nama ||
        !$kolom_jk ||
        !$kolom_mapel ||
        !$kolom_hp ||
        !$kolom_alamat
    ) {

        die(
            "Kolom tabel guru tidak sesuai. " .
            "Kolom yang ditemukan: " .
            implode(", ", $kolom)
        );

    }


    $sql = "INSERT INTO guru
            (
                `$kolom_nip`,
                `$kolom_nama`,
                `$kolom_jk`,
                `$kolom_mapel`,
                `$kolom_hp`,
                `$kolom_alamat`
            )
            VALUES
            (
                '$nip',
                '$nama',
                '$jenis_kelamin',
                '$mata_pelajaran',
                '$no_hp',
                '$alamat'
            )";


    if (mysqli_query($koneksi, $sql)) {

        header("Location: guru.php?pesan=berhasil");
        exit();

    } else {

        die(
            "Gagal menyimpan data guru: " .
            mysqli_error($koneksi)
        );

    }
}


/*
|--------------------------------------------------------------------------
| HAPUS DATA
|--------------------------------------------------------------------------
*/

if (
    isset($_GET['hapus']) &&
    $kolom_id
) {

    $id = (int) $_GET['hapus'];

    $sql_hapus = "
        DELETE FROM guru
        WHERE `$kolom_id` = $id
    ";


    if (mysqli_query($koneksi, $sql_hapus)) {

        header("Location: guru.php?pesan=hapus");
        exit();

    } else {

        die(
            "Gagal menghapus data: " .
            mysqli_error($koneksi)
        );

    }
}


/*
|--------------------------------------------------------------------------
| AMBIL DATA GURU
|--------------------------------------------------------------------------
*/

$query_guru = mysqli_query(
    $koneksi,
    "SELECT * FROM guru"
);


if (!$query_guru) {

    die(
        "Gagal mengambil data guru: " .
        mysqli_error($koneksi)
    );

}

?>


<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Data Guru</title>


    <!-- BOOTSTRAP 5 -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<div class="container-fluid">

    <div class="row min-vh-100">


        <!-- SIDEBAR -->

        <div class="col-md-3 col-lg-2 bg-dark p-3">


            <div class="d-flex align-items-center mb-4">

                <div
                    class="bg-primary
                           rounded-circle
                           text-white
                           fw-bold
                           p-3
                           me-2"
                >
                    SMK
                </div>


                <div class="text-white fw-bold">

                    SMK<br>
                    MUHAMMADIYAH

                </div>

            </div>


            <div class="nav nav-pills flex-column gap-2">


                <a
                    href="dashboard.php"
                    class="nav-link text-white"
                >
                    Dashboard
                </a>


                <a
                    href="siswa.php"
                    class="nav-link text-white"
                >
                    Data Siswa
                </a>


                <a
                    href="guru.php"
                    class="nav-link active bg-primary"
                >
                    Data Guru
                </a>


                <a
                    href="kelas.php"
                    class="nav-link text-white"
                >
                    Kelas
                </a>


                <a
                    href="laporan.php"
                    class="nav-link text-white"
                >
                    Laporan
                </a>


                <a
                    href="about_me.php"
                    class="nav-link text-white"
                >
                    About me
                </a>


                <hr class="border-secondary">


                <a
                    href="logout.php"
                    class="nav-link text-danger"
                >
                    Logout
                </a>

            </div>

        </div>


        <!-- KONTEN -->

        <div class="col-md-9 col-lg-10 p-4">


            <div
                class="d-flex
                       justify-content-between
                       align-items-center
                       mb-4"
            >

                <div>

                    <h2 class="fw-bold">
                        Data Guru
                    </h2>

                    <p class="text-secondary">
                        Daftar data guru sekolah
                    </p>

                </div>


                <button
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                >

                    + Tambah Data

                </button>

            </div>


            <!-- PESAN -->

            <?php if (isset($_GET['pesan'])): ?>


                <?php if ($_GET['pesan'] == 'berhasil'): ?>

                    <div
                        class="alert alert-success alert-dismissible fade show"
                    >

                        Data guru berhasil ditambahkan.

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                <?php endif; ?>


                <?php if ($_GET['pesan'] == 'hapus'): ?>

                    <div
                        class="alert alert-success alert-dismissible fade show"
                    >

                        Data guru berhasil dihapus.

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                <?php endif; ?>


            <?php endif; ?>


            <!-- TABEL -->

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table
                                   table-bordered
                                   table-hover
                                   align-middle"
                        >

                            <thead class="table-secondary">

                                <tr>

                                    <th class="text-center">
                                        No
                                    </th>

                                    <th>
                                        NIP
                                    </th>

                                    <th>
                                        Nama Guru
                                    </th>

                                    <th>
                                        Jenis Kelamin
                                    </th>

                                    <th>
                                        Mata Pelajaran
                                    </th>

                                    <th>
                                        No HP
                                    </th>

                                    <th>
                                        Alamat
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                            <?php

                            $no = 1;


                            if (
                                mysqli_num_rows($query_guru) > 0
                            ) {


                                while (
                                    $guru =
                                    mysqli_fetch_assoc($query_guru)
                                ) {

                            ?>

                                <tr>


                                    <td class="text-center">

                                        <?= $no ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_nip]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_nama]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_jk]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_mapel]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_hp]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $guru[$kolom_alamat]
                                        ) ?>

                                    </td>


                                    <td class="text-center">


                                        <?php if ($kolom_id): ?>

                                            <a
                                                href="guru.php?hapus=<?= $guru[$kolom_id] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data guru ini?')"
                                            >

                                                Hapus

                                            </a>

                                        <?php endif; ?>


                                    </td>

                                </tr>


                            <?php

                                    $no++;

                                }


                            } else {

                            ?>

                                <tr>

                                    <td
                                        colspan="8"
                                        class="text-center
                                               text-secondary
                                               py-5"
                                    >

                                        Belum ada data guru.

                                    </td>

                                </tr>

                            <?php

                            }

                            ?>


                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>


<!-- =====================================================
     MODAL TAMBAH DATA
     ===================================================== -->

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
>


    <div class="modal-dialog modal-lg">


        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title fw-bold">

                    Tambah Data Guru

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                action="guru.php"
                method="POST"
            >


                <div class="modal-body">


                    <!-- NIP -->

                    <div class="mb-3">

                        <label class="form-label">
                            NIP
                        </label>

                        <input
                            type="text"
                            name="nip"
                            class="form-control"
                            placeholder="Masukkan NIP"
                            required
                        >

                    </div>


                    <!-- NAMA -->

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Guru
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama guru"
                            required
                        >

                    </div>


                    <!-- JENIS KELAMIN -->

                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Kelamin --
                            </option>

                            <option value="Laki-laki">
                                Laki-laki
                            </option>

                            <option value="Perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>


                    <!-- MATA PELAJARAN -->

                    <div class="mb-3">

                        <label class="form-label">
                            Mata Pelajaran
                        </label>

                        <input
                            type="text"
                            name="mata_pelajaran"
                            class="form-control"
                            placeholder="Contoh: Basis Data"
                            required
                        >

                    </div>


                    <!-- NO HP -->

                    <div class="mb-3">

                        <label class="form-label">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control"
                            placeholder="Masukkan nomor HP"
                            required
                        >

                    </div>


                    <!-- ALAMAT -->

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat"
                            required
                        ></textarea>

                    </div>


                </div>


                <div class="modal-footer">


                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        name="tambah"
                        class="btn btn-primary"
                    >

                        Tambah

                    </button>


                </div>


            </form>

        </div>

    </div>

</div>


<!-- BOOTSTRAP JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>