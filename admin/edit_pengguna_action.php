<?php
include "../config.php";

$id_users = $_POST['id_users'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hak_akses = $_POST['hak_akses'];

// QUERY UNTUK UPDATE DATA STUDENTS
$query = "UPDATE users SET username = '$username', email = '$email', password = '$password', hak_akses = '$hak_akses' WHERE id_users = '$id_users'";

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
header("Location: pengguna.php");
exit();
