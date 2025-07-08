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
    <title>Pelanggan</title>
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
                <h3 class="mt-4 text-center fw-bold">DATA PENGGUNA</h3>
                <div class="my-3">
                </div>
                <div class="table-responsive px-4">
                    <table class="table text-center mt-3">
                        <thead style="color: white; background-color: #0d6efd;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM users";
                            $sql = mysqli_query($conn, $query);
                            foreach ($sql as $tampil) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $tampil['email']; ?></td>
                                    <td><?= $tampil['username']; ?></td>
                                    <td><?= $tampil['password']; ?></td>
                                    <td><?= $tampil['hak_akses']; ?></td>
                                    <td>
                                        <a href="hapus_pengguna_action.php?id_users=<?= $tampil['id_users'] ?>"><i class="fa fa-trash fa-2x text-danger"></i></a>
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