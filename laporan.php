<?php

include "includes/cek_session.php";
include "config/koneksi.php";


// ========================================
// DATA SISWA
// ========================================

$query_siswa = mysqli_query(
    $koneksi,
    "SELECT * FROM siswa ORDER BY id_siswa DESC"
);

if (!$query_siswa) {
    die("Gagal mengambil data siswa: " . mysqli_error($koneksi));
}

$total_siswa = mysqli_num_rows($query_siswa);


// ========================================
// DATA GURU
// ========================================

$query_guru = mysqli_query(
    $koneksi,
    "SELECT * FROM guru"
);

if ($query_guru) {
    $total_guru = mysqli_num_rows($query_guru);
} else {
    $total_guru = 0;
}


// ========================================
// DATA KELAS
// ========================================

$query_kelas = mysqli_query(
    $koneksi,
    "SELECT * FROM kelas"
);

if ($query_kelas) {
    $total_kelas = mysqli_num_rows($query_kelas);
} else {
    $total_kelas = 0;
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

    <title>Laporan</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<div class="container-fluid">

    <div class="row min-vh-100">


        <!-- =====================================
             SIDEBAR
             ===================================== -->

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
                           me-2
                           p-3"
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
                    href="menu1.php"
                    class="nav-link text-white"
                >
                    Data Siswa
                </a>


                <a
                    href="menu2.php"
                    class="nav-link text-white"
                >
                    Data Guru
                </a>


                <a
                    href="menu3.php"
                    class="nav-link text-white"
                >
                    Kelas
                </a>


                <a
                    href="laporan.php"
                    class="nav-link active bg-primary"
                >
                    Laporan
                </a>


                <a
                    href="#"
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


        <!-- =====================================
             KONTEN
             ===================================== -->

        <div class="col-md-9 col-lg-10 p-4">


            <!-- JUDUL -->

            <div
                class="d-flex
                       justify-content-between
                       align-items-center
                       mb-4"
            >

                <div>

                    <h2 class="fw-bold mb-1">
                        Laporan
                    </h2>

                    <p class="text-secondary mb-0">
                        Informasi data sekolah
                    </p>

                </div>


                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="window.print()"
                >

                    Cetak Laporan

                </button>

            </div>


            <!-- =====================================
                 RINGKASAN
                 ===================================== -->

            <div class="row g-3 mb-4">


                <!-- SISWA -->

                <div class="col-md-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            <h6 class="text-secondary">
                                Data Siswa
                            </h6>

                            <h2 class="fw-bold text-primary mb-0">

                                <?= $total_siswa ?>

                            </h2>

                        </div>

                    </div>

                </div>


                <!-- GURU -->

                <div class="col-md-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            <h6 class="text-secondary">
                                Data Guru
                            </h6>

                            <h2 class="fw-bold text-success mb-0">

                                <?= $total_guru ?>

                            </h2>

                        </div>

                    </div>

                </div>


                <!-- KELAS -->

                <div class="col-md-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            <h6 class="text-secondary">
                                Kelas
                            </h6>

                            <h2 class="fw-bold text-warning mb-0">

                                <?= $total_kelas ?>

                            </h2>

                        </div>

                    </div>

                </div>


            </div>


            <!-- =====================================
                 TABEL SISWA
                 ===================================== -->

            <div class="card shadow-sm border-0">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-1">
                        Data Siswa
                    </h5>

                    <small class="text-secondary">
                        Daftar siswa yang terdaftar
                    </small>

                </div>


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
                                        NISN
                                    </th>

                                    <th>
                                        NIS
                                    </th>

                                    <th>
                                        Nama
                                    </th>

                                    <th>
                                        Jenis Kelamin
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

                                    <td class="text-center">

                                        <?= $no ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nisn']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nis']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['nama']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['jenis_kelamin']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['tanggal_lahir']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $siswa['alamat']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?php

                                        if (
                                            $siswa['status_aktif']
                                            == "Aktif"
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
                                               py-4"
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


<!-- BOOTSTRAP JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>