<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">OXOHotel</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="index.php" class="sidebar-link">
                <i class="fa fa-dashboard"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#master-data" aria-expanded="false" aria-controls="master-data">
                <i class="fa fa-database"></i>
                <span>Master Data</span>
            </a>
            <ul id="master-data" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="kamar.php" class="sidebar-link">Kamar</a>
                </li>
                <li class="sidebar-item">
                    <a href="pelanggan.php" class="sidebar-link">Pelanggan</a>
                </li>
                <li class="sidebar-item">
                    <a href="pengguna.php" class="sidebar-link">Pengguna</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#transaksi" aria-expanded="false" aria-controls="transaksi">
                <i class="fa fa-cart-arrow-down"></i>
                <span>Transaksi</span>
            </a>
            <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="pemesanan.php" class="sidebar-link">Pemesanan</a>
                </li>
                <li class="sidebar-item">
                    <a href="pembayaran.php" class="sidebar-link">Pembayaran</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="laporan.php" class="sidebar-link">
                <i class="lni lni-popup"></i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="logout.php" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Keluar</span>
        </a>
    </div>
</aside>