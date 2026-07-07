<?php

session_start();

require_once "../config/Database.php";
require_once "../models/Sertifikat.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();

$sertifikat = new Sertifikat($conn);

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sertifikat->hapus($id, $user_id);

header("Location: ../views/sertifikat.php");
exit;