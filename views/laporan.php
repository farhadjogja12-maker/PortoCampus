<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$sertifikat = $conn->query("SELECT * FROM sertifikat ORDER BY id DESC");
$prestasi   = $conn->query("SELECT * FROM prestasi ORDER BY id DESC");
$proyek     = $conn->query("SELECT * FROM proyek ORDER BY id DESC");

include "layout/header.php";
include "layout/sidebar.php";
?>

<div class="content">

    <?php include "layout/navbar.php"; ?>

    <div class="card-dashboard mb-4" data-aos="fade-up">

        <h2>
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            Laporan PortoCampus
        </h2>

        <hr>

        <div class="row text-center">

            <div class="col-md-4">

                <div class="card border-success shadow-sm">

                    <div class="card-body">

                        <h3><?= $sertifikat->num_rows ?></h3>

                        <p>Total Sertifikat</p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-primary shadow-sm">

                    <div class="card-body">

                        <h3><?= $prestasi->num_rows ?></h3>

                        <p>Total Prestasi</p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-warning shadow-sm">

                    <div class="card-body">

                        <h3><?= $proyek->num_rows ?></h3>

                        <p>Total Proyek</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card-dashboard mt-4">

        <h3>
            <i class="bi bi-award-fill"></i>
            Data Sertifikat
        </h3>

        <hr>

        <table class="table table-bordered table-striped">

            <thead class="table-success">

                <tr>

                    <th>No</th>
                    <th>Nama Sertifikat</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>

                </tr>

            </thead>

            <tbody>

                <?php
                $no = 1;
                $sertifikat = $conn->query("SELECT * FROM sertifikat ORDER BY id DESC");

                while ($row = $sertifikat->fetch_assoc()) {
                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['nama_sertifikat']; ?></td>

                        <td><?= $row['penyelenggara']; ?></td>

                        <td><?= $row['tahun']; ?></td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

    <div class="card-dashboard mt-4">

        <h3>
            <i class="bi bi-trophy-fill"></i>
            Data Prestasi
        </h3>

        <hr>

        <table class="table table-bordered table-striped">

            <thead class="table-primary">

                <tr>

                    <th>No</th>
                    <th>Nama Prestasi</th>
                    <th>Tingkat</th>
                    <th>Tahun</th>
                    <th>Deskripsi</th>

                </tr>

            </thead>

            <tbody>

                <?php
                $no = 1;
                $prestasi = $conn->query("SELECT * FROM prestasi ORDER BY id DESC");

                while ($row = $prestasi->fetch_assoc()) {
                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['nama_prestasi']; ?></td>

                        <td><?= $row['tingkat']; ?></td>

                        <td><?= $row['tahun']; ?></td>

                        <td><?= $row['deskripsi']; ?></td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

    <div class="card-dashboard mt-4">

        <h3>
            <i class="bi bi-laptop-fill"></i>
            Data Proyek
        </h3>

        <hr>

        <table class="table table-bordered table-striped">

            <thead class="table-warning">

                <tr>

                    <th>No</th>
                    <th>Nama Proyek</th>
                    <th>Mata Kuliah</th>
                    <th>Tahun</th>
                    <th>Github</th>

                </tr>

            </thead>

            <tbody>

                <?php
                $no = 1;
                $proyek = $conn->query("SELECT * FROM proyek ORDER BY id DESC");

                while ($row = $proyek->fetch_assoc()) {
                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['nama_proyek']; ?></td>

                        <td><?= $row['mata_kuliah']; ?></td>

                        <td><?= $row['tahun']; ?></td>

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

                                -

                            <?php } ?>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

    <div class="card-dashboard mt-4 text-center">

        <a
            href="../laporan/cetak_laporan.php"
            class="btn btn-danger btn-lg">

            <i class="bi bi-file-earmark-pdf-fill"></i>

            Cetak Laporan PDF

        </a>

    </div>

</div>

<?php include "layout/footer.php"; ?>