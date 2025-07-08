<?php
include '../config.php';
session_start();
session_unset(); // menghapus semua variabel sesi
session_destroy(); // menghancurkan sesi
header('Location: index.php'); // arahkan ke halaman login
exit();
