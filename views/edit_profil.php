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

$user = $conn->query("
SELECT *
FROM users
WHERE id='$user_id'
")->fetch_assoc();

$fotoPath = "../assets/uploads/profil/" . $user['foto'];

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

                    <i class="bi bi-person-circle"></i>

                    Edit Profil

                </h2>

                <p class="mb-0">

                    Perbarui data akun dan foto profil Anda.

                </p>

            </div>

            <i
                class="bi bi-person-vcard-fill"
                style="font-size:80px;opacity:.25;">
            </i>

        </div>

    </div>

    <div class="card-dashboard" data-aos="fade-up">

        <form
            action="../controllers/UpdateProfil.php"
            method="POST"
            enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-4 text-center mb-4">

                    <?php if (!empty($user['foto']) && file_exists($fotoPath)) { ?>

                        <img
                            src="<?= $fotoPath; ?>"
                            class="rounded-circle shadow mb-3"
                            style="width:220px;height:220px;object-fit:cover;border:6px solid #eef4ff;">

                    <?php } else { ?>

                        <img
                            src="https://ui-avatars.com/api/?name=<?= urlencode($user['nama']); ?>&background=2563eb&color=fff&size=256"
                            class="rounded-circle shadow mb-3"
                            style="width:220px;height:220px;object-fit:cover;border:6px solid #eef4ff;">

                    <?php } ?>

                    <h4 class="fw-bold">

                        <?= $user['nama']; ?>

                    </h4>

                    <p class="text-muted mb-3">

                        <?= $user['nim']; ?>

                    </p>

                    <label class="form-label fw-semibold">

                        Upload Foto Baru

                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*">

                    <small class="text-muted">

                        Format: JPG, PNG, JPEG, WEBP

                    </small>

                </div>

                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <label class="fw-semibold">Nama Lengkap</label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="<?= $user['nama']; ?>"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="fw-semibold">NIM</label>

                            <input
                                type="text"
                                name="nim"
                                class="form-control"
                                value="<?= $user['nim']; ?>"
                                required>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="fw-semibold">Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= $user['email']; ?>"
                                required>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="fw-semibold">Password Baru</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengganti password">

                            <small class="text-muted">

                                Kosongkan jika password tidak ingin diganti.

                            </small>

                        </div>

                        <div class="col-md-12 mt-3">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-check-circle-fill"></i>

                                Simpan Perubahan

                            </button>

                            <a
                                href="profil.php"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

<?php include "layout/footer.php"; ?>