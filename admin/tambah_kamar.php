<?php
include '../config.php';
session_start();

// Fungsi untuk menghasilkan nomor kamar berdasarkan tipe kamar
function generateRoomNumber($conn, $tipe_kamar)
{
    switch ($tipe_kamar) {
        case 'Standard':
            $prefix = 'STD';
            break;
        case 'Deluxe':
            $prefix = 'DLX';
            break;
        case 'Luxury':
            $prefix = 'LXR';
            break;
        default:
            $prefix = '';
    }

    $query = "SELECT MAX(SUBSTRING(no_kamar, 4)) AS last_room_number FROM kamar WHERE tipe_kamar = '$tipe_kamar'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $last_room_number = intval($row['last_room_number']);
    $next_room_number = $prefix . sprintf("%03d", $last_room_number + 1);

    return $next_room_number;
}

$default_room_number = '';

if (isset($_POST['tipe_kamar'])) {
    $tipe_kamar = $_POST['tipe_kamar'];
    $default_room_number = generateRoomNumber($conn, $tipe_kamar);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Kamar</title>
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
            <div class="container mt-3 bg-white mb-3">
                <h3 class="mt-3 text-center fw-bold bg">TAMBAHKAN DATA KAMAR</h3>
                <div class="mt-2 col-8 m-auto">
                    <form action="tambah_kamar_action.php" method="post">
                        <div class="mb-3">
                            <label for="no_kamar" class="form-label">No Kamar</label>
                            <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?php echo $default_room_number; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                            <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                                <option value="" selected disabled>Silakan Pilih Tipe Kamar</option>
                                <option value="Standard">Standard</option>
                                <option value="Deluxe">Deluxe</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" selected disabled>Silakan Pilih Status Kamar</option>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Terpesan">Terpesan</option>
                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                            </select>
                        </div> -->
                        <button type="submit" class="btn btn-primary mt-3 mb-4 w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Ambil elemen select tipe kamar dan input no_kamar
        const tipeKamarSelect = document.getElementById('tipe_kamar');
        const noKamarInput = document.getElementById('no_kamar');

        // Event listener untuk perubahan pada select tipe kamar
        tipeKamarSelect.addEventListener('change', function() {
            // Ambil nilai yang dipilih dari select tipe kamar
            const selectedType = this.value;
            // Kirim nilai yang dipilih untuk menghasilkan nomor kamar
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
                    // Set nilai nomor kamar ke input no_kamar
                    noKamarInput.value = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>