<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once "../config/Database.php";
require_once "../models/Sertifikat.php";

$db = new Database();
$conn = $db->connect();

$sertifikat = new Sertifikat($conn);

if(isset($_POST['simpan'])){

    $user_id = $_SESSION['user_id'];

    $nama = $_POST['nama'];
    $penyelenggara = $_POST['penyelenggara'];
    $tahun = $_POST['tahun'];

    // Upload PDF
    $namaFile = "";

    if(isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] == 0){

        $namaFile = time()."_".$_FILES['file_pdf']['name'];

        move_uploaded_file(
            $_FILES['file_pdf']['tmp_name'],
            "../assets/uploads/sertifikat/".$namaFile
        );

    }

    $sertifikat->tambah(
        $user_id,
        $nama,
        $penyelenggara,
        $tahun,
        $namaFile
    );

    header("Location: ../views/sertifikat.php");
    exit;
}