<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pemesanan = $_POST['id_pemesanan'];

    // Ambil ID pelanggan dan ID kamar terkait dengan pemesanan
    $query_get_details = "SELECT id_pelanggan, id_kamar FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'";
    $result_get_details = mysqli_query($conn, $query_get_details);
    $details = mysqli_fetch_assoc($result_get_details);
    $id_pelanggan = $details['id_pelanggan'];
    $id_kamar = $details['id_kamar'];

    // Hapus data pemesanan
    $query_hapus_pemesanan = "DELETE FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'";
    mysqli_query($conn, $query_hapus_pemesanan);

    // Hapus data pelanggan
    $query_hapus_pelanggan = "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
    mysqli_query($conn, $query_hapus_pelanggan);

    // Ubah status kamar menjadi 'Tersedia'
    $query_update_kamar = "UPDATE kamar SET status = 'Tersedia' WHERE id_kamar = '$id_kamar'";
    mysqli_query($conn, $query_update_kamar);

    // Redirect kembali ke daftar kamar
    header("Location: index.php");
    exit();
} else {
    // Jika tidak ada request POST, redirect kembali ke halaman sebelumnya
    header("Location: konfirmasi_pemesanan.php");
    exit();
}
