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
SELECT COUNT(*) total
FROM sertifikat
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$jmlPrestasi = $conn->query("
SELECT COUNT(*) total
FROM prestasi
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$jmlProyek = $conn->query("
SELECT COUNT(*) total
FROM proyek
WHERE user_id='$user_id'
")->fetch_assoc()['total'];

$totalData = $jmlSertifikat + $jmlPrestasi + $jmlProyek;
$progress = min(100, $totalData * 10);

$fotoPath = "../assets/uploads/profil/" . $user['foto'];

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div
        class="card-dashboard mb-4"
        style="background:linear-gradient(135deg,#2563eb,#4f46e5);color:white;"
        data-aos="fade-down">

        <div class="row align-items-center">

            <div class="col-md-3 text-center">

                <?php if (!empty($user['foto']) && file_exists($fotoPath)) { ?>

                    <img
                        src="<?= $fotoPath; ?>"
                        class="rounded-circle shadow"
                        style="width:190px;height:190px;object-fit:cover;border:6px solid rgba(255,255,255,.35);">

                <?php } else { ?>

                    <img
                        src="https://ui-avatars.com/api/?name=<?= urlencode($user['nama']) ?>&background=ffffff&color=2563eb&size=256"
                        class="rounded-circle shadow"
                        style="width:190px;height:190px;object-fit:cover;border:6px solid rgba(255,255,255,.35);">

                <?php } ?>

            </div>

            <div class="col-md-9">

                <span class="badge bg-light text-primary mb-3">

                    Mahasiswa Aktif

                </span>

                <h2 class="fw-bold mb-2">

                    <?= $user['nama']; ?>

                </h2>

                <p class="mb-1">

                    <i class="bi bi-person-badge-fill"></i>

                    NIM: <?= $user['nim']; ?>

                </p>

                <p class="mb-3">

                    <i class="bi bi-envelope-fill"></i>

                    <?= $user['email']; ?>

                </p>

                <div class="mb-2">

                    Kelengkapan Portofolio

                    <span class="float-end">

                        <?= $progress; ?>%

                    </span>

                </div>

                <div class="progress-modern mb-4">

                    <div style="width:<?= $progress; ?>%;"></div>

                </div>

                <a
                    href="edit_profil.php"
                    class="btn btn-light text-primary">

                    <i class="bi bi-pencil-fill"></i>

                    Edit Profil

                </a>

            </div>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <div class="stat-card">

                <h5>Sertifikat</h5>

                <h2><?= $jmlSertifikat ?></h2>

                <p>Total sertifikat</p>

                <i class="bi bi-award-fill"></i>

            </div>

        </div>
        <div class="col-md-4 mb-3">

            <div
                class="stat-card"
                style="background:linear-gradient(135deg,#ec4899,#db2777);">

                <h5>Prestasi</h5>

                <h2><?= $jmlPrestasi ?></h2>

                <p>Total prestasi</p>

                <i class="bi bi-trophy-fill"></i>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div
                class="stat-card"
                style="background:linear-gradient(135deg,#10b981,#059669);">

                <h5>Proyek</h5>

                <h2><?= $jmlProyek ?></h2>

                <p>Total proyek</p>

                <i class="bi bi-laptop-fill"></i>

            </div>

        </div>

    </div>

    <div class="card-dashboard" data-aos="fade-up">

        <h4 class="fw-bold mb-4">

            <i class="bi bi-person-vcard-fill"></i>

            Informasi Akun

        </h4>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <tr>

                    <th width="250">ID User</th>

                    <td><?= $user['id']; ?></td>

                </tr>

                <tr>

                    <th>Nama Lengkap</th>

                    <td><?= $user['nama']; ?></td>

                </tr>

                <tr>

                    <th>NIM</th>

                    <td><?= $user['nim']; ?></td>

                </tr>

                <tr>

                    <th>Email</th>

                    <td><?= $user['email']; ?></td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        <span class="badge bg-success">

                            Mahasiswa Aktif

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Tanggal Bergabung</th>

                    <td><?= date('d F Y H:i', strtotime($user['created_at'])); ?></td>

                </tr>

                <tr>

                    <th>Kelengkapan Portfolio</th>

                    <td>

                        <?= $progress; ?>%

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

<?php include "layout/footer.php"; ?>