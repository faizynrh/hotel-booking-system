<?php
include "../config.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hak_akses = $_POST['hak_akses'];

$query = "INSERT INTO pelanggan VALUES('', '$usernama', '$email', '$password', '$hak_akses')";

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
