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

if(isset($_POST['simpan'])){

    $user_id = $_SESSION['user_id'];

    $proyek->tambah(

        $user_id,

        $_POST['nama'],

        $_POST['matkul'],

        $_POST['tahun'],

        $_POST['deskripsi'],

        $_POST['github']

    );

    header("Location: ../views/proyek.php");
    exit;
}