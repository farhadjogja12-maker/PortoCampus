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

$data = $proyek->tampil($user_id);

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div
        class="card-dashboard mb-4"
        style="background:linear-gradient(135deg,#10b981,#059669);color:white;"
        data-aos="fade-down">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-1">

                    <i class="bi bi-laptop-fill"></i>

                    Kelola Proyek

                </h2>

                <p class="mb-0">

                    Kelola proyek kuliah, aplikasi, dan portofolio digitalmu.

                </p>

            </div>

            <i
                class="bi bi-code-slash"
                style="font-size:70px;opacity:.25;">

            </i>

        </div>

    </div>

    <div
        class="card-dashboard mb-4"
        data-aos="fade-up">

        <h4 class="mb-4 fw-bold">

            <i class="bi bi-plus-circle-fill text-success"></i>

            Tambah Proyek

        </h4>

        <form action="../controllers/TambahProyek.php" method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Nama Proyek</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Contoh: Website Portofolio"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="fw-semibold">Mata Kuliah</label>

                    <input
                        type="text"
                        name="matkul"
                        class="form-control"
                        placeholder="Contoh: Pemrograman Web"
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

                    <label class="fw-semibold">Github</label>

                    <input
                        type="text"
                        name="github"
                        class="form-control"
                        placeholder="https://github.com/username/project">

                </div>

                <div class="col-12 mb-3">

                    <label class="fw-semibold">Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="3"
                        placeholder="Tuliskan deskripsi singkat proyek"></textarea>

                </div>

            </div>

            <button
                class="btn btn-warning text-dark"
                name="simpan">

                <i class="bi bi-plus-circle-fill"></i>

                Simpan Proyek

            </button>

        </form>

    </div>
    <div
        class="card-dashboard"
        data-aos="zoom-in">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold">

                <i class="bi bi-table"></i>

                Daftar Proyek

            </h4>

            <span class="badge bg-success fs-6">

                <?= $data->num_rows; ?> Data

            </span>

        </div>

        <table class="table table-hover align-middle datatable">

            <thead>

                <tr>

                    <th width="70">ID</th>

                    <th>Nama Proyek</th>

                    <th>Mata Kuliah</th>

                    <th width="100">Tahun</th>

                    <th width="130">Github</th>

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
                                <?= $row['nama_proyek']; ?>
                            </strong>
                        </td>

                        <td>
                            <?= $row['mata_kuliah']; ?>
                        </td>

                        <td>
                            <?= $row['tahun']; ?>
                        </td>

                        <td>

                            <?php if (!empty($row['github'])) { ?>

                                <a
                                    href="<?= $row['github']; ?>"
                                    target="_blank"
                                    class="btn btn-dark btn-sm">

                                    <i class="bi bi-github"></i>

                                    Github

                                </a>

                            <?php } else { ?>

                                <span class="badge bg-secondary">

                                    Tidak Ada

                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <a
                                href="edit_proyek.php?id=<?= $row['id']; ?>"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-fill"></i>

                            </a>

                            <a
                                href="../controllers/HapusProyek.php?id=<?= $row['id']; ?>"
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