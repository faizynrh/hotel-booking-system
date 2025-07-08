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
    <title>Konfirmasi Pemesanan</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('img/bg1.png');
            /* Replace with the path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Roboto", sans-serif;
            font-size: 16px;
        }

        .container {
            background-color: white;
            /* White background with transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            margin-top: 20px;
            /* Adjust this value to set the desired margin */
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h3 class="text-center mt-3" style="font-weight: bold;">Konfirmasi Pemesanan</h3>
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Detail Pemesanan</h4>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>Nomor Kamar:</strong> <?= $pemesanan['no_kamar'] ?></p>
                        <p><strong>Tipe Kamar:</strong> <?= $pemesanan['tipe_kamar'] ?></p>
                        <p><strong>Harga per Malam:</strong> Rp. <?= number_format($pemesanan['harga'], 0, ',', '.') ?></p>
                        <p><strong>Tanggal Check-in:</strong> <?= date('d-m-Y', strtotime($pemesanan['tanggal_checkin'])) ?></p>
                        <p><strong>Tanggal Check-out:</strong> <?= date('d-m-Y', strtotime($pemesanan['tanggal_checkout'])) ?></p>
                        <p><strong>Jumlah Dewasa:</strong> <?= $pemesanan['jumlah_dewasa'] ?></p>
                        <p><strong>Jumlah Anak:</strong> <?= $pemesanan['jumlah_anak'] ?></p>

                    </div>
                    <div class="col-md-6">
                        <p><strong>No Pemesanan:</strong> <?= $pemesanan['id_pemesanan'] ?></p>
                        <p><strong>Nama Pelanggan:</strong> <?= $pemesanan['nama'] ?></p>
                        <p><strong>NIK:</strong> <?= $pemesanan['nik'] ?></p>
                        <p><strong>Alamat:</strong> <?= $pemesanan['alamat'] ?></p>
                        <p><strong>Email:</strong> <?= $pemesanan['email'] ?></p>
                        <p><strong>Nomor HP:</strong> <?= $pemesanan['no_hp'] ?></p>
                        <p><strong>Total Harga:</strong> Rp. <?= number_format($pemesanan['total_biaya'], 0, ',', '.') ?></p>
                    </div>
                </div>
                <form action="pembayaran_action.php" method="POST" class="mt-4">
                    <input type="hidden" name="id_pemesanan" value="<?= $pemesanan['id_pemesanan'] ?>">
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="QRIS">QRIS</option>
                            <option value="Cash">Cash (Offline)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Lanjutkan ke Pembayaran</button>
                </form>
                <form action="edit_pemesanan.php" method="GET">
                    <input type="hidden" name="id_pemesanan" value="<?= $pemesanan['id_pemesanan'] ?>">
                    <button type="submit" class="btn btn-primary mt-3 w-100">Edit Pemesanan</button>
                </form>
                <form action="batal_pemesanan_action.php" method="POST">
                    <input type="hidden" name="id_pemesanan" value="<?= $pemesanan['id_pemesanan'] ?>">
                    <button type="submit" class="btn btn-danger mt-3 w-100">Batalkan Pemesanan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>