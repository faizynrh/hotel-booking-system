  <?php
  include '../config.php';
  session_start();

  // Query untuk mengambil informasi jumlah kamar yang tersedia
  $query_kamar = "SELECT COUNT(*) AS total_kamar FROM kamar WHERE status = 'Tersedia'";
  $result_kamar = mysqli_query($conn, $query_kamar);
  $row_kamar = mysqli_fetch_assoc($result_kamar);
  $total_kamar = $row_kamar['total_kamar'];

  // Query untuk mengambil informasi jumlah tamu
  $query_tamu = "SELECT COUNT(*) AS total_tamu FROM pemesanan";
  $result_tamu = mysqli_query($conn, $query_tamu);
  $row_tamu = mysqli_fetch_assoc($result_tamu);
  $total_tamu = $row_tamu['total_tamu'];

  $query_pendapatan = "SELECT SUM(total_pembayaran) AS total_pendapatan 
                     FROM pembayaran 
                     WHERE status_pembayaran = 'Lunas'";
  $result_pendapatan = mysqli_query($conn, $query_pendapatan);
  $row_pendapatan = mysqli_fetch_assoc($result_pendapatan);
  $total_pendapatan = $row_pendapatan['total_pendapatan'];


  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <div class="wrapper">
      <?php include "sidebar.php"; ?>
      <div class="main bg-light">
        <?php include "nav.php"; ?>
        <div class="container mt-4">
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header text-white fw-bold fs-5" style="background-color: #0e2238;">
                  Status Kamar
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-title">Kamar yang Tersedia</h6>
                    <h5 class="card-text"><?php echo $total_kamar; ?></h5>
                  </div>
                  <span class="icon"><i class="fa fa-bed fa-4x"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header text-white fw-bold fs-5" style="background-color: #0e2238;">
                  Tamu Aktif
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-title">Jumlah Tamu</h6>
                    <h5 class="card-text"><?php echo $total_tamu; ?></h5>
                  </div>
                  <span class="icon"><i class="fa fa-users fa-4x"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header text-white fw-bold fs-5" style="background-color: #0e2238;">
                  Pendapatan Hotel
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-title">Total Pendapatan</h6>
                    <h5 class="card-text">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></h5>
                  </div>
                  <span class="icon"><i class="fa fa-money fa-4x"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>

  </html>