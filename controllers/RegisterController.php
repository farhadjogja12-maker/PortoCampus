<?php

session_start();

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$email = $_POST['email'];
$password = $_POST['password'];

$cek = $conn->query("SELECT * FROM users WHERE email='$email' OR nim='$nim'");

if ($cek->num_rows > 0) {
    echo "Email atau NIM sudah terdaftar";
    exit;
}

$sql = "INSERT INTO users (nim, nama, email, password)
        VALUES ('$nim', '$nama', '$email', '$password')";

$conn->query($sql);

header("Location: ../views/login.php");
exit;