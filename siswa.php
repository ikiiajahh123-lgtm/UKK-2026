<?php

include "includes/cek_session.php";
include "config/koneksi.php";


// =====================================================
// TAMBAH DATA SISWA
// =====================================================

if (isset($_POST['tambah'])) {

    $nisn = mysqli_real_escape_string(
        $koneksi,
        $_POST['nisn']
    );

    $nis = mysqli_real_escape_string(
        $koneksi,
        $_POST['nis']
    );

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama']
    );

    $jenis_kelamin = mysqli_real_escape_string(
        $koneksi,
        $_POST['jenis_kelamin']
    );

    $tanggal_lahir = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_lahir']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi,
        $_POST['alamat']
    );

    $status_aktif = mysqli_real_escape_string(
        $koneksi,
        $_POST['status_aktif']
    );


    $sql = "INSERT INTO siswa
            (
                nisn,
                nis,
                nama,
                jenis_kelamin,
                tanggal_lahir,
                alamat,
                status_aktif
            )
            VALUES
            (
                '$nisn',
                '$nis',
                '$nama',
                '$jenis_kelamin',
                '$tanggal_lahir',
                '$alamat',
                '$status_aktif'
            )";


    if (mysqli_query($koneksi, $sql)) {

        header("Location: siswa.php?pesan=berhasil");
        exit();

    } else {

        echo "Gagal menyimpan data: "
            . mysqli_error($koneksi);

    }
}


// =====================================================
// HAPUS DATA SISWA
// =====================================================

if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];


    $sql_hapus = "DELETE FROM siswa
                  WHERE id_siswa = $id";


    if (mysqli_query($koneksi, $sql_hapus)) {

        header("Location: siswa.php?pesan=hapus");
        exit();

    } else {

        echo "Gagal menghapus data: "
            . mysqli_error($koneksi);

    }
}


// =====================================================
// AMBIL DATA SISWA
// =====================================================

$query_siswa = mysqli_query(
    $koneksi,
    "SELECT * FROM siswa ORDER BY id_siswa DESC"
);


if (!$query_siswa) {

    die(
        "Gagal mengambil data siswa: "
        . mysqli_error($koneksi)
    );

}

?>


<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Data Siswa</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<div class="container-fluid">

    <div class="row min-vh-100">


        <!-- =================================================
             SIDEBAR
             ================================================= -->

        <div class="col-md-3 col-lg-2 bg-dark p-3">


            <!-- LOGO -->

            <div class="d-flex align-items-center mb-4">

                <div
                    class="bg-primary
                           rounded-circle
                           text-white
                           fw-bold
                           d-flex
                           align-items-center
                           justify-content-center
                           me-2"
                    style="width: 45px; height: 45px;"
                >

                    SMK

                </div>


                <div class="text-white fw-bold">

                    SMK<br>
                    MUHAMMADIYAH

                </div>

            </div>


            <!-- MENU -->

            <div class="nav nav-pills flex-column gap-2">


                <a
                    href="dashboard.php"
                    class="nav-link text-white"
                >
                    Dashboard
                </a>


                <a
                    href="siswa.php"
                    class="nav-link active bg-primary"
                >
                    Data Siswa
                </a>


                <a
                    href="guru.php"
                    class="nav-link text-white"
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


        <!-- =================================================
             KONTEN UTAMA
             ================================================= -->

        <div class="col-md-9 col-lg-10 p-4">


            <!-- HEADER -->

            <div
                class="d-flex
                       justify-content-between
                       align-items-center
                       mb-4"
            >

                <div>

                    <h2 class="fw-bold mb-1">
                        Data Siswa
                    </h2>

                    <p class="text-secondary mb-0">
                        Daftar data siswa sekolah
                    </p>

                </div>


                <!-- TOMBOL TAMBAH -->

                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                >

                    + Tambah Data

                </button>


            </div>


            <!-- =================================================
                 PESAN
                 ================================================= -->

            <?php if (isset($_GET['pesan'])): ?>


                <?php if ($_GET['pesan'] == 'berhasil'): ?>

                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >

                        Data siswa berhasil ditambahkan.

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                <?php endif; ?>


                <?php if ($_GET['pesan'] == 'hapus'): ?>

                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >

                        Data siswa berhasil dihapus.

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                <?php endif; ?>


            <?php endif; ?>


            <!-- =================================================
                 TABEL SISWA
                 ================================================= -->

            <div class="card border-0 shadow-sm">


                <div class="card-body">


                    <div class="table-responsive">


                        <table
                            class="table
                                   table-bordered
                                   table-hover
                                   align-middle
                                   mb-0"
                        >


                            <thead class="table-secondary">

                                <tr>

                                    <th class="text-center">
                                        No
                                    </th>

                                    <th>
                                        NISN
                                    </th>

                                    <th>
                                        NIS
                                    </th>

                                    <th>
                                        Nama
                                    </th>

                                    <th>
                                        JK
                                    </th>

                                    <th>
                                        Tanggal Lahir
                                    </th>

                                    <th>
                                        Alamat
                                    </th>

                                    <th>
                                        Status
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
                                mysqli_num_rows($query_siswa) > 0
                            ) {


                                while (
                                    $siswa =
                                    mysqli_fetch_assoc($query_siswa)
                                ) {

                            ?>


                                <tr>


                                    <!-- NO -->

                                    <td class="text-center">

                                        <?= $no ?>

                                    </td>


                                    <!-- NISN -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nisn']
                                        ) ?>

                                    </td>


                                    <!-- NIS -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nis']
                                        ) ?>

                                    </td>


                                    <!-- NAMA -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nama']
                                        ) ?>

                                    </td>


                                    <!-- JENIS KELAMIN -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['jenis_kelamin']
                                        ) ?>

                                    </td>


                                    <!-- TANGGAL LAHIR -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['tanggal_lahir']
                                        ) ?>

                                    </td>


                                    <!-- ALAMAT -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['alamat']
                                        ) ?>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <?php
                                        if (
                                            $siswa['status_aktif']
                                            == 'Aktif'
                                        ) {
                                        ?>

                                            <span
                                                class="badge bg-success"
                                            >
                                                Aktif
                                            </span>

                                        <?php
                                        } else {
                                        ?>

                                            <span
                                                class="badge bg-secondary"
                                            >
                                                Tidak Aktif
                                            </span>

                                        <?php
                                        }
                                        ?>

                                    </td>


                                    <!-- AKSI -->

                                    <td class="text-center">


                                        <a
                                            href="edit_siswa.php?id=<?= $siswa['id_siswa'] ?>"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>


                                        <a
                                            href="siswa.php?hapus=<?= $siswa['id_siswa'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        >
                                            Hapus
                                        </a>


                                    </td>


                                </tr>


                            <?php

                                    $no++;

                                }


                            } else {

                            ?>


                                <tr>

                                    <td
                                        colspan="9"
                                        class="text-center
                                               text-secondary
                                               py-5"
                                    >

                                        Belum ada data siswa.

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
     MODAL TAMBAH SISWA
     ===================================================== -->

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
    aria-hidden="true"
>


    <div class="modal-dialog modal-lg">


        <div class="modal-content">


            <!-- HEADER MODAL -->

            <div class="modal-header">

                <h5 class="modal-title fw-bold">

                    Tambah Data Siswa

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <!-- FORM -->

            <form
                action="siswa.php"
                method="POST"
            >


                <div class="modal-body">


                    <!-- NISN -->

                    <div class="mb-3">

                        <label class="form-label">
                            NISN
                        </label>

                        <input
                            type="text"
                            name="nisn"
                            class="form-control"
                            placeholder="Masukkan NISN"
                            required
                        >

                    </div>


                    <!-- NIS -->

                    <div class="mb-3">

                        <label class="form-label">
                            NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            class="form-control"
                            placeholder="Masukkan NIS"
                            required
                        >

                    </div>


                    <!-- NAMA -->

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama siswa"
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


                    <!-- TANGGAL LAHIR -->

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tanggal_lahir"
                            class="form-control"
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


                    <!-- STATUS -->

                    <div class="mb-3">

                        <label class="form-label">
                            Status Aktif
                        </label>

                        <select
                            name="status_aktif"
                            class="form-select"
                            required
                        >

                            <option value="Aktif">
                                Aktif
                            </option>

                            <option value="Tidak Aktif">
                                Tidak Aktif
                            </option>

                        </select>

                    </div>


                </div>


                <!-- FOOTER -->

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


<!-- =====================================================
     BOOTSTRAP JAVASCRIPT
     ===================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>