<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php");
    exit;
}

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$user_id = $_SESSION['user_id'];

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$email = $_POST['email'];
$password = $_POST['password'];

$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

$foto = $user['foto'];

$folder = "../assets/uploads/profil/";

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $namaAsli = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $ext = strtolower(pathinfo($namaAsli, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $allowed)) {
        die("Format foto harus JPG, JPEG, PNG, atau WEBP.");
    }

    $fotoBaru = time() . "_" . uniqid() . "." . $ext;

    if (move_uploaded_file($tmp, $folder . $fotoBaru)) {

        if (!empty($foto) && file_exists($folder . $foto)) {
            unlink($folder . $foto);
        }

        $foto = $fotoBaru;

    } else {
        die("Upload foto gagal. Cek folder assets/uploads/profil/");
    }
}

if ($password != "") {

    $sql = "UPDATE users SET
            nama='$nama',
            nim='$nim',
            email='$email',
            password='$password',
            foto='$foto'
            WHERE id='$user_id'";

} else {

    $sql = "UPDATE users SET
            nama='$nama',
            nim='$nim',
            email='$email',
            foto='$foto'
            WHERE id='$user_id'";
}

$conn->query($sql);

$_SESSION['nama'] = $nama;
$_SESSION['email'] = $email;
$_SESSION['nim'] = $nim;
$_SESSION['foto'] = $foto;

header("Location: ../views/profil.php");
exit;