<?php
include "includes/cek_session.php";
include "config/koneksi.php";


/* =====================================================
   TAMBAH DATA KELAS
   ===================================================== */

if (isset($_POST['tambah'])) {

    $nama_kelas = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_kelas']
    );

    $jurusan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jurusan']
    );

    $wali_kelas = mysqli_real_escape_string(
        $koneksi,
        $_POST['wali_kelas']
    );


    $query = "INSERT INTO kelas
              (nama_kelas, jurusan, wali_kelas, created_at)
              VALUES
              ('$nama_kelas', '$jurusan', '$wali_kelas', NOW())";


    $simpan = mysqli_query($koneksi, $query);


    if ($simpan) {

        header("Location: /UKK-2026/menu3.php?pesan=berhasil");
        exit();

    } else {

        header("Location: /UKK-2026/menu3.php?pesan=gagal");
        exit();

    }
}


/* =====================================================
   HAPUS DATA KELAS
   ===================================================== */

if (isset($_GET['hapus'])) {

    $id = mysqli_real_escape_string(
        $koneksi,
        $_GET['hapus']
    );


    $query = "DELETE FROM kelas
              WHERE id_kelas = '$id'";


    mysqli_query($koneksi, $query);


    header("Location: /UKK-2026/menu3.php?pesan=hapus");
    exit();
}


/* =====================================================
   EDIT DATA KELAS
   ===================================================== */

if (isset($_POST['edit'])) {

    $id_kelas = mysqli_real_escape_string(
        $koneksi,
        $_POST['id_kelas']
    );

    $nama_kelas = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_kelas']
    );

    $jurusan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jurusan']
    );

    $wali_kelas = mysqli_real_escape_string(
        $koneksi,
        $_POST['wali_kelas']
    );


    $query = "UPDATE kelas SET
              nama_kelas = '$nama_kelas',
              jurusan = '$jurusan',
              wali_kelas = '$wali_kelas'
              WHERE id_kelas = '$id_kelas'";


    mysqli_query($koneksi, $query);


    header("Location: /UKK-2026/menu3.php?pesan=edit");
    exit();
}


/* =====================================================
   AMBIL DATA KELAS
   ===================================================== */

$data_kelas = mysqli_query(
    $koneksi,
    "SELECT * FROM kelas ORDER BY id_kelas DESC"
);

?>


<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Data Kelas</title>


    <!-- BOOTSTRAP 5 -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<div class="container-fluid">

    <div class="row min-vh-100">


        <!-- =====================================================
             SIDEBAR
             ===================================================== -->

        <div class="col-md-3 col-lg-2 bg-dark p-3">


            <!-- LOGO / NAMA -->

            <div class="d-flex align-items-center mb-4">

                <div
                    class="bg-primary rounded-circle
                           d-flex align-items-center
                           justify-content-center
                           text-white fw-bold
                           me-2"
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
                    href="/UKK-2026/dashboard.php"
                    class="nav-link text-white"
                >
                    Dashboard
                </a>


                <a
                    href="/UKK-2026/menu1.php"
                    class="nav-link text-white"
                >
                    Data Siswa
                </a>


                <a
                    href="/UKK-2026/menu2.php"
                    class="nav-link text-white"
                >
                    Data Guru
                </a>


                <!-- KELAS AKTIF -->

                <a
                    href="/UKK-2026/menu3.php"
                    class="nav-link active bg-primary"
                >
                    Kelas
                </a>


                <a
                    href="/UKK-2026/menu4.php"
                    class="nav-link text-white"
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
                    href="/UKK-2026/logout.php"
                    class="nav-link text-danger"
                >
                    Logout
                </a>

            </div>

        </div>


        <!-- =====================================================
             KONTEN
             ===================================================== -->

        <div class="col-md-9 col-lg-10 bg-white p-4">


            <!-- JUDUL + TOMBOL -->

            <div
                class="d-flex
                       justify-content-between
                       align-items-center
                       mb-4"
            >

                <div>

                    <h4 class="fw-bold mb-1">
                        Data Kelas
                    </h4>

                    <small class="text-secondary">
                        Data kelas SMK Muhammadiyah
                    </small>

                </div>


                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                >
                    + Tambah Kelas
                </button>

            </div>


            <!-- =====================================================
                 ALERT
                 ===================================================== -->

            <?php if (isset($_GET['pesan'])): ?>


                <?php if ($_GET['pesan'] == 'berhasil'): ?>

                    <div class="alert alert-success">

                        Data kelas berhasil ditambahkan.

                    </div>


                <?php elseif ($_GET['pesan'] == 'gagal'): ?>

                    <div class="alert alert-danger">

                        Data kelas gagal ditambahkan.

                    </div>


                <?php elseif ($_GET['pesan'] == 'hapus'): ?>

                    <div class="alert alert-success">

                        Data kelas berhasil dihapus.

                    </div>


                <?php elseif ($_GET['pesan'] == 'edit'): ?>

                    <div class="alert alert-success">

                        Data kelas berhasil diperbarui.

                    </div>

                <?php endif; ?>


            <?php endif; ?>


            <!-- =====================================================
                 TABEL KELAS
                 ===================================================== -->

            <div class="table-responsive">

                <table
                    class="table table-bordered
                           table-hover
                           align-middle"
                >


                    <thead class="table-secondary">

                        <tr>

                            <th class="text-center">
                                No
                            </th>

                            <th>
                                Nama Kelas
                            </th>

                            <th>
                                Jurusan
                            </th>

                            <th>
                                Wali Kelas
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
                        mysqli_num_rows($data_kelas) > 0
                    ):


                        while (
                            $kelas =
                            mysqli_fetch_assoc($data_kelas)
                        ):

                    ?>


                        <tr>


                            <td class="text-center">

                                <?= $no++; ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $kelas['nama_kelas']
                                ); ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $kelas['jurusan']
                                ); ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $kelas['wali_kelas']
                                ); ?>

                            </td>


                            <!-- AKSI -->

                            <td class="text-center">


                                <!-- EDIT -->

                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit<?= $kelas['id_kelas']; ?>"
                                >
                                    Edit
                                </button>


                                <!-- HAPUS -->

                                <a
                                    href="/UKK-2026/menu3.php?hapus=<?= $kelas['id_kelas']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data kelas ini?')"
                                >
                                    Hapus
                                </a>


                            </td>


                        </tr>


                        <!-- =================================================
                             MODAL EDIT
                             ================================================= -->

                        <div
                            class="modal fade"
                            id="modalEdit<?= $kelas['id_kelas']; ?>"
                            tabindex="-1"
                        >

                            <div class="modal-dialog">

                                <div class="modal-content">


                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            Edit Data Kelas

                                        </h5>


                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                        ></button>

                                    </div>


                                    <form
                                        method="POST"
                                        action="/UKK-2026/menu3.php"
                                    >


                                        <div class="modal-body">


                                            <input
                                                type="hidden"
                                                name="id_kelas"
                                                value="<?= $kelas['id_kelas']; ?>"
                                            >


                                            <!-- NAMA KELAS -->

                                            <div class="mb-3">

                                                <label
                                                    class="form-label"
                                                >
                                                    Nama Kelas
                                                </label>


                                                <input
                                                    type="text"
                                                    name="nama_kelas"
                                                    class="form-control"
                                                    value="<?= htmlspecialchars($kelas['nama_kelas']); ?>"
                                                    required
                                                >

                                            </div>


                                            <!-- JURUSAN -->

                                            <div class="mb-3">

                                                <label
                                                    class="form-label"
                                                >
                                                    Jurusan
                                                </label>


                                                <input
                                                    type="text"
                                                    name="jurusan"
                                                    class="form-control"
                                                    value="<?= htmlspecialchars($kelas['jurusan']); ?>"
                                                    required
                                                >

                                            </div>


                                            <!-- WALI KELAS -->

                                            <div class="mb-3">

                                                <label
                                                    class="form-label"
                                                >
                                                    Wali Kelas
                                                </label>


                                                <input
                                                    type="text"
                                                    name="wali_kelas"
                                                    class="form-control"
                                                    value="<?= htmlspecialchars($kelas['wali_kelas']); ?>"
                                                    required
                                                >

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
                                                name="edit"
                                                class="btn btn-primary"
                                            >
                                                Simpan Perubahan
                                            </button>


                                        </div>


                                    </form>


                                </div>

                            </div>

                        </div>


                    <?php

                        endwhile;


                    else:

                    ?>


                        <tr>

                            <td
                                colspan="5"
                                class="text-center
                                       text-secondary
                                       py-4"
                            >

                                Belum ada data kelas.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>


        </div>

    </div>

</div>



<!-- =====================================================
     MODAL TAMBAH KELAS
     ===================================================== -->

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
>


    <div class="modal-dialog">


        <div class="modal-content">


            <div class="modal-header">


                <h5 class="modal-title">

                    Tambah Data Kelas

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>


            </div>


            <form
                method="POST"
                action="/UKK-2026/menu3.php"
            >


                <div class="modal-body">


                    <!-- NAMA KELAS -->

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Kelas

                        </label>


                        <input
                            type="text"
                            name="nama_kelas"
                            class="form-control"
                            placeholder="Contoh: XI RPL 1"
                            required
                        >

                    </div>


                    <!-- JURUSAN -->

                    <div class="mb-3">

                        <label class="form-label">

                            Jurusan

                        </label>


                        <select
                            name="jurusan"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Jurusan --
                            </option>

                            <option value="RPL">
                                Rekayasa Perangkat Lunak
                            </option>

                            <option value="TKJ">
                                Teknik Komputer dan Jaringan
                            </option>

                            <option value="AKL">
                                Akuntansi dan Keuangan Lembaga
                            </option>

                            <option value="OTKP">
                                Otomatisasi dan Tata Kelola Perkantoran
                            </option>

                            <option value="BDP">
                                Bisnis Daring dan Pemasaran
                            </option>

                        </select>

                    </div>


                    <!-- WALI KELAS -->

                    <div class="mb-3">

                        <label class="form-label">

                            Wali Kelas

                        </label>


                        <input
                            type="text"
                            name="wali_kelas"
                            class="form-control"
                            placeholder="Nama wali kelas"
                            required
                        >

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



<!-- =====================================================
     BOOTSTRAP JAVASCRIPT
     ===================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>