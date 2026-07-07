<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/Database.php";
require_once "../models/Prestasi.php";

$db = new Database();
$conn = $db->connect();

$prestasi = new Prestasi($conn);

$user_id = $_SESSION['user_id'];

$id = $_GET['id'];

$data = $prestasi->getById($id, $user_id);

if ($data->num_rows == 0) {
    die("Data tidak ditemukan atau bukan milik Anda.");
}

$row = $data->fetch_assoc();

include "layout/header.php";
include "layout/sidebar.php";

?>

<div class="content">

<?php include "layout/navbar.php"; ?>

<div class="card-dashboard">

<h3>Edit Prestasi</h3>

<hr>

<form
method="POST"
action="../controllers/UpdatePrestasi.php">

<input
type="hidden"
name="id"
value="<?= $row['id']; ?>">

<div class="mb-3">

<label>Nama Prestasi</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $row['nama_prestasi']; ?>"
required>

</div>

<div class="mb-3">

<label>Tingkat</label>

<select
name="tingkat"
class="form-control">

<option <?= $row['tingkat']=="Kampus" ? "selected" : "" ?>>Kampus</option>

<option <?= $row['tingkat']=="Kabupaten" ? "selected" : "" ?>>Kabupaten</option>

<option <?= $row['tingkat']=="Provinsi" ? "selected" : "" ?>>Provinsi</option>

<option <?= $row['tingkat']=="Nasional" ? "selected" : "" ?>>Nasional</option>

<option <?= $row['tingkat']=="Internasional" ? "selected" : "" ?>>Internasional</option>

</select>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
rows="4"><?= $row['deskripsi']; ?></textarea>

</div>

<div class="mb-3">

<label>Tahun</label>

<input
type="number"
name="tahun"
class="form-control"
value="<?= $row['tahun']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

Update Prestasi

</button>

<a
href="prestasi.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

<?php include "layout/footer.php"; ?>