  <?php
  include '../config.php';
  session_start();

  // Ambil data kamar yang tersedia
  $query = "SELECT * FROM kamar WHERE status = 'Tersedia'";
  $result = mysqli_query($conn, $query);

  // Cek apakah pengguna sudah login
  // Cek apakah user sudah login
  $isLoggedIn = isset($_SESSION['id_users']);
  if ($isLoggedIn) {
    $id_users = $_SESSION['id_users'];
    $userQuery = "SELECT username FROM users WHERE id_users = $id_users";
    $userResult = mysqli_query($conn, $userQuery);
    $user = mysqli_fetch_assoc($userResult);
  }
  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OXO Hotel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
      body {
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        color: #333;
      }

      .banner-image {
        background-image: url("img/1600478580_hotel-cover.jpg");
        background-size: cover;
      }

      .facility-image {
        height: 300px;
        width: 600px;
        object-fit: cover;
      }

      .custom-control-prev,
      .custom-control-next {
        width: 30px;
        height: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
      }

      .custom-control-prev {
        left: 5px;
      }

      .custom-control-next {
        right: 5px;
      }

      .carousel-control-prev-icon,
      .carousel-control-next-icon {
        width: 15px;
        height: 15px;
      }
    </style>
  </head>

  <body>
    <!-- Navbar  -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../user/img/logo2.png" alt="Nama Aplikasi Anda" height="30" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="#beranda">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#kamar">Kamar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#fasilitas">Fasilitas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#tentangkami">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#kontak">Kontak</a>
            </li>
            <li class="nav-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <li class="nav-item">
              <?php if ($isLoggedIn) : ?>
                <a class="btn btn-danger" href="logout.php">Hai, <?= strtoupper($user['username']); ?> (Logout)</a>
              <?php else : ?>
                <a class="btn btn-danger" href="../login/index.php">Masuk</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div id="beranda">
      <!-- Banner Image  -->
      <div class="banner-image w-100 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-top">
          <h1 class="text-white"></h1>
        </div>
      </div>
    </div>

    <div id="kamar">
      <!-- Main Content Area -->
      <div class="container my-5 d-grid gap-5">
        <div class="p-1 border">
          <img src="img/promo.png" alt="Promo" class="img-fluid" />
        </div>
      </div>

      <!-- Available Rooms Section -->
      <div class="container mt-5">
        <h3 class="text-center">Daftar Kamar yang Tersedia</h3>
        <div class="row mt-4">
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4">
              <div class="card mb-4">
                <div class="ratio ratio-16x9">
                  <img src="img/<?= $row['image'] ?>" class="card-img-top" alt="Room Image" />
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?= $row['tipe_kamar'] ?></h5>
                  <p class="card-text">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                  <a href="<?= $isLoggedIn ? 'pesan_kamar.php?id_kamar=' . $row['id_kamar'] : '../login/index.php'; ?>" class="btn btn-primary">Pesan Kamar</a>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <div id="fasilitas">
      <div class="container my-5">
        <h2 class="text-center mb-4">Fasilitas yang Tersedia</h2>
        <!-- Facility 1 -->
        <div class="row mb-4 border">
          <div class="col-md-6">
            <img src="img/kolam.jpg" class="img-fluid facility-image" alt="Facility Image" />
          </div>
          <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="text-center mb-4">
              <h5 class="card-title">Kolam Renang</h5>
              <p class="card-text">
                Nikmati fasilitas kolam renang kami yang luas dan bersih, cocok
                untuk bersantai dan berenang bersama keluarga.
              </p>
            </div>
          </div>
        </div>

        <!-- Facility 2 -->
        <div class="row mb-4 border">
          <div class="col-md-6 order-md-2">
            <img src="img/gym.jpg" class="img-fluid facility-image" alt="Facility Image" />
          </div>
          <div class="col-md-6 d-flex flex-column align-items-center justify-content-center order-md-1">
            <div class="text-center mb-4">
              <h5 class="card-title">Pusat Kebugaran</h5>
              <p class="card-text">
                Fasilitas pusat kebugaran lengkap dengan peralatan modern untuk
                menjaga kebugaran Anda selama menginap.
              </p>
            </div>
          </div>
        </div>

        <!-- Facility 3 -->
        <div class="row mb-4 border">
          <div class="col-md-6">
            <img src="img/sauna.jpg" class="img-fluid facility-image" alt="Facility Image" />
          </div>
          <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="text-center mb-4">
              <h5 class="card-title">Spa & Sauna</h5>
              <p class="card-text">
                Manjakan diri Anda dengan layanan spa dan sauna kami yang
                menenangkan, memberikan relaksasi maksimal.
              </p>
            </div>
          </div>
        </div>

        <!-- Facility 4 -->
        <div class="row mb-4 border">
          <div class="col-md-6 order-md-2">
            <img src="img/restoran.jpg" class="img-fluid facility-image" alt="Facility Image" />
          </div>
          <div class="col-md-6 d-flex flex-column align-items-center justify-content-center order-md-1">
            <div class="text-center mb-4">
              <h5 class="card-title">Restoran</h5>
              <p class="card-text">
                Nikmati berbagai pilihan kuliner lezat di restoran kami yang
                menyajikan masakan lokal dan internasional.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="p-5 border">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
        veniam ipsa earum quibusdam, atque ipsum error maiores natus iusto fugit
        id saepe neque rerum magni laudantium accusantium dolorem numquam quasi.
      </p>
    </div>
    <div class="p-5 border">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
        veniam ipsa earum quibusdam, atque ipsum error maiores natus iusto fugit
        id saepe neque rerum magni laudantium accusantium dolorem numquam quasi.
        df
      </p>
    </div> -->
    <div id="tentangkami">
      <!-- Sejarah dan Visi Misi -->
      <section class="container my-5">
        <!-- Visi dan Misi Hotel OXO -->
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-4 text-center mt-3">Visi dan Misi Perusahaan Kami</h2>
          </div>
          <!-- Visi Hotel OXO -->
          <div class="col-md-6 mb-4">
            <img src="img/rsp3.jpg" alt="Visi Hotel OXO" class="img-fluid mb-4" />
            <h3>Visi</h3>
            <p>
              Menjadi pelopor dalam industri hospitality di Bali, menghadirkan
              pengalaman yang tak terlupakan bagi setiap tamu yang menginap di
              sini. Kami ingin menjadi lebih dari sekadar hotel; kami ingin
              menjadi rumah kedua bagi para tamu kami, tempat di mana mereka
              merasa disambut dengan hangat dan dikelilingi oleh keindahan alam
              Bali.
            </p>
          </div>
          <!-- Misi Hotel OXO -->
          <div class="col-md-6 mb-4">
            <img src="img/rsp.jpg" alt="Misi Hotel OXO" class="img-fluid mb-4" />
            <h3>Misi</h3>
            <p>
              Terus meningkatkan standar pelayanan kami, menjaga kehangatan dan
              keramahan yang telah menjadi ciri khas kami sejak awal. Kami
              berusaha untuk menciptakan pengalaman yang menginspirasi dan
              menghibur, serta memastikan bahwa setiap tamu meninggalkan hotel
              kami dengan kenangan yang membekas dalam hati mereka. Dengan
              menyediakan lingkungan yang nyaman dan layanan yang luar biasa,
              kami bertekad untuk menjadikan setiap kunjungan tamu sebagai
              pengalaman yang tak terlupakan.
            </p>
          </div>
        </div>
      </section>

      <!-- Penghargaan dan Sertifikasi -->
      <section class="container my-5">
        <h2 class="mb-4 text-center">Penghargaan dan Sertifikasi</h2>
        <div id="awardsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-6 position-relative">
                  <img src="img/trip.png" class="d-block w-100 h-75" alt="Sertifikat Tripadvisor" />
                  <div class="text-center mt-2">
                    <h5>Sertifikat Tripadvisor</h5>
                    <p>
                      Penghargaan untuk layanan terbaik berdasarkan ulasan dari
                      wisatawan di Tripadvisor.
                    </p>
                  </div>
                </div>
                <div class="col-md-6 position-relative">
                  <img src="img/green.jpg" class="d-block w-100 h-75" alt="Green Hotel Award" />
                  <div class="text-center mt-2">
                    <h5>Green Hotel Award</h5>
                    <p>
                      Penghargaan atas komitmen kami terhadap praktik ramah
                      lingkungan dalam operasional hotel.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-6 position-relative">
                  <img src="img/itta.jpg" class="d-block w-100 h-75" alt="Indonesian Travel and Tourism Awards" />
                  <div class="text-center mt-2">
                    <h5>Indonesian Travel and Tourism Awards</h5>
                    <p>
                      Pengakuan atas keunggulan dalam industri perjalanan dan
                      pariwisata di Indonesia.
                    </p>
                  </div>
                </div>
                <div class="col-md-6 position-relative">
                  <img src="img/hia.jpg" class="d-block w-100 h-75" alt="Hospitality Indonesia Awards" />
                  <div class="text-center mt-2">
                    <h5>Hospitality Indonesia Awards</h5>
                    <p>
                      Penghargaan untuk layanan dan fasilitas luar biasa dalam
                      industri perhotelan di Indonesia.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev custom-control-prev" type="button" data-bs-target="#awardsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next custom-control-next" type="button" data-bs-target="#awardsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>
    </div>

    <!-- <section class="container my-5"> -->
    <!-- Sejarah Hotel OXO -->
    <!-- <div class="row mb-5">
        <div class="col-md-12 text-center">
          <h2 class="mb-4">Sejarah Hotel OXO</h2>
          <img
            src="img/villa.jpg"
            alt="Sejarah Hotel OXO"
            class="img-fluid mb-4 w-50 mx-auto"
          />
        </div>
      </div>

      <div class="row mb-5">
        <div class="col-md-12">
          <p class="text-start">
            Pada awal milenium baru, Hotel OXO lahir dari impian I Gusti Made
            Wirawan untuk menciptakan sebuah destinasi penginapan istimewa di
            Bali. Bersama istrinya, Ni Luh Ayu Dewi, mereka membangun sebuah
            vila kecil di tengah keindahan alam Bali. Dengan penuh dedikasi,
            vila tersebut berkembang menjadi sebuah hotel yang memikat hati tamu
            dari seluruh dunia. Nama "OXO" diberikan sebagai penghormatan kepada
            tiga generasi keluarga mereka yang menjadi inspirasi dalam
            perjalanan ini.
          </p>
        </div>
      </div>
    </section> -->

    <!-- Informasi Tambahan -->
    <!-- <section class="container my-5">
      <div class="row">
        <div class="col-md-6">
          <h2>Pemilik dan Manajemen</h2>
          <p>Nama Pemilik: I Gusti Made Wirawan</p>
          <p>Nama Manajemen: Ni Luh Ayu Dewi</p>
        </div>
        <div class="col-md-6">
          <h2>Informasi Lokasi</h2>
          <p>
            Hotel OXO terletak di dekat pantai Bali yang strategis untuk disewa.
          </p>
        </div>
      </div>
    </section> -->

    <!-- Bootstrap JS (Make sure this is included at the bottom of your body tag) -->

    <!-- Galeri Foto -->
    <!-- <section class="container my-5">
      <h2>Galeri Foto</h2>
      <div class="slideshow-container">
        <div class="mySlides fade">
          <img src="img/foto1.jpg" style="width: 100%" />
        </div>
        <div class="mySlides fade">
          <img src="img/foto2.jpg" style="width: 100%" />
        </div>
        <div class="mySlides fade">
          <img src="img/foto3.jpg" style="width: 100%" />
        </div> -->
    <!-- Tambahkan gambar-gambar lainnya di sini -->
    <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
    </section> -->

    <div id="kontak">
      <!-- Card untuk Maps dan Sosial Media -->
      <section class="container my-5">
        <div class="row">
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title text-center">Maps</h5>
                <!-- Ganti dengan embed map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.480572622052!2d115.18891631480257!3d-8.340456884506964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd237b896258ead%3A0xf50a2acce55aee!2sKuta%20Beach!5e0!3m2!1sen!2sid!4v1644470605930!5m2!1sen!2sid" width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body d-flex flex-column position-relative">
                <div class="text-center">
                  <h5 class="card-title">Kontak Kami</h5>
                  <img src="img/cs.jpg" alt="Image" class="img-fluid mb-3 w-75 h-75" />
                </div>
                <div>
                  <p>Email: example@example.com</p>
                  <p>No. Kantor: +123456789</p>
                </div>
                <div class="position-absolute bottom-0 end-0 mb-4">
                  <!-- <h5 class="card-title">Sosial Media</h5> -->
                  <ul class="list-unstyled list-inline mb-0">
                    <li class="list-inline-item">
                      <a href="#" class="btn btn-link text-dark"><i class="fa fa-facebook fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" class="btn btn-link text-dark"><i class="fa fa-twitter fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" class="btn btn-link text-dark"><i class="fa fa-instagram fa-2x"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer class="bg-dark text-light text-center py-1" style="background-color: #212529">
      <div class="container">
        <p class="mb-0">&copy; 2024 faizyanuarhern. All rights reserved.</p>
      </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      var nav = document.querySelector("nav");

      window.addEventListener("scroll", function() {
        if (window.pageYOffset > 100) {
          nav.classList.add("bg-dark", "shadow");
        } else {
          nav.classList.remove("bg-dark", "shadow");
        }
      });
      // Initialize the carousel with automatic sliding
      var myCarousel = document.querySelector("#awardsCarousel");
      var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 5000, // Slide interval in milliseconds (5 seconds)
        ride: "carousel",
      });
    </script>
    <!-- <script>
      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides((slideIndex += n));
      }

      function currentSlide(n) {
        showSlides((slideIndex = n));
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {
          slideIndex = 1;
        }
        if (n < 1) {
          slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
      }
    </script> -->
  </body>

  </html>