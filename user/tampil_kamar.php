<?php
include '../config.php';
session_start();

// Ambil data kamar yang tersedia
$query = "SELECT * FROM kamar WHERE status = 'Tersedia'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Kamar</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Daftar Kamar yang Tersedia</h3>
        <div class="row mt-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Kamar No: <?= $row['no_kamar'] ?></h5>
                            <p class="card-text">Tipe: <?= $row['tipe_kamar'] ?></p>
                            <p class="card-text">Harga: Rp. <?= $row['harga'] ?></p>
                            <a href="pesan_kamar.php?id_kamar=<?= $row['id_kamar'] ?>" class="btn btn-primary">Pesan Kamar Ini</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>