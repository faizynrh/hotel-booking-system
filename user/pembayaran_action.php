<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pemesanan = $_POST['id_pemesanan'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Dapatkan total biaya dari tabel pemesanan
    $query = "SELECT total_biaya FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'";
    $result = mysqli_query($conn, $query);
    $pemesanan = mysqli_fetch_assoc($result);

    if (!$pemesanan) {
        echo "Pemesanan tidak ditemukan!";
        exit();
    }

    $total_pembayaran = $pemesanan['total_biaya'];
    $tanggal_pembayaran = date('Y-m-d H:i:s');
    $status_pembayaran = 'Pending'; // Set status awal sebagai 'Pending'

    // Dapatkan nomor urut terakhir dari tabel pembayaran
    $query_nomor_urut = "SELECT MAX(id_pembayaran) as last_id FROM pembayaran WHERE id_pembayaran LIKE 'OXO-PAY-%'";
    $result_nomor_urut = mysqli_query($conn, $query_nomor_urut);
    $row_nomor_urut = mysqli_fetch_assoc($result_nomor_urut);

    if ($row_nomor_urut['last_id']) {
        $last_id = $row_nomor_urut['last_id'];
        $last_number = (int)substr($last_id, -4);
        $new_number = $last_number + 1;
    } else {
        $new_number = 1;
    }
    $new_id_pembayaran = sprintf('OXO-PAY-%04d', $new_number);

    // Simpan data pembayaran ke tabel pembayaran
    $query_insert = "
        INSERT INTO pembayaran (id_pembayaran, id_pemesanan, metode_pembayaran, total_pembayaran, tanggal_pembayaran, status_pembayaran)
        VALUES ('$new_id_pembayaran', '$id_pemesanan', '$metode_pembayaran', '$total_pembayaran', '$tanggal_pembayaran', '$status_pembayaran')
    ";
    if (mysqli_query($conn, $query_insert)) {
        // Dapatkan id_pembayaran yang baru saja disimpan
        $id_pembayaran = mysqli_insert_id($conn);
        // Redirect ke halaman konfirmasi pembayaran
        header("Location: konfirmasi_pembayaran.php?id_pembayaran=$new_id_pembayaran");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data pembayaran: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
