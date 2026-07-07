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

$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

$sertifikat = $conn->query("SELECT * FROM sertifikat WHERE user_id='$user_id' ORDER BY id DESC");
$prestasi = $conn->query("SELECT * FROM prestasi WHERE user_id='$user_id' ORDER BY id DESC");
$proyek = $conn->query("SELECT * FROM proyek WHERE user_id='$user_id' ORDER BY id DESC");

$jmlSertifikat = $sertifikat->num_rows;
$jmlPrestasi = $prestasi->num_rows;
$jmlProyek = $proyek->num_rows;

$fotoPath = "../assets/uploads/profil/".$user['foto'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan PortoCampus</title>

<style>
*{
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    margin:0;
    padding:35px;
    background:#eef3ff;
    color:#1f2937;
}

.container{
    max-width:1000px;
    margin:auto;
    background:white;
    border-radius:22px;
    padding:35px;
    box-shadow:0 20px 50px rgba(15,23,42,.12);
}

.btn-print{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:12px;
    cursor:pointer;
    font-weight:bold;
    margin-bottom:25px;
}

.header{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    padding:32px;
    border-radius:20px;
    text-align:center;
    margin-bottom:30px;
}

.header h1{
    margin:0;
    font-size:30px;
}

.header p{
    margin:8px 0 0;
    opacity:.9;
}

.profile{
    display:flex;
    align-items:center;
    gap:25px;
    margin-bottom:30px;
}

.profile img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:6px solid #eef3ff;
}

.profile h2{
    margin:0 0 8px;
    color:#2563eb;
}

.profile table td{
    padding:4px 8px;
    font-size:14px;
}

.summary{
    display:flex;
    gap:18px;
    margin:30px 0;
}

.box{
    flex:1;
    padding:22px;
    border-radius:18px;
    color:white;
    text-align:center;
}

.box:nth-child(1){
    background:linear-gradient(135deg,#2563eb,#4f46e5);
}

.box:nth-child(2){
    background:linear-gradient(135deg,#ec4899,#db2777);
}

.box:nth-child(3){
    background:linear-gradient(135deg,#10b981,#059669);
}

.box h2{
    font-size:36px;
    margin:0;
}

.box p{
    margin:6px 0 0;
    opacity:.95;
}

h3{
    color:#2563eb;
    margin-top:35px;
    margin-bottom:15px;
    padding-left:12px;
    border-left:6px solid #2563eb;
}

table.data{
    width:100%;
    border-collapse:collapse;
    margin-bottom:25px;
    border-radius:14px;
    overflow:hidden;
}

table.data th,
table.data td{
    border:1px solid #e5e7eb;
    padding:11px;
    font-size:14px;
}

table.data th{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    text-align:left;
}

table.data tbody tr:nth-child(odd){
    background:#ffffff;
}

table.data tbody tr:nth-child(even){
    background:#f8fafc;
}

.footer{
    text-align:center;
    margin-top:40px;
    padding-top:18px;
    border-top:2px solid #e5e7eb;
    color:#64748b;
    font-size:13px;
}

@media print{
    body{
        background:white;
        padding:0;
    }

    .container{
        box-shadow:none;
        border-radius:0;
        padding:20px;
    }

    .btn-print{
        display:none;
    }
}
</style>
</head>

<body>

<div class="container">

<button onclick="window.print()" class="btn-print">
🖨️ Cetak / Simpan PDF
</button>

<div class="header">
    <h1>LAPORAN PORTOCAMPUS</h1>
    <p>Sistem Pengelolaan Portofolio Digital Mahasiswa</p>
</div>

<div class="profile">

<?php if(!empty($user['foto']) && file_exists($fotoPath)){ ?>
    <img src="<?= $fotoPath; ?>">
<?php }else{ ?>
    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nama']); ?>&background=2563eb&color=fff&size=256">
<?php } ?>

<div>
    <h2><?= $user['nama']; ?></h2>

    <table>
        <tr>
            <td><b>NIM</b></td>
            <td>: <?= $user['nim']; ?></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td>: <?= $user['email']; ?></td>
        </tr>
        <tr>
            <td><b>Tanggal Cetak</b></td>
            <td>: <?= date('d-m-Y H:i'); ?></td>
        </tr>
    </table>
</div>

</div>

<div class="summary">
    <div class="box">
        <h2><?= $jmlSertifikat; ?></h2>
        <p>Sertifikat</p>
    </div>

    <div class="box">
        <h2><?= $jmlPrestasi; ?></h2>
        <p>Prestasi</p>
    </div>

    <div class="box">
        <h2><?= $jmlProyek; ?></h2>
        <p>Proyek</p>
    </div>
</div>

<h3>Data Sertifikat</h3>

<table class="data">
<thead>
<tr>
    <th>No</th>
    <th>Nama Sertifikat</th>
    <th>Penyelenggara</th>
    <th>Tahun</th>
</tr>
</thead>

<tbody>
<?php $no=1; while($row=$sertifikat->fetch_assoc()){ ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_sertifikat']; ?></td>
    <td><?= $row['penyelenggara']; ?></td>
    <td><?= $row['tahun']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<h3>Data Prestasi</h3>

<table class="data">
<thead>
<tr>
    <th>No</th>
    <th>Nama Prestasi</th>
    <th>Tingkat</th>
    <th>Tahun</th>
    <th>Deskripsi</th>
</tr>
</thead>

<tbody>
<?php $no=1; while($row=$prestasi->fetch_assoc()){ ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_prestasi']; ?></td>
    <td><?= $row['tingkat']; ?></td>
    <td><?= $row['tahun']; ?></td>
    <td><?= $row['deskripsi']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<h3>Data Proyek</h3>

<table class="data">
<thead>
<tr>
    <th>No</th>
    <th>Nama Proyek</th>
    <th>Mata Kuliah</th>
    <th>Tahun</th>
    <th>Github</th>
</tr>
</thead>

<tbody>
<?php $no=1; while($row=$proyek->fetch_assoc()){ ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_proyek']; ?></td>
    <td><?= $row['mata_kuliah']; ?></td>
    <td><?= $row['tahun']; ?></td>
    <td><?= $row['github']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<div class="footer">
    Dicetak melalui PortoCampus • <?= date('Y'); ?>
</div>

</div>

</body>
</html>