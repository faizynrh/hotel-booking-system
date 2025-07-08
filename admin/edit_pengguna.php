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
    <title>Edit Pengguna</title>
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
                <h3 class="mt-3 text-center fw-bold bg">EDIT DATA PENGGUNA</h3>
                <div class="mt-2 col-8 m-auto">
                    <?php
                    // MENGAMBIL DATA YANG AKAN DI EDIT BERDASARKAN ID SISWA
                    $id_users = $_GET['id_users'];
                    $query = "SELECT * FROM users WHERE id_users = $id_users";
                    // MENJALANKAN QUERY
                    $sql = mysqli_query($conn, $query);
                    // MENAMPILKAN DATA YANG AKAN DI EDIT DI FORM EDIT
                    foreach ($sql as $tampil) {
                    ?>
                        <form action="edit_pengguna_action.php" method="post">
                            <input type="text" name="id_users" value="<?= $tampil['id_users'] ?>" readonly hidden>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $tampil['email'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $tampil['username'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" value="<?= $tampil['password'] ?>">
                                    <button class="btn btn-outline-secondary" type="button" id="password-toggle" onmousedown="showPassword()" onmouseup="hidePassword()">Show</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="hakakses" class="form-label">Hak Akses</label>
                                <select class="form-select" id="hak_akses" name="hak_akses" required>
                                    <option value="" disabled>Silakan Pilih Hak Akses</option>
                                    <option value="Admin" <?= $tampil['hak_akses'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="Pengguna" <?= $tampil['hak_akses'] == 'pengguna' ? 'selected' : '' ?>>Pengguna</option>
                                </select>
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
        var passwordInput = document.getElementById('password');
        var passwordToggle = document.getElementById('password-toggle');
        var isPressed = false;

        function showPassword() {
            isPressed = true;
            passwordInput.type = 'text';
            passwordToggle.textContent = 'Hide';
        }

        function hidePassword() {
            if (!isPressed) {
                return;
            }
            isPressed = false;
            passwordInput.type = 'password';
            passwordToggle.textContent = 'Show';
        }
    </script>
</body>

</html>