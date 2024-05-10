<!DOCTYPE html>
<html>

<head>
  <title>Laporan Data Retribusi</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/png" sizes="16x16"
    href="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png">

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <style>
  @page {
    size: auto;
  }

  /* Gaya tampilan cetak */
  body {
    font-family: Arial, sans-serif;
  }

  .header {
    display: flex;
    align-items: center;
    margin-top: 20px;
    margin-bottom: -10px;
  }

  .logo-left,
  .logo-right {
    width: 100px;
    height: auto;
  }

  .alamat {
    text-align: center;
    font-size: 15pt;
  }

  .title {
    font-size: 38px;
    text-align: center;
    flex-grow: 1;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    border: 1px solid black;
    padding: 8px;
  }

  .font-tabel {
    font-size: 18pt;
  }

  .date {
    text-align: right;
    margin-top: 20px;
    font-size: 18pt;
  }

  .signature {
    font-size: 18pt;
  }

  .page-break {
    page-break-before: always;
  }

  /* Responsif */
  @media screen and (max-width: 768px) {
    .header {
      flex-direction: column;
      align-items: center;
    }

    .logo-left,
    .logo-right {
      width: 70px;
    }

    .alamat {
      font-size: 12pt;
    }

    .title {
      font-size: 28px;
    }

    .font-tabel {
      font-size: 14pt;
    }

    .date {
      margin-top: 10px;
      font-size: 14pt;
    }

    .signature {
      font-size: 14pt;
    }

    .mr-auto,
    .ml-auto {
      margin-left: 0;
      margin-right: 0;
      text-align: center;
    }
  }
  </style>
</head>

<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "simretribusi";

    // Buat koneksi ke database
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    $awalTgl = isset($_GET['awal']) ? $_GET['awal'] : "01-".date('m-y');
    $akhirTgl = isset($_GET['akhir']) ? $_GET['akhir'] : date('Y-m-d');
    $petugas = isset($_GET['petugas']) ? $_GET['petugas'] : '';
    $objek = isset($_GET['objek']) ? $_GET['objek'] : '';

    $sqlPeriode = "WHERE A.tanggal BETWEEN '$awalTgl' AND '$akhirTgl'";
    
    if (!empty($petugas)) {
        $sqlPeriode .= " AND A.nama_petugas = '$petugas'";
    }
    if (!empty($objek)) {
        $sqlPeriode .= " AND A.nama_objek = '$objek'";
    }

    $sql = "SELECT A.* FROM tb_retribusi A $sqlPeriode ORDER BY A.tanggal ASC";
    $myQry = $mysqli->query($sql) or die("Query salah : " . $mysqli->error);
    ?>

  <div class="header">
    <img class="logo-left" src="<?= base_url('assets/template')?>/dist/img/dlh.png" alt="Logo Left">
    <div class="title" style="text-align: center;">
      <span style="font-size:23pt;">PEMERINTAHAN KOTA BANDAR LAMPUNG</span><br>
      <b>DINAS LINGKUNGAN HIDUP</b>
    </div>
    <img class="logo-right" src="<?= base_url('assets/template')?>/dist/img/bdl.png" alt="Logo Right">
  </div>

  <p class="alamat">Alamat : Jl. Pulau Sebesi, Sukarame, Kec. Sukarame TelpFAax (0721) 7620289</p>
  <hr style="color: black;border: 1px solid black;">
  <div style="text-align: center; font-size:18pt">
    <strong>(REKAP DATA RETRIBUSI)</strong>
  </div>

  <p>
  <div style="font-size: 14pt;">
    <div class="row">
      <div class="col-sm-3">SKPD</div>
      <div class="col-sm-9">: <b>Dinas Lingkungan Hidup Kota Bandar Lampung</b></div>
    </div>
    <div class="row">
      <div class="col-sm-3">Pimpinan</div>
      <div class="col-sm-9">: <b>Drs. A. BUDIMAN PM.,MM.</b></div>
    </div>
    <div class="row">
      <div class="col-sm-3">Periode</div>
      <div class="col-sm-9">: <b><?php echo date('d F Y', strtotime($awalTgl)); ?> s/d
          <?php echo date('d F Y', strtotime($akhirTgl)); ?></b></div>
    </div>
  </div>
  </p>



  <div class="font-tabel">
    <table>
      <thead
        style="background: linear-gradient(to left, #642EFE, #000066); color: white; text-align: center; font-size: 14pt;">
        <tr>
          <th>No</th>
          <th>Petugas</th>
          <th>Nama Objek</th>
          <th>Wilayah</th>
          <th>NPWRD</th>
          <th>Nilai Retribusi</th>
          <th>Tanggal Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $nomor = 1;
            $totalRetribusi = 0; // Inisialisasi total retribusi
            while ($myData = $myQry->fetch_assoc()) {
                $totalRetribusi += $myData['nilai_retribusi']; // Akumulasi total retribusi
            ?>
        <tr style="font-size: 14pt;">
          <td><?php echo $nomor; ?></td>
          <td><?php echo $myData['nama_petugas']; ?></td>
          <td><?php echo $myData['nama_objek']; ?></td>
          <td><?php echo $myData['nama_wilayah']; ?></td>
          <td><?php echo $myData['npwrd']; ?></td>
          <td>Rp. <?php echo number_format($myData['nilai_retribusi'], 0, ',', '.'); ?></td>
          <td><?php echo $myData['tanggal']; ?></td>
        </tr>
        <?php
                $nomor++;
            }
            ?>
      </tbody>

      <tr style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <td colspan="5"><b>Jumlah Pendapatan</b></td>
        <td colspan="2"><b>Rp. <?php echo number_format($totalRetribusi, '0', ',', '.'); ?></b></td>
      </tr>

    </table>
  </div>
  <!-- Form tanda tangan -->
  <div class="date">
    <div>
      <p>Bandar Lampung, <?= date("d F Y") ?></p>
    </div>
  </div>

  <div class="signature">
    <div class="row" style="text-align: center;">
      <div class="col-sm-auto" style="font-size: 18pt; ">
        <p>Mengetahui,</p>
        <p>Pimpinan</p>
        <div style="margin-top:100px;">Drs. A. BUDIMAN., PM,MM</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div>NIP. 19670401 199303 1 011</div>
      </div>
      <div class="col-sm-auto ml-auto" style="font-size: 18pt;">
        <p style="color: transparent;">Petugas Pendata</p>
        <p>Petugas Pendata</p>
        <div style="margin-top:100px; color:transparent">Petugas</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div style="text-align:left">NIP. </div>
      </div>
    </div>
  </div>

  <?php
    // Tutup koneksi database
    $mysqli->close();
    ?>
</body>
<script>
// Otomatis memanggil fungsi cetak setelah halaman dimuat
window.onload = function() {
  window.print();
  setTimeout(function() {
    window.close();
  }, 100);
};
</script>

</html>