<?php
date_default_timezone_set("Asia/Jakarta");

$nama = $_SESSION['nama'] ?? "Mahasiswa";
$foto = $_SESSION['foto'] ?? "";
$current = basename($_SERVER['PHP_SELF']);

$judul = "Dashboard";

if ($current == "profil.php") $judul = "Profil";
if ($current == "edit_profil.php") $judul = "Edit Profil";
if ($current == "sertifikat.php") $judul = "Sertifikat";
if ($current == "prestasi.php") $judul = "Prestasi";
if ($current == "proyek.php") $judul = "Proyek";
if ($current == "laporan.php") $judul = "Laporan";
if ($current == "settings.php") $judul = "Settings";
?>

<div class="navbar-custom">

    <div>
        <h3 class="fw-bold mb-1"><?= $judul; ?></h3>
        <small class="text-muted"><?= date("l, d F Y"); ?></small>
    </div>

    <div class="d-flex align-items-center gap-3">

        <div class="d-none d-md-block">
            <form action="search.php" method="GET" class="d-none d-md-block">

                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Cari portofolio..."
                    style="width:250px;">

            </form>
        </div>

        <button class="btn btn-light">
            <i class="bi bi-bell-fill"></i>
        </button>

        <div class="dropdown">

            <a
                href="#"
                class="d-flex align-items-center text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">

                <?php if (!empty($foto) && file_exists("../assets/uploads/profil/" . $foto)) { ?>

                    <img
                        src="../assets/uploads/profil/<?= $foto; ?>"
                        style="width:45px;height:45px;object-fit:cover;border-radius:50%;">

                <?php } else { ?>

                    <img
                        src="https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&background=2563eb&color=fff&size=128"
                        style="width:45px;height:45px;border-radius:50%;">

                <?php } ?>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                <li>
                    <h6 class="dropdown-header"><?= $nama; ?></h6>
                </li>

                <li>
                    <a class="dropdown-item" href="profil.php">
                        <i class="bi bi-person-circle me-2"></i>
                        Profil Saya
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="settings.php">
                        <i class="bi bi-gear-fill me-2"></i>
                        Settings
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-danger" href="../controllers/LogoutController.php">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>