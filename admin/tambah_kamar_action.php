<?php
include "../config.php";

$no_kamar = $_POST['no_kamar'];
$tipe_kamar = $_POST['tipe_kamar'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];


$status = 'Tersedia';


$query = "INSERT INTO kamar VALUES('', '$no_kamar', '$tipe_kamar', '$harga', '$gambar', '$status')";

$sql = mysqli_query($conn, $query);

// mulai session
session_start();

if ($sql) {
    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Data berhasil diinsert!";
} else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Gagal Melakukan Insert";
}

// redirect ke halaman student.php
header("Location: kamar.php");
exit();
