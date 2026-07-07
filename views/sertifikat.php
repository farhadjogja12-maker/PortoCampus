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

$data = $sertifikat->tampil($user_id);

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div
        class="card-dashboard mb-4"
        style="background:linear-gradient(135deg,#2563eb,#4f46e5);color:white;"
        data-aos="fade-down">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-1">

                    <i class="bi bi-award-fill"></i>

                    Kelola Sertifikat

                </h2>

                <p class="mb-0">

                    Simpan seluruh sertifikat akademik maupun non akademik.

                </p>

            </div>

            <i
                class="bi bi-file-earmark-pdf-fill"
                style="font-size:70px;opacity:.25;">

            </i>

        </div>

    </div>

    <div
        class="card-dashboard mb-4"
        data-aos="fade-up">

        <h4 class="mb-4 fw-bold">

            <i class="bi bi-plus-circle-fill text-success"></i>

            Tambah Sertifikat

        </h4>

        <form
            method="POST"
            action="../controllers/SertifikatController.php"
            enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Nama Sertifikat</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Contoh: Dicoding Dasar Web"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Penyelenggara</label>

                    <input
                        type="text"
                        name="penyelenggara"
                        class="form-control"
                        placeholder="Contoh: Dicoding"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="fw-semibold">Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        placeholder="2026"
                        required>

                </div>

                <div class="col-md-8 mb-3">

                    <label class="fw-semibold">Upload PDF</label>

                    <input
                        type="file"
                        name="file_pdf"
                        class="form-control"
                        accept=".pdf">

                </div>

            </div>

            <button
                class="btn btn-success"
                name="simpan">

                <i class="bi bi-plus-circle-fill"></i>

                Simpan Sertifikat

            </button>

        </form>

    </div>
    <div
        class="card-dashboard"
        data-aos="zoom-in">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold">

                <i class="bi bi-table"></i>

                Daftar Sertifikat

            </h4>

            <span class="badge bg-primary fs-6">

                <?= $data->num_rows; ?> Data

            </span>

        </div>

        <table class="table table-hover align-middle datatable">

            <thead>

                <tr>

                    <th width="70">ID</th>

                    <th>Nama Sertifikat</th>

                    <th>Penyelenggara</th>

                    <th width="100">Tahun</th>

                    <th width="120">PDF</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php while ($row = $data->fetch_assoc()) { ?>

                    <tr>

                        <td>

                            <span class="badge bg-dark">

                                <?= $row['id']; ?>

                            </span>

                        </td>

                        <td>

                            <strong>

                                <?= $row['nama_sertifikat']; ?>

                            </strong>

                        </td>

                        <td>

                            <?= $row['penyelenggara']; ?>

                        </td>

                        <td>

                            <?= $row['tahun']; ?>

                        </td>

                        <td>

                            <?php if (!empty($row['file_pdf'])) { ?>

                                <a

                                    href="../assets/uploads/sertifikat/<?= $row['file_pdf']; ?>"

                                    target="_blank"

                                    class="btn btn-info btn-sm">

                                    <i class="bi bi-file-earmark-pdf-fill"></i>

                                    Lihat

                                </a>

                            <?php } else { ?>

                                <span class="badge bg-secondary">

                                    Tidak Ada

                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <a

                                href="edit_sertifikat.php?id=<?= $row['id']; ?>"

                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-fill"></i>

                            </a>

                            <a

                                href="../controllers/HapusSertifikat.php?id=<?= $row['id']; ?>"

                                class="btn btn-danger btn-sm btn-hapus">

                                <i class="bi bi-trash-fill"></i>

                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php include "layout/footer.php"; ?>