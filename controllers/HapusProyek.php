<?php

session_start();

require_once "../config/Database.php";
require_once "../models/Proyek.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();

$proyek = new Proyek($conn);

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$proyek->hapus($id, $user_id);

header("Location: ../views/proyek.php");
exit;