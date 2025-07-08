<?php
include "../config.php";

$id_kamar = $_POST['id_kamar'];
$no_kamar = $_POST['no_kamar'];
$tipe_kamar = $_POST['tipe_kamar'];
$harga = $_POST['harga'];
$image = $_POST['image'];
$status = $_POST['status'];

// QUERY UNTUK UPDATE DATA STUDENTS
$query = "UPDATE kamar SET no_kamar = '$no_kamar', tipe_kamar = '$tipe_kamar', harga = '$harga', image = '$image', status = '$status' WHERE id_kamar = '$id_kamar'";

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
header("Location: kamar.php");
exit();
