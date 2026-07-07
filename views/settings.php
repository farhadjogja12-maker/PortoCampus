<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div
        class="card-dashboard mb-4"
        style="background:linear-gradient(135deg,var(--primary),var(--secondary));color:white;"
        data-aos="fade-down">

        <h2 class="fw-bold">
            <i class="bi bi-gear-fill"></i>
            Settings
        </h2>

        <p class="mb-0">
            Atur tampilan, akun, dan preferensi PortoCampus.
        </p>

    </div>

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card-dashboard">

                <h4 class="fw-bold mb-3">
                    <i class="bi bi-palette-fill text-primary"></i>
                    Tema Aplikasi
                </h4>

                <p class="text-muted">
                    Pilih warna tampilan PortoCampus sesuai preferensi.
                </p>

                <div class="row g-3">

                    <div class="col-6">
                        <button class="btn btn-primary w-100" onclick="setTheme('blue')">
                            🔵 Blue
                        </button>
                    </div>

                    <div class="col-6">
                        <button class="btn btn-dark w-100" onclick="setTheme('dark')">
                            🌙 Dark
                        </button>
                    </div>

                    <div class="col-6">
                        <button class="btn w-100 text-white" style="background:#7c3aed;" onclick="setTheme('purple')">
                            🟣 Purple
                        </button>
                    </div>

                    <div class="col-6">
                        <button class="btn w-100 text-white" style="background:#10b981;" onclick="setTheme('emerald')">
                            🟢 Emerald
                        </button>
                    </div>

                    <div class="col-12">
                        <button class="btn w-100 text-white" style="background:#ea580c;" onclick="setTheme('orange')">
                            🟠 Orange
                        </button>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card-dashboard">

                <h4 class="fw-bold mb-3">
                    <i class="bi bi-person-circle text-success"></i>
                    Pengaturan Akun
                </h4>

                <p class="text-muted">
                    Ubah profil, NIM, email, password, dan foto akun.
                </p>

                <a href="edit_profil.php" class="btn btn-primary">
                    <i class="bi bi-pencil-fill"></i>
                    Edit Profil
                </a>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card-dashboard">

                <h4 class="fw-bold mb-3">
                    <i class="bi bi-shield-lock-fill text-warning"></i>
                    Keamanan
                </h4>

                <p class="text-muted">
                    Pastikan password akun tidak mudah ditebak.
                </p>

                <span class="badge bg-success">
                    Akun Aktif
                </span>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card-dashboard">

                <h4 class="fw-bold mb-3">
                    <i class="bi bi-info-circle-fill text-danger"></i>
                    Tentang PortoCampus
                </h4>

                <p class="text-muted">
                    PortoCampus adalah sistem pengelolaan portofolio digital mahasiswa berbasis web.
                </p>

                <span class="badge bg-dark">
                    Version 4.0
                </span>

            </div>

        </div>

    </div>

</div>

<?php include "layout/footer.php"; ?>