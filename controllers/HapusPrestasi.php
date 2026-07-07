<?php

session_start();

require_once "../config/Database.php";
require_once "../models/Prestasi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();

$prestasi = new Prestasi($conn);

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$prestasi->hapus($id, $user_id);

header("Location: ../views/prestasi.php");
exit;