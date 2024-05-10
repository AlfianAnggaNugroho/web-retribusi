<?php
// Inisialisasi variabel
$username = "";
$lastLogin = "";
$userLevel = "";

// Periksa apakah session 'username' dan 'last_login' tersedia
if ($this->session->userdata('username') && $this->session->userdata('last_login')) {
  $username = $this->session->userdata('username');
  $lastLogin = $this->session->userdata('last_login');
  $userLevel = $this->session->userdata('us_level');
} else {
  echo "Pengguna belum login.";
}

// Tentukan apakah pengguna adalah "Petugas"
$isPetugas = ($userLevel === 'Petugas');
$isAdmin = ($userLevel === 'Admin');
$isPimpinan = ($userLevel === 'Pimpinan');
?>

<style>
.brand-link {
  justify-content: center;
  /* Tetapkan ke "center" secara default */
  border-bottom-right-radius: 15px;
  /* Radius sudut kanan bawah */
  border-bottom-left-radius: 15px;
  /* Radius sudut kiri bawah */
}

.text-size {
  font-size: 10pt;
}
</style>


<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark"
    style="background: linear-gradient(to right, #642EFE, white); color: white;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('dashboard') ?>" class="nav-link"><strong>Home</strong></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://dlh.bandarlampungkota.go.id/kontak.html" class="nav-link" target="_blank">
          <strong>Contact</strong>
        </a>

      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="color: black;">
          <b><?php echo $username; ?></b>
          <i class="far fa-user" style="color: black; margin-left: 10px;"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Pilihan Menu</span>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('profile')?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Lihat Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('login/logout')?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Selamat datang, <b><?php echo $username; ?></b></a>
        </div>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside style="background: linear-gradient(to left, #642EFE, #000066); color: white;"
    class="main-sidebar sidebar-dark-warning elevation-4 text-bold">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link d-flex elevation-1"
      style="padding-right:30px; background: linear-gradient(to left, #27346b, #000066); color: white;">
      <img src="<?= base_url('assets/template')?>/dist/img/logo2.png" alt="RETRIBUSI Logo" class="brand-image">
      <b class="brand-text" style="margin-left:-7px; font-weight: bold;"><strong>R E T R I B U S I</strong></b>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div style="color: white; border-color:white" class="user-panel mt-2 pb-2 mb-3 d-flex align-items-center">
        <div class="image">
          <img src="<?= base_url('assets/template')?>/dist/img/dlh.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <b style="font-size: 14px" class="d-block">Welcome, <?php echo $username; ?>!</b>
          <b style="font-size: 10px" class="d-block">Role Account: <?php echo $userLevel; ?></b>
          <a style="font-size: 12px" href="<?= base_url('profile')?>"><?php echo $lastLogin ?> </a><i
            style="font-size: 10px" class="fa fa-circle text-success"></i>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-4 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item" style="margin-bottom:10px">
            <a href="<?= base_url('dashboard') ?>"
              class="nav-link <?php if($this->uri->segment(1) == 'dashboard') echo 'active' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <?php if (!$isPetugas) { ?>
          <?php if (!$isPimpinan) { ?>
          <a href="#" class="link-disable">
            <span style="background: transparent; color: white; font-size: 10pt; margin-left:10px"
              class="brand-text "><b>MENU UTAMA</b></span>
          </a>

          <li class="nav-item mt-2 has-treeview <?php if($this->uri->segment(1) == 'petugas') echo 'menu-open' ?>
                                           <?php if($this->uri->segment(1) == 'objek') echo 'menu-open' ?>
                                           <?php if($this->uri->segment(1) == 'wilayah') echo 'menu-open' ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview text-size">
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('petugas')?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'petugas') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'petugas') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Data Petugas Penagih</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('objek')?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'objek') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'objek') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Data Objek</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('wilayah')?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'wilayah') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'wilayah') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Data Wilayah</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php } ?>

          <?php if (!$isPimpinan) { ?>
          <li class="nav-item has-treeview <?php if($this->uri->segment(1) == 'tambah_data_retribusi') echo 'menu-open' ?>
                                             <?php if($this->uri->segment(1) == 'retribusi_b_bayar') echo 'menu-open' ?>
                                             <?php if($this->uri->segment(1) == 'retribusi') echo 'menu-open' ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Pembayaran Retribusi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview text-size">
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('tambah_data_retribusi') ?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'tambah_data_retribusi') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'tambah_data_retribusi') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Tambahkan Data</p>
                </a>
              </li>

              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('retribusi_b_bayar') ?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'retribusi_b_bayar') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'retribusi_b_bayar') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Belum Bayar</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('retribusi') ?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'retribusi') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'retribusi') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Sudah Bayar</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="<?= base_url('npwrd') ?>"
              class="nav-link <?php if($this->uri->segment(1) == 'npwrd') echo 'active' ?>">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Data NPWRD
              </p>
            </a>
          </li>
          <?php } ?>


          <a href="#" class="link-disable mt-3">
            <span style="background: transparent; color: white; font-size: 10pt; margin-left:10px;"
              class="brand-text "><b>LAPORAN</b></span>
          </a>
          <li
            class="nav-item mt-2 has-treeview <?php if($this->uri->segment(1) == 'laporan') echo 'menu-open' ?>
                                                <?php if($this->uri->segment(1) == 'laporan_b_bayar') echo 'menu-open' ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan Retribusi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview text-size">
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('laporan')?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'laporan') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'laporan') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Laporan Sudah Bayar</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="padding-left: 21px;" href="<?= base_url('laporan_b_bayar')?>"
                  class="nav-link <?php if($this->uri->segment(1) == 'laporan_b_bayar') echo 'active' ?>">
                  <i style="margin-right: 7px"
                    class="far <?= ($this->uri->segment(1) == 'laporan_b_bayar') ? 'fa-check-circle' : 'fa-circle' ?> fa-sm"></i>
                  <p>Laporan Belum Bayar</p>
                </a>
              </li>
            </ul>

            <?php if (!$isPetugas) { ?>
          <li class="nav-item mt-2">
            <a href="<?= base_url('laporan_npwrd')?>"
              class="nav-link <?php if($this->uri->segment(1) == 'laporan_npwrd') echo 'active' ?>">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan NPWRD
              </p>
            </a>
          </li>
          <?php } ?>
          </li>

          <a href="#" class="link-disable mt-3">
            <span style="background: transparent; color: white; font-size: 10pt; margin-left:10px"
              class="brand-text"><b>AUTHENTIFICATION</b></span>
          </a>
          <?php if (!$isPetugas) { ?>
          <?php if (!$isPimpinan) { ?>
          <li class="nav-item mt-2">
            <a href="<?= base_url('user')?>"
              class="nav-link <?php if($this->uri->segment(1) == 'user') echo 'active' ?>">
              <i style="margin-right: 7px" class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <?php } ?>
          <?php }?>

          <?php if (!$isAdmin) { ?>
          <li class="nav-item <?php if($this->uri->segment(1) == 'profile') echo 'active' ?>">
            <a href="<?= base_url('profile')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="confirmLogout()">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
  // Membaca elemen pushmenu
  var pushMenuLink = document.querySelector('.nav-link[data-widget="pushmenu"]');
  var brandLink = document.querySelector('.brand-link');

  // Menambahkan event listener untuk mengubah justify-content saat pushmenu ditekan
  pushMenuLink.addEventListener('click', function() {
    // Cek apakah pushmenu sedang aktif atau tidak
    if (document.body.classList.contains('sidebar-collapse')) {
      // Pushmenu ditutup, atur justify-content ke center
      brandLink.style.justifyContent = 'center';
    } else {
      // Pushmenu dibuka, atur justify-content kembali ke awal (flex-start)
      brandLink.style.justifyContent = 'flex-start';
    }
  });
  </script>

  <script>
  function confirmLogout() {
    Swal.fire({
      title: 'Logout',
      text: 'Anda yakin ingin logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.isConfirmed) {
        localStorage.removeItem("firstVisit");
        // Jika pengguna mengkonfirmasi logout, maka arahkan ke URL logout
        window.location.href = '<?= base_url('login/logout')?>';
      }
    });
  }
  </script>

  <script>
  <?php if ($isPetugas): ?>
  // Jika pengguna adalah "Petugas," tambahkan pemblokiran akses ke halaman tertentu
  window.addEventListener('DOMContentLoaded', function() {
    var restrictedPages = ['petugas', 'objek', 'wilayah', 'user'];
    var currentPage = '<?= $this->uri->segment(1) ?>'; // Mendapatkan halaman saat ini

    if (restrictedPages.includes(currentPage)) {
      window.location.href =
        '<?= base_url('dashboard') ?>'; // Redirect kembali ke dashboard jika mencoba mengakses halaman terlarang
    }
  });
  <?php endif; ?>
  </script>



  <style>
  .content-header b {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  }

  .text-3d {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <b class="m-0 text-dark text-3d"><i class="fas fa-angle-double-right" data-toggle="tooltip"></i>
              <?= $title ?></b>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">