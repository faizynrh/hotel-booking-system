<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_pembayaran'])) {
    $id_pembayaran = $_POST['id_pembayaran'];

    // Update status pembayaran menjadi 'lunas'
    $query_update = "UPDATE pembayaran SET status_pembayaran = 'Lunas' WHERE id_pembayaran = '$id_pembayaran'";
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        // Query untuk mendapatkan detail pembayaran
        $query_pembayaran = "
            SELECT p.*, pem.id_pemesanan, pel.nama, pel.email, pel.no_hp, p.total_pembayaran
            FROM pembayaran p
            JOIN pemesanan pem ON p.id_pemesanan = pem.id_pemesanan
            JOIN pelanggan pel ON pem.id_pelanggan = pel.id_pelanggan
            WHERE p.id_pembayaran = '$id_pembayaran'
        ";
        $result_pembayaran = mysqli_query($conn, $query_pembayaran);
        $pembayaran = mysqli_fetch_assoc($result_pembayaran);

        if (!$pembayaran) {
            echo "Pembayaran tidak ditemukan!";
            exit();
        }

        // Generate QR Code URL (dummy URL for formalitas)
        $qr_url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode("Bayar dengan QRIS untuk ID Pembayaran: $id_pembayaran") . "&size=200x200";
    } else {
        echo "Gagal memperbarui status pembayaran!";
        exit();
    }
} else {
    header("Location: daftar_kamar.php");
    exit();

    if (isset($_POST['cetak'])) {
        echo "<script>document.location.href='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QRIS Payment</title>
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

        #printButton {
            display: none;
        }

        .print-area {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                border: 1px solid black;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background: white;
                width: 600px;
                font-size: 25px;
                /* text-align: center; */
            }

            #printButton {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-2">
        <h3 class="text-center">Pembayaran QRIS</h3>
        <div class="card mt-4">
            <div class="card-body text-center">
                <h5 class="card-title">Scan QR Code untuk Pembayaran</h5>
                <p class="card-text"><strong>Nama :</strong> <?= $pembayaran['nama'] ?></p>
                <p class="card-text"><strong>Total Pembayaran:</strong> Rp. <?= number_format($pembayaran['total_pembayaran'], 0, ',', '.') ?></p>
                <img src="<?= $qr_url ?>" alt="QR Code">
                <p class="mt-3">Silakan scan kode QR di atas untuk melanjutkan pembayaran dengan QRIS.</p>
                <button id="printButton" class="btn btn-primary mt-3 w-100" name="cetak">Cetak Bukti Pembayaran</button>
            </div>
        </div>
    </div>

    <!-- Area untuk cetak -->
    <div class="print-area">
        <h2 class="card-title mb-4 text-center">Detail Pembayaran</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID Pembayaran:</strong> <?= $id_pembayaran ?></p>
                <p><strong>ID Pemesanan:</strong> <?= $pembayaran['id_pemesanan'] ?></p>
                <p><strong>Nama:</strong> <?= $pembayaran['nama'] ?></p>
                <p><strong>Email:</strong> <?= $pembayaran['email'] ?></p>
                <p><strong>No HP:</strong> <?= $pembayaran['no_hp'] ?></p>
                <p><strong>Total Pembayaran:</strong> Rp. <?= number_format($pembayaran['total_pembayaran'], 0, ',', '.') ?></p>
                <p><strong>Metode Pembayaran:</strong> QRIS</p>
                <p><strong>Status Pembayaran:</strong> Lunas</p>
            </div>
        </div>
        <!-- Gambar cap atau tanda tangan -->
        <img src="img/lunas.png" alt="Signature" style="position: absolute; bottom: 0; right: 20px; max-width: 150px; height: auto;">
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mencetak halaman
        function printPage() {
            // Tampilkan area cetak
            document.querySelector('.print-area').style.display = 'block';
            // Mencetak halaman
            window.print();
            // Sembunyikan kembali area cetak setelah pencetakan selesai
            document.querySelector('.print-area').style.display = 'none';
        }

        // Menangkap klik pada tombol cetak dan memanggil fungsi printPage
        document.getElementById("printButton").onclick = function() {
            printPage();
        };

        // Menampilkan tombol cetak setelah 6 detik
        setTimeout(function() {
            document.getElementById("printButton").style.display = "block";
        }, 6000);

        window.onafterprint = function() {
            window.location.href = 'index.php';
        };
    </script>
</body>

</html>