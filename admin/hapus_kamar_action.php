<?php
include '../config.php';

$id_kamar = $_GET['id_kamar'];

$query = "DELETE FROM kamar WHERE id_kamar = '$id_kamar'";
$sql = mysqli_query($conn, $query);

if ($sql) {
    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Data Berhasil Dihapus!!!";
} else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Gagal Melakukan Hapus!!";
}

header("Location: kamar.php");
