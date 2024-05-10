<!DOCTYPE html>
<html>

<head>
  <title>Data NPWRD</title>
  <link rel="icon" type="image/png" sizes="16x16"
    href="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    $jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
    $objek = isset($_GET['objek']) ? $_GET['objek'] : '';
    
    // Inisialisasi filter SQL
    $sqlFilter = "WHERE 1=1";

    if (!empty($jenis)) {
        $sqlFilter .= " AND A.jenis_objek = '$jenis'";
    }
    if (!empty($objek)) {
        $sqlFilter .= " AND A.nama_objek = '$objek'";
    }

    $sql = "SELECT A.* FROM tb_npwrd A $sqlFilter ORDER BY A.npwrd ASC";
    $myQry = $mysqli->query($sql) or die("Query salah : " . $mysqli->error);

    // Inisialisasi variabel untuk melacak apakah ada data yang akan dicetak
    $dataAda = false;

    ?>

  <div class="header">
    <img class="logo-left" src="<?= base_url('assets/template')?>/dist/img/dlh.png" alt="Logo Left">
    <div class="title" style="text-align: center;">
      <span style="font-size:23pt;">PEMERINTAHAN KOTA BANDAR LAMPUNG</span><br>
      <b>DINAS LINGKUNGAN HIDUP</b>
    </div>
    <img class="logo-right" src="<?= base_url('assets/template')?>/dist/img/bdl.png" alt="Logo Right">
  </div>

  <p class="alamat">Alamat : Jl. Pulau Sebesi, Sukarame, Kec. Sukarame TelpFax (0721) 7620289</p>
  <hr style="color: black;border: 1px solid black;">
  <div style="text-align: center; font-size:20pt">
    <strong>DATA WAJIB RETRIBUSI DAERAH</strong>
  </div>

  <div class="font-tabel">
    <p>
    <div class="row">
      <div class="col-sm-2">Jenis Objek</div>
      <div class="col-sm-9">: <?php echo (!empty($jenis) ? $jenis : 'Semua Data'); ?>
      </div>
    </div>
    </p>
    <p>
    <div class="row">
      <div class="col-sm-2">Nama Objek</div>
      <div class="col-sm-9">: <?php echo (!empty($objek) ? $objek : 'Semua Data'); ?>
      </div>
    </div>
    </p>

    <?php
    if ($myQry->num_rows > 0) {
        $dataAda = true;
    }

    if ($dataAda) {
    ?>
    <table>
      <thead
        style="background: linear-gradient(to left, #642EFE, #000066); color: white; text-align:center; font-size: 14pt;">
        <tr>
          <th>No</th>
          <th>Jenis Objek</th>
          <th>Nama Objek</th>
          <th>Wilayah</th>
          <th>Alamat</th>
          <th>NPWRD</th>
        </tr>
      </thead>
      <tbody>
        <?php
                $nomor = 1;

                while ($myData = $myQry->fetch_assoc()) {

                ?>
        <tr style="font-size: 15pt;">
          <td class="text-center"><?php echo $nomor; ?></td>
          <td><?php echo $myData['jenis_objek']; ?></td>
          <td><?php echo $myData['nama_objek']; ?></td>
          <td><?php echo $myData['nama_wilayah']; ?></td>
          <td><?php echo $myData['alamat']; ?></td>
          <td><?php echo substr($myData['npwrd'], 0, 2) . '.' . substr($myData['npwrd'], 2); ?></td>
        </tr>
        <?php
                    $nomor++;
                }
                ?>
      </tbody>
    </table>
    <?php
    } else {
        // Jika tidak ada data yang cocok atau filter tidak dipilih, tampilkan pesan
        echo "<p>Tidak ada data yang cocok dengan filter yang diberikan.</p>";
    }
    ?>
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
        <div class="col-sm-auto ml-auto" style="font-size: 18pt; ">
          <p style="color: transparent;">Petugas Pendata</p>
          <p>Petugas Pendata</p>
          <div style="margin-top:100px; color:transparent">Petugas</div>
          <div style="border-bottom: 1px solid grey; width: 308px;"></div>
          <div style="text-align:left">NIP. </div>
        </div>
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