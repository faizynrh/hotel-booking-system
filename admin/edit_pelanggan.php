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
    <title>Edit Pelanggan</title>
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
                <h3 class="mt-3 text-center fw-bold bg">EDIT DATA PELANGGAN</h3>
                <div class="mt-2 col-8 m-auto">
                    <?php
                    // MENGAMBIL DATA YANG AKAN DI EDIT BERDASARKAN ID SISWA
                    $id_pelanggan = $_GET['id_pelanggan'];
                    $query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
                    // MENJALANKAN QUERY
                    $sql = mysqli_query($conn, $query);
                    // MENAMPILKAN DATA YANG AKAN DI EDIT DI FORM EDIT
                    foreach ($sql as $tampil) {
                    ?>
                        <form action="edit_pelanggan_action.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="id_pelanggan" value="<?= $tampil['id_pelanggan'] ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $tampil['nama'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" maxlength="16" value="<?= $tampil['nik'] ?>" required>
                                <div id="nik-error" class="text-danger" style="display:none;">NIK harus terdiri dari 16 karakter.</div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $tampil['alamat'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $tampil['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">No Hp</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $tampil['no_hp'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-4">Submit</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function validateForm() {
            var nikInput = document.getElementById('nik');
            var nik = nikInput.value;
            if (nik.length !== 16) {
                document.getElementById('nik-error').style.display = 'block';
                return false;
            } else {
                document.getElementById('nik-error').style.display = 'none';
                return true;
            }
        }
    </script>
</body>

</html>