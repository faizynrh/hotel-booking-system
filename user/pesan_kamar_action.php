<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Mendapatkan tanggal pemesanan dalam format 'Y-m-d'
    $tanggal_pesan = date('Y-m-d');
    // Mendapatkan tanggal pemesanan dalam format 'ddmmyy'
    $tanggal_pesan_format = date('dmy');

    // Mendapatkan nomor urut terakhir dari tabel pemesanan untuk tanggal tersebut
    $query_nomor_urut = "SELECT MAX(id_pemesanan) as last_id FROM pemesanan WHERE id_pemesanan LIKE 'OXO-$tanggal_pesan_format-%'";
    $result_nomor_urut = mysqli_query($conn, $query_nomor_urut);
    $row_nomor_urut = mysqli_fetch_assoc($result_nomor_urut);

    if ($row_nomor_urut['last_id']) {
        $last_id = $row_nomor_urut['last_id'];
        $last_number = (int)substr($last_id, -4);
        $new_number = $last_number + 1;
    } else {
        $new_number = 1;
    }
    $new_id_pemesanan = sprintf('OXO-%s-%04d', $tanggal_pesan_format, $new_number);

    // Insert data pelanggan
    $query_pelanggan = "INSERT INTO pelanggan (nama, nik, alamat, email, no_hp) VALUES ('$nama', '$nik', '$alamat', '$email', '$no_hp')";
    mysqli_query($conn, $query_pelanggan);
    $id_pelanggan = mysqli_insert_id($conn);

    // Insert data pemesanan
    $query_pemesanan = "INSERT INTO pemesanan (id_pemesanan, id_pelanggan, id_kamar, tanggal_pesan, tanggal_checkin, tanggal_checkout, jumlah_anak, jumlah_dewasa, total_biaya) 
                        VALUES ('$new_id_pemesanan', '$id_pelanggan', '$id_kamar', '$tanggal_pesan', '$tanggal_checkin', '$tanggal_checkout', '$jumlah_anak', '$jumlah_dewasa', '$total_biaya')";
    mysqli_query($conn, $query_pemesanan);

    // Update status kamar menjadi 'Dipesan'
    $query_update_kamar = "UPDATE kamar SET status = 'Terpesan' WHERE id_kamar = '$id_kamar'";
    mysqli_query($conn, $query_update_kamar);

    // Redirect ke halaman konfirmasi atau halaman lainnya
    header("Location: konfirmasi_pemesanan.php?id_pemesanan=$new_id_pemesanan");
}
