<?php
include '../config.php';

$id_pelanggan = $_GET['id_pelanggan'];

$query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
$sql = mysqli_query($conn, $query);

session_start();

if ($sql) {
    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Data berhasil diubah!!";
} else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Gagal Melakukan Update!!";
}

header("Location: pelanggan.php");
