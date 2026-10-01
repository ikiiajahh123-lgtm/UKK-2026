<?php

include "includes/cek_session.php";
include "config/koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>About Me</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<div class="container-fluid">

    <div class="row min-vh-100">


        <!-- =========================================
             SIDEBAR
             ========================================= -->

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
                    class="nav-link text-white"
                >
                    Laporan
                </a>


                <!-- ABOUT ME AKTIF -->

                <a
                    href="about.php"
                    class="nav-link active bg-primary"
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


        <!-- =========================================
             KONTEN ABOUT ME
             ========================================= -->

        <div class="col-md-9 col-lg-10 bg-light p-4">


            <!-- JUDUL -->

            <div class="mb-4">

                <h2 class="fw-bold">
                    About Me
                </h2>

                <p class="text-secondary">
                    Informasi tentang pembuat website
                </p>

            </div>


            <!-- =========================================
                 CARD PROFILE
                 ========================================= -->

            <div class="row justify-content-center">


                <div class="col-md-8 col-lg-6">


                    <div class="card shadow-sm border-0">


                        <!-- FOTO RANDOM -->

                        <img
                            src="https://picsum.photos/600/400"
                            class="card-img-top"
                            alt="Foto Profil"
                        >


                        <div class="card-body text-center p-4">


                            <h3 class="fw-bold">
                                Rizki
                            </h3>


                            <p class="text-primary fw-semibold">
                                Web Developer
                            </p>


                            <p class="text-secondary">

                                Halo! Nama saya Rizki.
                                Saya adalah pembuat website
                                sistem informasi sekolah ini.

                            </p>


                            <hr>


                            <!-- INFORMASI -->

                            <div class="text-start">


                                <div class="mb-3">

                                    <h6 class="fw-bold">
                                        Nama
                                    </h6>

                                    <p class="text-secondary mb-0">
                                        Rizki
                                    </p>

                                </div>


                                <div class="mb-3">

                                    <h6 class="fw-bold">
                                        Sekolah
                                    </h6>

                                    <p class="text-secondary mb-0">
                                        SMK Muhammadiyah
                                    </p>

                                </div>


                                <div class="mb-3">

                                    <h6 class="fw-bold">
                                        Keahlian
                                    </h6>

                                    <p class="text-secondary mb-0">
                                        HTML, CSS, PHP, MySQL
                                    </p>

                                </div>


                                <div class="mb-3">

                                    <h6 class="fw-bold">
                                        Hobi
                                    </h6>

                                    <p class="text-secondary mb-0">
                                        Coding, belajar teknologi,
                                        dan membuat website
                                    </p>

                                </div>


                            </div>


                            <!-- TOMBOL -->

                            <div class="mt-4">

                                <a
                                    href="dashboard.php"
                                    class="btn btn-primary"
                                >
                                    Kembali ke Dashboard
                                </a>

                            </div>


                        </div>

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