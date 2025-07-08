<?php
include "../config.php";

$id_pelanggan = $_POST['id_pelanggan'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

// QUERY UNTUK UPDATE DATA STUDENTS
$query = "UPDATE pelanggan SET nama = '$nama', nik = '$nik', alamat = '$alamat', email = '$email', no_hp = '$no_hp' WHERE id_pelanggan = '$id_pelanggan'";

$sql = mysqli_query($conn, $query);

session_start();

if ($sql) {
    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Data berhasil diubah!!";
} else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Gagal Melakukan Update!!";
}

// redirect ke halaman student.php
header("Location: pelanggan.php");
exit();
