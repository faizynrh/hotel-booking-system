<?php
include '../config.php';

// Fungsi untuk menghasilkan nomor kamar berdasarkan tipe kamar
function generateRoomNumber($conn, $tipe_kamar)
{
    switch ($tipe_kamar) {
        case 'Standard':
            $prefix = 'STD';
            break;
        case 'Deluxe':
            $prefix = 'DLX';
            break;
        case 'Luxury':
            $prefix = 'LXR';
            break;
        default:
            $prefix = '';
    }

    $query = "SELECT MAX(SUBSTRING(no_kamar, 4)) AS last_room_number FROM kamar WHERE tipe_kamar = '$tipe_kamar'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $last_room_number = intval($row['last_room_number']);
    $next_room_number = $prefix . sprintf("%03d", $last_room_number + 1);

    return $next_room_number;
}

// Ambil data JSON dari request POST
$data = json_decode(file_get_contents('php://input'), true);

// Jika data tidak kosong
if (!empty($data['tipe_kamar'])) {
    // Ambil tipe kamar dari data
    $tipe_kamar = $data['tipe_kamar'];
    // Generate nomor kamar berdasarkan tipe kamar
    $nomor_kamar = generateRoomNumber($conn, $tipe_kamar);
    // Kirim nomor kamar sebagai respons
    echo $nomor_kamar;
} else {
    // Jika tipe kamar tidak tersedia, kirim respons kosong
    echo '';
}
