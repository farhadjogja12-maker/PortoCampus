<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$user_id = $_SESSION['user_id'];

$user = $conn->query("
SELECT *
FROM users
WHERE id='$user_id'
")->fetch_assoc();

$jmlSertifikat = $conn->query("
SELECT COUNT(*) AS total
FROM sertifikat
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$jmlPrestasi = $conn->query("
SELECT COUNT(*) AS total
FROM prestasi
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$jmlProyek = $conn->query("
SELECT COUNT(*) AS total
FROM proyek
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$totalData = $jmlSertifikat + $jmlPrestasi + $jmlProyek;
$progress = min(100, $totalData * 10);

$sertifikatTerbaru = $conn->query("
SELECT nama_sertifikat AS nama, penyelenggara AS info, tahun
FROM sertifikat
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 2
");

$prestasiTerbaru = $conn->query("
SELECT nama_prestasi AS nama, tingkat AS info, tahun
FROM prestasi
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 2
");

$proyekTerbaru = $conn->query("
SELECT nama_proyek AS nama, mata_kuliah AS info, tahun
FROM proyek
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 2
");

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div class="v5-hero mb-4" data-aos="fade-down">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="badge bg-light text-primary mb-3">
                    PortoCampus V5
                </span>

                <h1>
                    Halo, <?= $user['nama']; ?> 👋
                </h1>

                <p class="mb-4">
                    Kelola sertifikat, prestasi, dan proyek kuliahmu dalam satu dashboard modern.
                </p>

                <div class="mb-2">
                    Portfolio Progress
                    <span class="float-end"><?= $progress; ?>%</span>
                </div>

                <div class="progress-modern mb-4">
                    <div style="width:<?= $progress; ?>%;"></div>
                </div>

                <a href="profil.php" class="btn btn-light text-primary me-2">
                    <i class="bi bi-person-circle"></i>
                    Profil Saya
                </a>

                <a href="laporan.php" class="btn btn-outline-light">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    Laporan
                </a>

            </div>

            <div class="col-lg-4 text-center d-none d-lg-block">

                <i class="bi bi-rocket-takeoff-fill" style="font-size:130px;opacity:.25;"></i>

            </div>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-lg-4 mb-3">

            <div class="stat-card">

                <h5>Sertifikat</h5>

                <h2><?= $jmlSertifikat ?></h2>

                <p>Total Sertifikat</p>

                <i class="bi bi-award-fill"></i>

            </div>

        </div>

        <div class="col-lg-4 mb-3">

            <div class="stat-card" style="background:linear-gradient(135deg,#ec4899,#db2777);">

                <h5>Prestasi</h5>

                <h2><?= $jmlPrestasi ?></h2>

                <p>Total Prestasi</p>

                <i class="bi bi-trophy-fill"></i>

            </div>

        </div>

        <div class="col-lg-4 mb-3">

            <div class="stat-card" style="background:linear-gradient(135deg,#10b981,#059669);">

                <h5>Proyek</h5>

                <h2><?= $jmlProyek ?></h2>

                <p>Total Proyek</p>

                <i class="bi bi-laptop-fill"></i>

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">

            <div class="v5-card">

                <h4 class="fw-bold mb-4">
                    <i class="bi bi-bar-chart-fill"></i>
                    Statistik Portofolio
                </h4>

                <canvas id="chartDashboard" height="120"></canvas>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="v5-card">

                <h4 class="fw-bold mb-4">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Quick Action
                </h4>

                <a href="sertifikat.php" class="v5-action">
                    <i class="bi bi-award-fill"></i>
                    <div>
                        <strong>Tambah Sertifikat</strong>
                        <br>
                        <small class="text-muted">Input sertifikat baru</small>
                    </div>
                </a>

                <a href="prestasi.php" class="v5-action">
                    <i class="bi bi-trophy-fill"></i>
                    <div>
                        <strong>Tambah Prestasi</strong>
                        <br>
                        <small class="text-muted">Catat prestasi mahasiswa</small>
                    </div>
                </a>

                <a href="proyek.php" class="v5-action">
                    <i class="bi bi-laptop-fill"></i>
                    <div>
                        <strong>Tambah Proyek</strong>
                        <br>
                        <small class="text-muted">Kelola proyek kuliah</small>
                    </div>
                </a>

                <a href="laporan.php" class="v5-action">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    <div>
                        <strong>Lihat Laporan</strong>
                        <br>
                        <small class="text-muted">Cetak portofolio</small>
                    </div>
                </a>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 mb-4">

            <div class="v5-card">

                <h4 class="fw-bold mb-4">
                    <i class="bi bi-clock-history"></i>
                    Aktivitas Terbaru
                </h4>

                <div class="v5-timeline">

                    <?php while ($row = $sertifikatTerbaru->fetch_assoc()) { ?>
                        <div class="v5-timeline-item">
                            <strong><?= $row['nama']; ?></strong>
                            <br>
                            <small class="text-muted">Sertifikat • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
                        </div>
                    <?php } ?>

                    <?php while ($row = $prestasiTerbaru->fetch_assoc()) { ?>
                        <div class="v5-timeline-item">
                            <strong><?= $row['nama']; ?></strong>
                            <br>
                            <small class="text-muted">Prestasi • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
                        </div>
                    <?php } ?>

                    <?php while ($row = $proyekTerbaru->fetch_assoc()) { ?>
                        <div class="v5-timeline-item">
                            <strong><?= $row['nama']; ?></strong>
                            <br>
                            <small class="text-muted">Proyek • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
                        </div>
                    <?php } ?>

                    <?php if ($totalData == 0) { ?>
                        <p class="text-muted mb-0">
                            Belum ada aktivitas. Mulai tambahkan sertifikat, prestasi, atau proyek.
                        </p>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <script>
        const ctx = document.getElementById("chartDashboard");

        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Sertifikat", "Prestasi", "Proyek"],
                datasets: [{
                    data: [<?= $jmlSertifikat ?>, <?= $jmlPrestasi ?>, <?= $jmlProyek ?>],
                    backgroundColor: ["#2563eb", "#ec4899", "#10b981"],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "bottom"
                    }
                }
            }
        });
    </script>

</div>

<?php include "layout/footer.php"; ?>