<?php

include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="login.css" />
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="signin-signup">
      <form action="aksi_login.php" method="post" class="sign-in-form">
        <h2 class="title">Masuk</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Nama Pengguna" name="username" id="username" required />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Kata Sandi" name="password" id="password" required />
        </div>
        <input type="submit" value="Masuk" class="btn" />
        <p class="account-text">
          Belum punya akun? <a href="#" id="sign-up-btn2">Daftar</a>
        </p>
      </form>

      <form action="daftar_akun.php" method="post" class="sign-up-form">
        <h2 class="title">Daftar</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Nama Pengguna" name="username" required />
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="text" placeholder="Email" name="email" required />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Kata Sandi" name="password" required />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Konfirmasi Kata Sandi" name="confirm_password" required />
        </div>
        <input type="submit" value="Daftar" class="btn" />
        <p class="account-text">
          Sudah punya akun? <a href="#" id="sign-in-btn2">Masuk</a>
        </p>
      </form>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Sudah Menjadi Anggota?</h3>
          <p>
            Masuk untuk mengelola reservasi dan menikmati penawaran eksklusif.
          </p>
          <button class="btn" id="sign-in-btn">Masuk</button>
        </div>
        <img src="signin.svg" alt="" class="image" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Baru di Hotel Kami?</h3>
          <p>
            Bergabunglah sekarang untuk akses ke diskon khusus dan layanan
            premium.
          </p>

          <button class="btn" id="sign-up-btn">Daftar</button>
        </div>
        <img src="signup.svg" alt="" class="image" />
      </div>
    </div>
  </div>
  <script src="login.js"></script>
</body>

</html>