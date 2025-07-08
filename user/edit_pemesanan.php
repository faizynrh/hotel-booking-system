<?php
include '../config.php';
session_start();

if (!isset($_GET['id_pemesanan'])) {
    header("Location: daftar_kamar.php");
    exit();
}

$id_pemesanan = $_GET['id_pemesanan'];

$query_pemesanan = "
    SELECT p.*, k.no_kamar, k.tipe_kamar, k.harga, pel.nama, pel.nik, pel.alamat, pel.email, pel.no_hp
    FROM pemesanan p
    JOIN kamar k ON p.id_kamar = k.id_kamar
    JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
    WHERE p.id_pemesanan = '$id_pemesanan'
";
$result_pemesanan = mysqli_query($conn, $query_pemesanan);
$pemesanan = mysqli_fetch_assoc($result_pemesanan);

if (!$pemesanan) {
    echo "Pemesanan tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Pemesanan Kamar</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('img/bg1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5 bg-white mb-5">
        <h3 class="text-center">Edit Pemesanan Kamar</h3>
        <form id="formPemesanan" action="edit_pemesanan_action.php" method="POST">
            <input type="hidden" name="id_pemesanan" value="<?= $pemesanan['id_pemesanan'] ?>" />
            <input type="hidden" name="id_kamar" value="<?= $pemesanan['id_kamar'] ?>" />
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pemesanan['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $pemesanan['nik'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pemesanan['alamat'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $pemesanan['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $pemesanan['no_hp'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                        <input type="date" class="form-control" id="tanggal_checkin" name="tanggal_checkin" value="<?= $pemesanan['tanggal_checkin'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                        <input type="date" class="form-control" id="tanggal_checkout" name="tanggal_checkout" value="<?= $pemesanan['tanggal_checkout'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_dewasa" class="form-label">Jumlah Dewasa</label>
                        <input type="number" class="form-control" id="jumlah_dewasa" name="jumlah_dewasa" value="<?= $pemesanan['jumlah_dewasa'] ?>" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                        <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="<?= $pemesanan['jumlah_anak'] ?>" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per Malam</label>
                        <input type="number" name="harga" class="form-control" id="harga" value="<?= $pemesanan['harga'] ?>" required readonly />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Pesan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const hour = today.getHours();
            const minute = today.getMinutes();

            let minCheckinDate;
            if (hour >= 13 || (hour === 13 && minute >= 30)) {
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                minCheckinDate = tomorrow.toISOString().split('T')[0];
            } else {
                minCheckinDate = today.toISOString().split('T')[0];
            }

            document.getElementById('tanggal_checkin').setAttribute('min', minCheckinDate);

            document.getElementById('formPemesanan').addEventListener('change', function() {
                const checkinDate = new Date(document.getElementById('tanggal_checkin').value);
                const checkoutDate = new Date(document.getElementById('tanggal_checkout').value);

                const oneDayInMillis = 24 * 60 * 60 * 1000;
                const timeDifference = checkoutDate.getTime() - checkinDate.getTime();
                const daysDifference = Math.round(timeDifference / oneDayInMillis);

                if (daysDifference < 1) {
                    alert('Tanggal check-out harus minimal satu hari setelah tanggal check-in.');
                    document.getElementById('tanggal_checkout').value = '';
                }

                const minCheckout = new Date(checkinDate);
                minCheckout.setDate(minCheckout.getDate() + 1);
                const minCheckoutISO = minCheckout.toISOString().split('T')[0];
                document.getElementById('tanggal_checkout').setAttribute('min', minCheckoutISO);
            });
        });
    </script>
</body>

</html>