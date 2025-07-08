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
    <title>Kamar</title>
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
                <h3 class="mt-4 text-center fw-bold">DATA KAMAR</h3>
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
                <div class="my-3">
                    <a href="tambah_kamar.php" class="btn btn-primary" style="margin-left: 25px;">
                        <i class="fa fa-plus-circle"></i> Tambah Data
                    </a>
                    <!-- Input pencarian
                    <input type="text" id="searchInput" class="form-control mt-2" placeholder="Cari Tipe Kamar atau Status..."> -->
                </div>
                <div class="table-responsive px-4">
                    <table class="table text-center" id="kamarTable">
                        <thead style="color: white; background-color: #0d6efd;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Kamar</th>
                                <th scope="col">Tipe Kamar</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // menampilkan data dari table kamar
                            $no = 1;
                            $query = "SELECT * FROM kamar";
                            $sql = mysqli_query($conn, $query);
                            foreach ($sql as $tampil) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $tampil['no_kamar']; ?></td>
                                    <td><?= $tampil['tipe_kamar']; ?></td>
                                    <td>Rp <?= number_format($tampil['harga'], 0, ',', '.'); ?></td>
                                    <td><?= $tampil['image']; ?></td>
                                    <td><?= $tampil['status']; ?></td>
                                    <td>
                                        <a href="edit_kamar.php?id_kamar=<?= $tampil['id_kamar'] ?>"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="hapus_kamar_action.php?id_kamar=<?= $tampil['id_kamar'] ?>"><i class="fa fa-trash fa-2x text-danger"></i></a>
                                    </td>
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