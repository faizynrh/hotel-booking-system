<?php

include '../config.php';

session_start();

// menerima data yang di inputkan pada form login
$username = $_POST['username'];
$password = $_POST['password'];

// membuat query untuk login berdasarkan username
$query = "SELECT * FROM users WHERE username = '$username'";
$login = mysqli_query($conn, $query);

$cek = mysqli_num_rows($login);

// cek username ada di tabel user atau tidak
if ($cek == 1) {
    $data = mysqli_fetch_assoc($login);
    // verifikasi password
    if (($password == $data['password'])) {
        // set session
        $_SESSION['id_users'] = $data['id_users'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['hak_akses'] = $data['hak_akses'];

        // cek hak akses untuk admin
        if ($data['hak_akses'] == 'admin') {
            header('Location: ../admin');
        } elseif ($data['hak_akses'] == 'pengguna') {
            header('Location: ../user');
        } else {
            echo "Tidak Ada Akses";
        }
        exit();
    } else {
        echo "Password Salah";
    }
} else {
    $message = "Username atau Password Salah!!!";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
