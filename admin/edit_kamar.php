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
    <title>Edit Kamar</title>
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
            <div class="mt-3 bg-white mb-3 mx-5">
                <h3 class="mt-3 text-center fw-bold bg">EDIT DATA KAMAR</h3>
                <div class="mt-2 col-8 m-auto">
                    <?php
                    $id_kamar = $_GET['id_kamar'];
                    $query = "SELECT * FROM kamar WHERE id_kamar = $id_kamar";
                    $sql = mysqli_query($conn, $query);
                    foreach ($sql as $tampil) {
                    ?>
                        <form action="edit_kamar_action.php" method="post">
                            <input type="hidden" name="id_kamar" value="<?= $tampil['id_kamar'] ?>">
                            <div class="mb-3">
                                <label for="no_kamar" class="form-label">No Kamar</label>
                                <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?= $tampil['no_kamar'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                                <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                                    <option value="" disabled>Silakan Pilih Tipe Kamar</option>
                                    <option value="Standard" <?= $tampil['tipe_kamar'] == 'Standard' ? 'selected' : '' ?>>Standard</option>
                                    <option value="Deluxe" <?= $tampil['tipe_kamar'] == 'Deluxe' ? 'selected' : '' ?>>Deluxe</option>
                                    <option value="Luxury" <?= $tampil['tipe_kamar'] == 'Luxury' ? 'selected' : '' ?>>Luxury</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $tampil['harga'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" value="<?= $tampil['image'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" value="<?= $tampil['status'] ?>" required>
                                    <option value="" disabled>Silakan Pilih Status Kamar</option>
                                    <option value="Tersedia" <?= $tampil['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                    <option value="Terpesan" <?= $tampil['status'] == 'Terpesan' ? 'selected' : '' ?>>Terpesan</option>
                                    <option value="Tidak Tersedia" <?= $tampil['status'] == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-4">Submit</button>
                        </form>
                    <?php
                    }
                    ?>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                    <script>
                        const tipeKamarSelect = document.getElementById('tipe_kamar');
                        const noKamarInput = document.getElementById('no_kamar');

                        tipeKamarSelect.addEventListener('change', function() {
                            const selectedType = this.value;
                            fetch('generate_room_number.php', {
                                    method: 'POST',
                                    body: JSON.stringify({
                                        tipe_kamar: selectedType
                                    }),
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.text())
                                .then(data => {
                                    noKamarInput.value = data;
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>