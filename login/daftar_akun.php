<?php
include '../config.php';

session_start();

// Ambil data dari formulir pendaftaran
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Default hak akses
$hak_akses = 'pengguna';

// Validasi password dan konfirmasi password
if ($password != $confirm_password) {
    $message = "Password dan konfirmasi password tidak sesuai.";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

// Validasi apakah username sudah ada di database
$query_check_username = "SELECT * FROM users WHERE username = '$username'";
$result_check_username = mysqli_query($conn, $query_check_username);

if (mysqli_num_rows($result_check_username) > 0) {
    $message = "Username sudah digunakan. Silakan gunakan username lain.";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan data pengguna ke database
$query = "INSERT INTO users (username, email, password, hak_akses) VALUES ('$username', '$email', '$hashed_password', '$hak_akses')";
$result = mysqli_query($conn, $query);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
error_log("Hashed password: " . $hashed_password);

if ($result) {
    $message = "Pendaftaran berhasil. Anda sekarang bisa login.";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='index.php';</script>";
} else {
    $message = "Terjadi kesalahan saat mendaftar.";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='index.php';</script>";
}
