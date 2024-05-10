<style>
/* Tambahkan overflow-y:auto; untuk mengaktifkan bilah gulir vertikal jika lebih dari 5 baris */
.table-scrollable {
  max-height: 316px;
  /* Sesuaikan tinggi maksimum sesuai kebutuhan Anda */
  overflow-y: auto;
  position: relative;
  /* Position harus diatur ke relative */
}

/* Gaya untuk menjaga kepala tabel tetap di tempat */
.table-scrollable thead {
  position: sticky;
  top: 0;
  /* Tetapkan kepala tabel di bagian atas */
  z-index: 1;
  /* Pastikan kepala tabel tetap di atas tubuh tabel saat menggulir */
}

/* Gaya untuk mengatur lebar relatif pada sel dalam kepala tabel */
.table-scrollable th {
  position: sticky;
  top: 0;
  /* Tetapkan kepala tabel di bagian atas */
  z-index: 1;
  /* Pastikan kepala tabel tetap di atas tubuh tabel saat menggulir */
}
</style>
<!-- Main content -->

<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <!-- Carousel Slider -->
    <div class="row">
      <div id="carouselExampleControls" class="carousel slide mb-3" data-ride="carousel">
        <div class="carousel-inner" style="border-radius:10px;">
          <div class="carousel-item active">
            <img src="<?= base_url('assets/template')?>/dist/img/banner4.jpg" class="d-block w-100" alt="Banner 1">
          </div>
          <div class="carousel-item">
            <img src="<?= base_url('assets/template')?>/dist/img/banner1.png" class="d-block w-100" alt="Banner 2">
          </div>
          <div class="carousel-item">
            <img src="<?= base_url('assets/template')?>/dist/img/banner3.png" class="d-block w-100" alt="Banner 3">
          </div>

          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon elevation-1"
            style="background: linear-gradient(to left, #642EFE, green); color: white;"><i
              class="fas fa-chart-line"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PEMASUKAN HARI INI</span>
            <span class="info-box-number">
              <?php if (!empty($dataRetribusi)) : ?>
              Total: Rp <?php echo number_format($dataRetribusi, 2, ',', '.'); ?>
              <?php else : ?>
              <p>Belum ada data retribusi hari ini.</p>
              <?php endif; ?>
            </span>
            <div style=" font-size:9pt;">
              <?php if (!empty($dataRetribusi)) : ?>
              Jumlah <b><?php echo $jumlahDataRetribusi; ?></b> Data
              <?php endif; ?>
            </div>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon elevation-1"
            style="background: linear-gradient(to left, #642EFE, #000066); color: white;"><i
              class="fas fa-chart-line"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PEMASUKAN BULAN LALU</span>
            <span class="info-box-number">
              <?php if (!empty($dataBulanlalu)) : ?>
              Total: Rp <?php echo number_format($dataBulanlalu, 2, ',', '.'); ?>
              <div style="font-size: 9pt;">
                Jumlah <b><?php echo $jumlahDataBulanlalu; ?></b> Data
              </div>
              <?php else : ?>
              <p>Belum ada data bulan lalu.</p>
              <?php endif; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon elevation-1"
            style="background: linear-gradient(to left, #642EFE, red); color: white;"><i
              class="fas fa-money-bill"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">BELUM BAYAR RETRIBUSI</span>
            <span class="info-box-number">
              <?php if (!empty($jumlahBelumBayar)) { ?>
              <b>Jumlah <?php echo $jumlahBelumBayar ?> Data</b>
              <?php } ?>
            </span>
            <a href="<?= base_url('retribusi_b_bayar')?>" style="font-size: 9pt; color:black;"><i
                class="fas fa-eye"></i> Lihat data</a>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon elevation-1"
            style="background: linear-gradient(to left, #642EFE, orange); color: white;"><i
              class="fas fa-money-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">DATA NPWRD</span>
            <span class="info-box-number">
              <?php if (!empty($dataNPWRD)) { ?>
              <b>Jumlah <?php echo $dataNPWRD ?> Data</b>
              <?php } ?>
            </span>
            <a href="<?= base_url('npwrd')?>" style="font-size: 9pt; color:black;"><i class="fas fa-eye"></i> Lihat
              data</a>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- Bagian untuk grafik bulanan -->
      <div class="col-md-7">
        <!-- Monthly Recap Report Card -->
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><i class="fas fa-chart-line"></i> Monthly Recap Report</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <p class="text-center">
              <strong>RECAP DATA RETRIBUSI SETIAP BULAN TAHUN <b><?php echo date('Y'); ?></b></strong>
            </p>
            <div class="chart">
              <!-- Chart Canvas untuk grafik bulanan -->
              <canvas id="retribusiChart" height="270"></canvas>
            </div>
            <!-- /.chart-responsive -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-5">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <p class="text-center">
              <strong><i class="fas fa-user"></i> SETORAN PETUGAS PENAGIH HARI INI</strong>
            </p>
            <div class="table-responsive table-scrollable">
              <table id="dailyReport" class="table table-bordered">
                <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Nilai Retribusi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                                // Query untuk mengambil data dari database berdasarkan tanggal hari ini
                                $today = date("Y-m-d");
                                $query = $this->db->query("SELECT tanggal, nama_petugas, nilai_retribusi FROM tb_retribusi WHERE tanggal = '$today' ORDER BY nama_petugas ASC");
                                $data = $query->result();
                                foreach ($data as $item) {
                                    ?>
                  <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?php echo $item->nama_petugas; ?></td>
                    <td>Rp. <?php echo number_format($item->nilai_retribusi,'0',',','.')?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Ambil data dari database -->
<?php
// Contoh pengambilan data menggunakan CodeIgniter
$query = $this->db->query("SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(nilai_retribusi) AS total_retribusi FROM tb_retribusi GROUP BY bulan");
$data = $query->result();
?>

<!-- Format data sebagai JSON -->
<script>
var dataFromDatabase = <?php echo json_encode($data); ?>;
</script>

<!-- Buat chart dengan chart.js -->
<script>
// Ambil konteks canvas
var ctx = document.getElementById('retribusiChart').getContext('2d');

// Buat data yang diperlukan untuk chart.js
var currentDate = new Date();
var currentYear = currentDate.getFullYear();
var currentMonth = currentDate.getMonth();
var months = [];
var retribusiData = [];

// Inisialisasi data bulan dari Januari hingga Desember
for (var i = 0; i < 12; i++) {
  var date = new Date(currentYear, i, 1);
  var options = {
    month: 'long',
  };
  months.push(date.toLocaleDateString('id-ID', options));
}

// Ambil data dari database dan sesuaikan dengan bulan
months.forEach(function(month) {
  var matchingData = dataFromDatabase.find(function(item) {
    return month === new Date(item.bulan + "-01").toLocaleDateString('id-ID', {
      month: 'long'
    });
  });

  if (matchingData) {
    retribusiData.push(matchingData.total_retribusi);
  } else {
    retribusiData.push(0);
  }
});

// Cek apakah tahun berubah untuk mereset data
var previousYear = currentYear;

var Retribusi = new Chart(ctx, {
  type: 'line',
  data: {
    labels: months,
    datasets: [{
      label: 'Total Retribusi',
      borderColor: '#000066',
      backgroundColor: '#000065',
      fill: true,
      tension: 0.4,
      pointRadius: 0,
      data: retribusiData,
    }],

  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        ticks: {
          autoSkip: true,
          maxTicksLimit: 12,
        },
        grid: {
          display: false, // Menghilangkan garis grid pada sumbu x
        },
      },
      y: {
        beginAtZero: true,
        stepSize: 10,
        grid: {
          display: false, // Menghilangkan garis grid pada sumbu y
        },
      },
    },
    plugins: {
      beforeDraw: function(chart) {
        // Cek apakah tahun berubah untuk mereset data
        if (currentYear !== previousYear) {
          chart.data.datasets[0].data = Array(12).fill(0);
          previousYear = currentYear;
          chart.update();
        }
      }
    }
  }
});
</script>


<!-- Ambil data dari database -->
<?php
// Query untuk mengambil data dari database
$query = $this->db->query("SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') AS hari, nama_petugas, COUNT(*) AS jumlah_data FROM tb_retribusi GROUP BY hari, nama_petugas");
$data = $query->result();
?>

<!-- Format data sebagai JSON -->
<script>
var dataFromDatabase = <?php echo json_encode($data); ?>;
</script>


<!-- Buat chart dengan chart.js -->
<script>
// Ambil konteks canvas
var ctx = document.getElementById('dailyReport').getContext('2d');

// Buat data yang diperlukan untuk chart.js
var days = dataFromDatabase.map(function(item) {
  return item.hari;
});

// Pisahkan data berdasarkan nama petugas
var petugasData = {};
dataFromDatabase.forEach(function(item) {
  var petugas = item.nama_petugas;
  if (!petugasData[petugas]) {
    petugasData[petugas] = {
      label: petugas,
      data: [],
    };
  }
  petugasData[petugas].data.push(item.jumlah_data);
});

// Buat array warna yang berbeda untuk setiap petugas
var colors = Object.keys(petugasData).map(function(_, index) {
  return 'rgba(' + index * 10 + ',' + index * 20 + ',' + index * 30 + ',0.8)';
});

// Membuat dataset untuk setiap petugas
var datasets = [];
Object.keys(petugasData).forEach(function(petugas) {
  datasets.push({
    label: petugasData[petugas].label,
    borderColor: colors.shift(),
    backgroundColor: 'rgba(70, 130, 180, 0.3)', // Warna area di bawah garis
    fill: true, // Mengisi area di bawah garis dengan warna
    data: petugasData[petugas].data,
  });
});

var DailyReport = new Chart(ctx, {
  type: 'line', // Menggunakan diagram garis
  data: {
    labels: days, // Menggunakan teks tanggal sebagai label pada sumbu x
    datasets: datasets, // Menggunakan dataset yang sudah dibuat
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        ticks: {
          autoSkip: true,
          maxTicksLimit: 12, // Maksimal 12 label tanggal untuk menghindari penumpukan
        },
      },
      y: {
        beginAtZero: true,
        stepSize: 10,
      },
    },
  },
});
</script>

<!-- Script Selamat Datang -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Periksa apakah ini adalah kunjungan pertama pengguna
  if (localStorage.getItem("firstVisit") === null) {
    // Menampilkan SweetAlert selamat datang
    Swal.fire({
      title: 'Selamat Datang!',
      text: 'Selamat datang <?php echo $username; ?> pada halaman dashboard!',
      icon: 'success',
    });

    // Tandai kunjungan pertama
    localStorage.setItem("firstVisit", "true");
  }
});
</script>