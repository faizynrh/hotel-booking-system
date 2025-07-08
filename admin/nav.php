<?php
include '../config.php';
date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu sesuai dengan lokasi Anda

$jam = date('H');

if ($jam >= 4 && $jam < 9) {
    $ucapan = "Selamat pagi";
} elseif ($jam >= 9 && $jam < 15) {
    $ucapan = "Selamat siang";
} elseif ($jam >= 15 && $jam < 18) {
    $ucapan = "Selamat sore";
} else {
    $ucapan = "Selamat malam";
}
?>
<nav class="navbar navbar-expand navbar-light bg-white px-4 py-2">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <h4 class="navbar-brand text-dark fw-bold mb-0 text-uppercase"><?= $ucapan . ', ' . strtoupper($_SESSION['username']); ?></h4>
                </li>
                <li class="nav-item">
                    <img src="images/account.png" class="avatar img-fluid" alt="" />
                </li>
            </ul>
        </div>
    </div>
</nav>