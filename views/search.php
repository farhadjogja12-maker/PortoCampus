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
$q = $_GET['q'] ?? "";

$sertifikat = $conn->query("
SELECT 'Sertifikat' AS tipe, nama_sertifikat AS nama, penyelenggara AS info, tahun
FROM sertifikat
WHERE user_id='$user_id'
AND nama_sertifikat LIKE '%$q%'
");

$prestasi = $conn->query("
SELECT 'Prestasi' AS tipe, nama_prestasi AS nama, tingkat AS info, tahun
FROM prestasi
WHERE user_id='$user_id'
AND nama_prestasi LIKE '%$q%'
");

$proyek = $conn->query("
SELECT 'Proyek' AS tipe, nama_proyek AS nama, mata_kuliah AS info, tahun
FROM proyek
WHERE user_id='$user_id'
AND nama_proyek LIKE '%$q%'
");

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

<?php include "layout/navbar.php"; ?>

<div class="v5-hero mb-4">
<h1>Hasil Pencarian</h1>
<p class="mb-0">Keyword: <b><?= $q; ?></b></p>
</div>

<div class="v5-card">

<h4 class="fw-bold mb-4">
<i class="bi bi-search"></i>
Hasil ditemukan
</h4>

<?php while($row=$sertifikat->fetch_assoc()){ ?>
<div class="activity-card">
<strong><?= $row['nama']; ?></strong><br>
<small class="text-muted"><?= $row['tipe']; ?> • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
</div>
<?php } ?>

<?php while($row=$prestasi->fetch_assoc()){ ?>
<div class="activity-card">
<strong><?= $row['nama']; ?></strong><br>
<small class="text-muted"><?= $row['tipe']; ?> • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
</div>
<?php } ?>

<?php while($row=$proyek->fetch_assoc()){ ?>
<div class="activity-card">
<strong><?= $row['nama']; ?></strong><br>
<small class="text-muted"><?= $row['tipe']; ?> • <?= $row['info']; ?> • <?= $row['tahun']; ?></small>
</div>
<?php } ?>

</div>

</div>

<?php include "layout/footer.php"; ?>