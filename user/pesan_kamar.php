<?php
include '../config.php';
session_start();

$id_kamar = $_GET['id_kamar'];

// Ambil data kamar berdasarkan id_kamar
$query = "SELECT * FROM kamar WHERE id_kamar = '$id_kamar'";
$result = mysqli_query($conn, $query);
$kamar = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesan Kamar</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('img/bg1.png');
            /* Replace with the path to your background image */
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
            /* White background with transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5 bg-white mb-5">
        <h3 class="text-center">Form Pemesanan Kamar</h3>
        <form id="formPemesanan" action="pesan_kamar_action.php" method="POST">
            <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar'] ?>" />
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                        <input type="date" class="form-control" id="tanggal_checkin" name="tanggal_checkin" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                        <input type="date" class="form-control" id="tanggal_checkout" name="tanggal_checkout" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_dewasa" class="form-label">Jumlah Dewasa</label>
                        <input type="number" class="form-control" id="jumlah_dewasa" name="jumlah_dewasa" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                        <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_anak" class="form-label">Harga Permalam</label>
                        <input type="number" name="harga" class="form-control" id="harga" name="harga" value="<?= $kamar['harga'] ?>" required readonly />
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
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const hour = today.getHours();
            const minute = today.getMinutes();

            let minCheckinDate;
            let minCheckoutDate;

            if (hour >= 13 || (hour === 13 && minute >= 30)) {
                // If current time is past or at 13:30, set min check-in date to tomorrow
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                minCheckinDate = tomorrow.toISOString().split('T')[0];
            } else {
                // If current time is before 13:30, set min check-in date to today
                minCheckinDate = today.toISOString().split('T')[0];
            }

            document.getElementById('tanggal_checkin').setAttribute('min', minCheckinDate);

            document.getElementById('formPemesanan').addEventListener('change', function() {
                const checkinDate = new Date(document.getElementById('tanggal_checkin').value);
                const checkoutDate = new Date(document.getElementById('tanggal_checkout').value);

                const oneDayInMillis = 24 * 60 * 60 * 1000; // One day in milliseconds

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