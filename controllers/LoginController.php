<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

$email = $_POST['email'];
$password = $_POST['password'];

$result = $user->login($email,$password);

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    $_SESSION['login'] = true;

    $_SESSION['user_id'] = $row['id'];

    $_SESSION['nama'] = $row['nama'];

    $_SESSION['email'] = $row['email'];

    header("Location: ../views/dashboard.php");
    exit;

}else{

    echo "Login Gagal";

}