<?php
include "../config.php";

$nama = $_POST['nama'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

$query = "INSERT INTO pelanggan VALUES('', '$nama', '$nik', '$alamat', '$email', '$no_hp')";

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
header("Location: pelanggan.php");
exit();
