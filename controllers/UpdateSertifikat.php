<?php

session_start();

require_once "../config/Database.php";
require_once "../models/Sertifikat.php";

$db = new Database();
$conn = $db->connect();

$sertifikat = new Sertifikat($conn);

if(isset($_POST['update'])){

    $user_id = $_SESSION['user_id'];

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $penyelenggara = $_POST['penyelenggara'];
    $tahun = $_POST['tahun'];

    $namaFile = "";

    if(isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] == 0){

        $namaFile = time()."_".$_FILES['file_pdf']['name'];

        move_uploaded_file(
            $_FILES['file_pdf']['tmp_name'],
            "../assets/uploads/sertifikat/".$namaFile
        );

    }

    $sertifikat->update(
        $id,
        $user_id,
        $nama,
        $penyelenggara,
        $tahun,
        $namaFile
    );

    header("Location: ../views/sertifikat.php");
    exit;
}