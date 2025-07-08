<?php
include '../config.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main" style="background-color: #f8f9fa;">
            <?php include "nav.php"; ?>
            <div class="mt-3"></div>
            <div class="container bg-white">
                <?php
                if (isset($_SESSION['alertType']) && isset($_SESSION['alertMessage'])) {
                    $alertType = $_SESSION['alertType'];
                    $alertMessage = $_SESSION['alertMessage'];
                ?>
                    <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
                        <?= $alertMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['alertType']);
                    unset($_SESSION['alertMessage']);
                }
                ?>
                <h3 class="mt-4 text-center fw-bold mb-4">DATA PEMESANAN</h3>
                <!-- <div class="my-3">
                    <a href="tambah_pelanggan.php" class="btn btn-primary" style="margin-left: 25px;"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                </div> -->
                <div class="table-responsive px-4">
                    <table class="table text-center">
                        <thead style="color: white; background-color: #0d6efd;">
                            <tr>
                                <th scope="col">No</th>
                                <!-- <th scope="col">ID</th> -->
                                <th scope="col">Nama</th>
                                <th scope="col">Kamar</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Tanggal Checkin</th>
                                <th scope="col">Tanggal Checkout</th>
                                <th scope="col">Jumlah Dewasa</th>
                                <th scope="col">Jumlah Anak</th>
                                <th scope="col">Total Biaya</th>
                                <!-- <th scope="col">Status Pemesanan</th> -->
                                <!-- <th scope="col">Aksi</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data dari tabel pemesanan dengan join ke tabel pelanggan dan kamar
                            $no = 1;
                            $query = "
                                SELECT p.id_pemesanan, pel.nama, k.no_kamar, p.tanggal_pesan, p.tanggal_checkin, p.tanggal_checkout, 
                                       p.jumlah_dewasa, p.jumlah_anak, p.total_biaya
                                FROM pemesanan p
                                JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
                                JOIN kamar k ON p.id_kamar = k.id_kamar
                            ";
                            $sql = mysqli_query($conn, $query);
                            foreach ($sql as $tampil) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>

                                    <td><?= $tampil['nama']; ?></td>
                                    <td><?= $tampil['no_kamar']; ?></td>
                                    <td><?= $tampil['tanggal_pesan']; ?></td>
                                    <td><?= $tampil['tanggal_checkin']; ?></td>
                                    <td><?= $tampil['tanggal_checkout']; ?></td>
                                    <td><?= $tampil['jumlah_dewasa']; ?></td>
                                    <td><?= $tampil['jumlah_anak']; ?></td>
                                    <td>Rp <?= number_format($tampil['total_biaya'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>