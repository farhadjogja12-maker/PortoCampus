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

if(isset($_POST['update'])){

    $user_id = $_SESSION['user_id'];

    $prestasi->update(

        $_POST['id'],

        $user_id,

        $_POST['nama'],

        $_POST['tingkat'],

        $_POST['deskripsi'],

        $_POST['tahun']

    );

    header("Location: ../views/prestasi.php");
    exit;
}