<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pemesanan = $_POST['id_pemesanan'];
    $id_kamar = $_POST['id_kamar'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $tanggal_checkin = $_POST['tanggal_checkin'];
    $tanggal_checkout = $_POST['tanggal_checkout'];
    $jumlah_dewasa = $_POST['jumlah_dewasa'];
    $jumlah_anak = $_POST['jumlah_anak'];
    $harga_kamar = $_POST['harga'];

    // Menghitung lama menginap dalam hari
    $tanggal_checkin_obj = new DateTime($tanggal_checkin);
    $tanggal_checkout_obj = new DateTime($tanggal_checkout);
    $lama_menginap = $tanggal_checkin_obj->diff($tanggal_checkout_obj)->days;

    // Menghitung total biaya sebelum pajak (harga kamar dikali lama menginap)
    $total_biaya_sebelum_pajak = $harga_kamar * $lama_menginap;

    // Menghitung pajak (12% dari total biaya)
    $pajak = $total_biaya_sebelum_pajak * 0.12;

    // Menghitung total biaya setelah ditambahkan pajak
    $total_biaya = $total_biaya_sebelum_pajak + $pajak;

    // Update data pemesanan
    $query_update_pemesanan = "
        UPDATE pemesanan
        SET 
            tanggal_checkin = '$tanggal_checkin',
            tanggal_checkout = '$tanggal_checkout',
            jumlah_dewasa = '$jumlah_dewasa',
            jumlah_anak = '$jumlah_anak',
            total_biaya = '$total_biaya'
        WHERE id_pemesanan = '$id_pemesanan'
    ";

    // Update data pelanggan
    $query_update_pelanggan = "
        UPDATE pelanggan
        SET 
            nama = '$nama',
            nik = '$nik',
            alamat = '$alamat',
            email = '$email',
            no_hp = '$no_hp'
        WHERE id_pelanggan = (SELECT id_pelanggan FROM pemesanan WHERE id_pemesanan = '$id_pemesanan')
    ";

    // Eksekusi query update pemesanan dan pelanggan
    if (mysqli_query($conn, $query_update_pemesanan) && mysqli_query($conn, $query_update_pelanggan)) {
        header("Location: konfirmasi_pemesanan.php?id_pemesanan=$id_pemesanan");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
