<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: views/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PortoCampus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: Poppins, sans-serif;
        }

        body {
            background: #f5f8ff;
        }

        .navbar {
            padding: 18px 0;
        }

        .hero {

            padding: 90px 0;

        }

        .hero h1 {

            font-size: 58px;

            font-weight: 700;

            color: #1e293b;

        }

        .hero span {

            color: #2563eb;

        }

        .hero p {

            font-size: 20px;

            color: #64748b;

            margin-top: 20px;

        }

        .btn-main {

            background: #2563eb;

            color: white;

            padding: 15px 35px;

            border-radius: 15px;

            font-weight: 600;

            text-decoration: none;

            margin-right: 15px;

        }

        .btn-main:hover {

            background: #1d4ed8;

            color: white;

        }

        .btn-outline-main {

            border: 2px solid #2563eb;

            color: #2563eb;

            padding: 15px 35px;

            border-radius: 15px;

            text-decoration: none;

            font-weight: 600;

        }

        .hero-img {

            width: 100%;

            animation: float 3s ease-in-out infinite;

        }

        @keyframes float {

            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0);
            }

        }

        .feature-card {

            background: white;

            padding: 30px;

            border-radius: 20px;

            box-shadow: 0 15px 40px rgba(0, 0, 0, .08);

            transition: .3s;

            height: 100%;

        }

        .feature-card:hover {

            transform: translateY(-8px);

        }

        .feature-card i {

            font-size: 48px;

            color: #2563eb;

            margin-bottom: 15px;

        }

        .stats {

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            padding: 70px 0;

            color: white;

            margin-top: 90px;

        }

        .stats h2 {

            font-size: 50px;

            font-weight: bold;

        }

        footer {

            padding: 35px;

            text-align: center;

            color: #64748b;

        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">

        <div class="container">

            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-mortarboard-fill"></i>
                PortoCampus
            </a>

            <div>

                <a href="views/login.php" class="btn btn-outline-primary me-2">
                    Login
                </a>

                <a href="views/register.php" class="btn btn-primary">
                    Daftar
                </a>

            </div>

        </div>

    </nav>

    <section class="hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h1>
                        Kelola <span>Portofolio Digital</span> Mahasiswa
                    </h1>

                    <p>
                        Simpan sertifikat, prestasi, dan proyek kuliah dalam satu sistem modern yang mudah digunakan.
                    </p>

                    <div class="mt-4">

                        <a href="views/login.php" class="btn-main">
                            Mulai Sekarang
                        </a>

                        <a href="#fitur" class="btn-outline-main">
                            Lihat Fitur
                        </a>

                    </div>

                </div>

                <div class="col-lg-6 text-center">

                    <i class="bi bi-laptop-fill text-primary" style="font-size:260px;"></i>

                </div>

            </div>

        </div>

    </section>

    <section id="fitur" class="container my-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Fitur Utama
            </h2>

            <p class="text-muted">
                Semua kebutuhan portofolio mahasiswa dalam satu aplikasi.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="feature-card text-center">

                    <i class="bi bi-award-fill"></i>

                    <h4>Sertifikat</h4>

                    <p class="text-muted">
                        Kelola sertifikat seminar, pelatihan, dan kompetisi.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card text-center">

                    <i class="bi bi-trophy-fill"></i>

                    <h4>Prestasi</h4>

                    <p class="text-muted">
                        Catat prestasi akademik maupun non-akademik.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card text-center">

                    <i class="bi bi-laptop-fill"></i>

                    <h4>Proyek</h4>

                    <p class="text-muted">
                        Dokumentasikan proyek kuliah dan link GitHub.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section class="stats">

        <div class="container">

            <div class="row text-center">

                <div class="col-md-4">

                    <h2>100%</h2>

                    <p>Multi User</p>

                </div>

                <div class="col-md-4">

                    <h2>3</h2>

                    <p>Modul Utama</p>

                </div>

                <div class="col-md-4">

                    <h2>V4</h2>

                    <p>Premium UI</p>

                </div>

            </div>

        </div>

    </section>

    <footer>

        <b>PortoCampus</b>

        <br>

        Sistem Pengelolaan Portofolio Digital Mahasiswa

        <br>

        <small>
            © <?= date('Y'); ?> PortoCampus. All Rights Reserved.
        </small>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>