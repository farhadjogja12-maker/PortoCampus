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

$data = $prestasi->tampil($user_id);

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div
        class="card-dashboard mb-4"
        style="background:linear-gradient(135deg,#ec4899,#db2777);color:white;"
        data-aos="fade-down">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-1">

                    <i class="bi bi-trophy-fill"></i>

                    Kelola Prestasi

                </h2>

                <p class="mb-0">

                    Catat seluruh prestasi akademik maupun non akademik.

                </p>

            </div>

            <i
                class="bi bi-trophy-fill"
                style="font-size:70px;opacity:.25;">

            </i>

        </div>

    </div>

    <div
        class="card-dashboard mb-4"
        data-aos="fade-up">

        <h4 class="mb-4 fw-bold">

            <i class="bi bi-plus-circle-fill text-primary"></i>

            Tambah Prestasi

        </h4>

        <form action="../controllers/TambahPrestasi.php" method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Nama Prestasi</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Contoh: Juara 1 Lomba Web"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Tingkat</label>

                    <input
                        type="text"
                        name="tingkat"
                        class="form-control"
                        placeholder="Contoh: Nasional"
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

                    <label class="fw-semibold">Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="1"
                        placeholder="Tuliskan deskripsi singkat prestasi"></textarea>

                </div>

            </div>

            <button
                class="btn btn-primary"
                name="simpan">

                <i class="bi bi-plus-circle-fill"></i>

                Simpan Prestasi

            </button>

        </form>

    </div>
    <div
        class="card-dashboard"
        data-aos="zoom-in">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold">

                <i class="bi bi-table"></i>

                Daftar Prestasi

            </h4>

            <span class="badge bg-primary fs-6">

                <?= $data->num_rows; ?> Data

            </span>

        </div>

        <table class="table table-hover align-middle datatable">

            <thead>

                <tr>

                    <th width="70">ID</th>

                    <th>Nama Prestasi</th>

                    <th>Tingkat</th>

                    <th width="100">Tahun</th>

                    <th>Deskripsi</th>

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

                                <?= $row['nama_prestasi']; ?>

                            </strong>

                        </td>

                        <td>

                            <span class="badge bg-info">

                                <?= $row['tingkat']; ?>

                            </span>

                        </td>

                        <td>

                            <?= $row['tahun']; ?>

                        </td>

                        <td>

                            <?= $row['deskripsi']; ?>

                        </td>

                        <td>

                            <a
                                href="edit_prestasi.php?id=<?= $row['id']; ?>"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-fill"></i>

                            </a>

                            <a
                                href="../controllers/HapusPrestasi.php?id=<?= $row['id']; ?>"
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