<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/Database.php";
require_once "../models/Sertifikat.php";

$db = new Database();
$conn = $db->connect();

$sertifikat = new Sertifikat($conn);

$user_id = $_SESSION['user_id'];

$id = $_GET['id'];

$data = $sertifikat->getById($id, $user_id);

if ($data->num_rows == 0) {
    die("Data tidak ditemukan atau bukan milik Anda.");
}

$row = $data->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Sertifikat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h2>Edit Sertifikat</h2>

        <hr>

        <form
            method="POST"
            action="../controllers/UpdateSertifikat.php"
            enctype="multipart/form-data">

            <input
                type="hidden"
                name="id"
                value="<?= $row['id']; ?>">

            <div class="mb-3">

                <label>Nama Sertifikat</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="<?= $row['nama_sertifikat']; ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Penyelenggara</label>

                <input
                    type="text"
                    name="penyelenggara"
                    class="form-control"
                    value="<?= $row['penyelenggara']; ?>"
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

                <label>PDF Saat Ini</label>

                <br>

                <?php if (!empty($row['file_pdf'])) { ?>

                    <a
                        href="../assets/uploads/sertifikat/<?= $row['file_pdf']; ?>"
                        target="_blank"
                        class="btn btn-info">

                        Lihat PDF

                    </a>

                <?php } else { ?>

                    <span class="text-danger">

                        Belum ada PDF

                    </span>

                <?php } ?>

            </div>

            <div class="mb-3">

                <label>Ganti PDF</label>

                <input
                    type="file"
                    name="file_pdf"
                    class="form-control"
                    accept=".pdf">

            </div>

            <button
                type="submit"
                name="update"
                class="btn btn-primary">

                Update

            </button>

            <a
                href="sertifikat.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</body>

</html>