<?php

$current = basename($_SERVER['PHP_SELF']);

$foto = $_SESSION['foto'] ?? "";
$nama = $_SESSION['nama'] ?? "Mahasiswa";

?>

<div class="sidebar">

    <div class="text-center mb-4">

        <?php

        if (!empty($foto) && file_exists("../assets/uploads/profil/" . $foto)) {

        ?>

            <img
                src="../assets/uploads/profil/<?= $foto ?>"
                style="
width:95px;
height:95px;
border-radius:50%;
object-fit:cover;
border:4px solid rgba(255,255,255,.25);
box-shadow:0 10px 25px rgba(0,0,0,.25);
">

        <?php } else { ?>

            <img
                src="https://ui-avatars.com/api/?name=<?= urlencode($nama) ?>&background=ffffff&color=2563eb&size=256"
                style="
width:95px;
height:95px;
border-radius:50%;
">

        <?php } ?>

        <h5 class="mt-3 mb-1">

            <?= $nama ?>

        </h5>

        <small class="text-white-50">

            Mahasiswa Informatika

        </small>

    </div>

    <hr class="text-white opacity-25">

    <a href="dashboard.php"
        class="<?= $current == "dashboard.php" ? "active" : "" ?>">

        <i class="bi bi-grid-fill"></i>

        Dashboard

    </a>

    <a href="profil.php"
        class="<?= $current == "profil.php" || $current == "edit_profil.php" ? "active" : "" ?>">

        <i class="bi bi-person-circle"></i>

        Profil

    </a>

    <a href="sertifikat.php"
        class="<?= $current == "sertifikat.php" ? "active" : "" ?>">

        <i class="bi bi-award-fill"></i>

        Sertifikat

    </a>

    <a href="prestasi.php"
        class="<?= $current == "prestasi.php" ? "active" : "" ?>">

        <i class="bi bi-trophy-fill"></i>

        Prestasi

    </a>

    <a href="proyek.php"
        class="<?= $current == "proyek.php" ? "active" : "" ?>">

        <i class="bi bi-laptop-fill"></i>

        Proyek

    </a>

    <a href="laporan.php"
        class="<?= $current == "laporan.php" ? "active" : "" ?>">

        <i class="bi bi-file-earmark-bar-graph-fill"></i>

        Laporan

    </a>

    <a href="settings.php"
        class="<?= $current == "settings.php" ? "active" : "" ?>">

        <i class="bi bi-gear-fill"></i>

        Settings

    </a>

    <a
        href="../controllers/LogoutController.php">

        <i class="bi bi-box-arrow-right"></i>

        Logout

    </a>

    <div class="mt-auto pt-4">

        <hr class="text-white opacity-25">

        <small class="text-white">

            Portfolio Progress

        </small>

        <?php

        $total = 12;

        $isi = ($jmlSertifikat ?? 0) + ($jmlPrestasi ?? 0) + ($jmlProyek ?? 0);

        $persen = min(100, ($isi / $total) * 100);

        ?>

        <div
            style="
height:8px;
background:rgba(255,255,255,.15);
border-radius:20px;
margin-top:10px;
overflow:hidden;">

            <div
                style="
height:100%;
width:<?= $persen ?>%;
background:white;
border-radius:20px;">

            </div>

        </div>

        <small class="text-white-50">

            <?= round($persen) ?>%

            Complete

        </small>

        <hr class="text-white opacity-25 mt-4">

        <div class="text-center text-white-50">

            <b>PortoCampus</b>

            <br>

            Version 5.1

        </div>

    </div>

</div>