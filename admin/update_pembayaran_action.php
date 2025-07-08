<?php
include "../config.php";

$id_pembayaran = $_POST['id_pembayaran'];

// QUERY UNTUK UPDATE DATA STUDENTS
$query = "UPDATE pembayaran SET status_pembayaran = 'Lunas' WHERE id_pembayaran = '$id_pembayaran'";

$sql = mysqli_query($conn, $query);

session_start();

if ($sql) {
    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Pemesanan Telah Lunas!!";
} else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Gagal Melakukan Aksi!!";
}

// redirect ke halaman student.php
header("Location: pembayaran.php");
exit();
