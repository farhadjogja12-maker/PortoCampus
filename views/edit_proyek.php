<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/Database.php";
require_once "../models/Proyek.php";

$db = new Database();
$conn = $db->connect();

$proyek = new Proyek($conn);

$user_id = $_SESSION['user_id'];

$id = $_GET['id'];

$data = $proyek->getById($id, $user_id);

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

        <h3>Edit Proyek</h3>

        <hr>

        <form method="POST" action="../controllers/UpdateProyek.php">

            <input
                type="hidden"
                name="id"
                value="<?= $row['id']; ?>">

            <div class="mb-3">

                <label>Nama Proyek</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="<?= $row['nama_proyek']; ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Mata Kuliah</label>

                <input
                    type="text"
                    name="matkul"
                    class="form-control"
                    value="<?= $row['mata_kuliah']; ?>"
                    required>

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

            <div class="mb-3">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="4"><?= $row['deskripsi']; ?></textarea>

            </div>

            <div class="mb-3">

                <label>Link Github</label>

                <input
                    type="text"
                    name="github"
                    class="form-control"
                    value="<?= $row['github']; ?>">

            </div>

            <button
                type="submit"
                name="update"
                class="btn btn-primary">

                Update Proyek

            </button>

            <a
                href="proyek.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

<?php include "layout/footer.php"; ?>