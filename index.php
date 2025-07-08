<?php
// Memulai sesi jika diperlukan
session_start();

// Mengarahkan ke file lain
header('Location: user'); // Ganti 'target.php' dengan URL tujuan
exit(); // Menghentikan eksekusi script lebih lanjut
