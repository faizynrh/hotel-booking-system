<?php
include '../config.php';
session_start();

if (!isset($_GET['id_pembayaran'])) {
    header("Location: daftar_kamar.php");
    exit();
}

$id_pembayaran = $_GET['id_pembayaran'];

$query_pembayaran = "
    SELECT p.*, pem.id_pemesanan, pem.tanggal_pesan, k.no_kamar, k.tipe_kamar, pel.nama, pel.email, pel.no_hp
    FROM pembayaran p
    JOIN pemesanan pem ON p.id_pemesanan = pem.id_pemesanan
    JOIN kamar k ON pem.id_kamar = k.id_kamar
    JOIN pelanggan pel ON pem.id_pelanggan = pel.id_pelanggan
    WHERE p.id_pembayaran = '$id_pembayaran'
";
$result_pembayaran = mysqli_query($conn, $query_pembayaran);
$pembayaran = mysqli_fetch_assoc($result_pembayaran);

if (!$pembayaran) {
    echo "Pembayaran tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konfirmasi Pembayaran</title>
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

        @media print {

            /* Hide the title */
            head {
                display: none;
            }

            /* Hide the print button and change payment method button */
            #printButton,
            #changePaymentButton {
                display: none;
            }
        }

        /* Add margin between No. HP and No. Kamar */
        @media print {
            .card-text.no-hp {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h3 class="text-center" style="font-weight: bold;">Bukti Pemesananan</h3>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Detail Pembayaran</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Nomor Pemesanan:</strong> <?= $pembayaran['id_pemesanan'] ?></p>
                        <p class="card-text"><strong>Nama Pelanggan:</strong> <?= $pembayaran['nama'] ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= $pembayaran['email'] ?></p>
                        <p class="card-text no-hp"><strong>Nomor HP:</strong> <?= $pembayaran['no_hp'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text"><strong>Nomor Kamar:</strong> <?= $pembayaran['no_kamar'] ?></p>
                        <p class="card-text"><strong>Tipe Kamar:</strong> <?= $pembayaran['tipe_kamar'] ?></p>
                        <p class="card-text"><strong>Metode Pembayaran:</strong> <?= $pembayaran['metode_pembayaran'] ?></p>
                        <p class="card-text"><strong>Total Pembayaran:</strong> Rp. <?= number_format($pembayaran['total_pembayaran'], 0, ',', '.') ?></p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <?php if ($pembayaran['metode_pembayaran'] == 'QRIS') : ?>
                        <form action="qris.php" method="POST" class="w-100">
                            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                            <button type="submit" class="btn btn-primary w-100">Bayar dengan QRIS</button>
                        </form>
                    <?php else : ?>
                        <p>*Silahkan Selesaikan Pembayaran Secara Offline</p>
                        <button id="printButton" class="btn btn-primary mt-3 w-100">Cetak Bukti Pembayaran</button>
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <a id="changePaymentButton" href="konfirmasi_pemesanan.php?id_pemesanan=<?= $pembayaran['id_pemesanan'] ?>" class="btn btn-secondary w-100 mt-3">Ganti Metode Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mencetak halaman
        function printPage() {
            // Sembunyikan tombol cetak
            document.getElementById("printButton").style.display = "none";
            // Mencetak halaman
            window.print();
            // Tampilkan kembali tombol cetak setelah pencetakan selesai
            document.getElementById("printButton").style.display = "block";
        }

        // Menangkap klik pada tombol cetak dan memanggil fungsi printPage
        document.getElementById("printButton").onclick = function() {
            printPage();
        };
    </script>
</body>

</html>