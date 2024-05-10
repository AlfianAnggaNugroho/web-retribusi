<!DOCTYPE html>
<html>

<head>
  <title>Bukti Pembayaran</title>
  <!-- Sertakan Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  #tabel {
    border-collapse: collapse;
  }

  .row {
    font-size: 20pt;
  }

  .logo-left,
  .logo-right {
    width: 90px;
    height: auto;
    margin-top: 30px;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-bottom: -25px;
    font-size: 22pt;
  }

  .date {
    text-align: right;
    margin-top: 50px;
    font-size: 16pt;
  }

  .signature {
    font-size: 16pt;
  }
  </style>
  <?php
    function terbilang($nilai) {
      $bilangan = array(
        'Nol', 'Satu', 'Dua', 'Tiga', 'Empat',
        'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'
      );
      $temp = '';
    
      // Satuan ratusan juta
      if ($nilai >= 100000000) {
        $temp .= $bilangan[(int)($nilai / 100000000)] . ' Ratus ';
        $nilai %= 100000000;
      }
    
      // Satuan puluhan juta
      if ($nilai >= 10000000) {
        $temp .= terbilang((int)($nilai / 10000000)) . ' Puluh Juta ';
        $nilai %= 10000000;
      }
    
      // Satuan juta
      if ($nilai >= 1000000) {
        $temp .= terbilang((int)($nilai / 1000000)) . ' Juta ';
        $nilai %= 1000000;
      }
    
      // Satuan ribu
      if ($nilai >= 1000) {
        $temp .= terbilang((int)($nilai / 1000)) . ' Ribu ';
        $nilai %= 1000;
      }
    
      // Satuan ratusan
      if ($nilai >= 100) {
        $temp .= $bilangan[(int)($nilai / 100)] . ' Ratus ';
        $nilai %= 100;
      }
    
      // Tambahan untuk angka puluhan dan satuan
      if ($nilai >= 10) {
        if ($nilai >= 20) {
          $temp .= $bilangan[(int)($nilai / 10)] . ' Puluh ';
          $nilai %= 10;
        }
        if ($nilai > 0) {
          $temp .= $bilangan[$nilai];
        }
      } elseif ($nilai > 0) {
        $temp .= $bilangan[$nilai];
      }
    
      return $temp;
    }
    
  
    $nilai_retribusi = $retribusi->nilai_retribusi; // Ganti dengan nilai retribusi sesuai dengan kebutuhan Anda
    $terbilang_retribusi = terbilang($nilai_retribusi);
  ?>

</head>

<body style="font-family: Tahoma;">
  <div class="header">
    <img class="logo-left" src="<?= base_url('assets/template')?>/dist/img/dlh.png" alt="Logo Left">
    <div class="title" style="text-align: center;">
      <span>PEMERINTAHAN KOTA BANDAR LAMPUNG</span><br>
      <b style="font-size:26pt">DINAS LINGKUNGAN HIDUP</b>
    </div>

    <img class="logo-right" src="<?= base_url('assets/template')?>/dist/img/bdl.png" alt="Logo Right">
  </div>

  <table style="width: 100%; font-family: Calibri; border-collapse: collapse;">
    <tr>
      <td width="100%" style="vertical-align: top;">
        <div style="color: black; text-align: center; font-size: 16pt; margin-bottom:60px;">
          Alamat : Jl. Pulau Sebesi, Sukarame, Kec. Sukarame TelpFax (0721) 7620289
        </div>
        <hr style="color: black;border: 1px solid black;">
        <p>
        <div class="row">
          <div class="col-sm-2">Tanggal Cetak</div>
          <div class="col-sm-4">: <?= date("d/m/Y") ?></div>
          <div class="col-sm-6 ml-auto" style="text-align: right;"><strong>TANDA BUKTI PEMBAYARAN RETRIBUSI</strong>
          </div>
        </div>
        </p>

        <div class="row">
          <div class="col-sm-2">Nama Objek</div>
          <div class="col-sm-10">: <?= $retribusi->nama_objek ?></div>
        </div>
        <div class="row">
          <div class="col-sm-2">Wilayah</div>
          <div class="col-sm-10">: <?= $retribusi->nama_wilayah ?></div>
        </div>
        <div class="row">
          <div class="col-sm-2">Alamat</div>
          <div class="col-sm-10">: <?= $retribusi->alamat ?></div>
        </div>
        <div class="row">
          <div class="col-sm-2">NPWRD</div>
          <div class="col-sm-10">: <?= $retribusi->npwrd ?></div>
        </div>
        <div class="row">
          <div class="col-sm-2">Petugas</div>
          <div class="col-sm-10">: <?= $retribusi->nama_petugas ?></div>
        </div>
        <p>
        <div class="row">
          <div class="col-sm-7">Untuk Pembayaran Retribusi Pelayanan Kebersihan</div>
          <div class="col-sm-5 ml-auto" style="text-align: right;">Ket: <?= $retribusi->keterangan ?>
          </div>
          </p>

      </td>
    </tr>
  </table>

  <table id="example2" class="table table-bordered table-hover text-nowrap"
    style="font-size:16pt; border: 1px solid black;">
    <thead>
      <tr class="text-center">
        <th>Tanggal Bayar</th>
        <th>Jumlah (Terbilang)</th>
      </tr>
    </thead>
    <tbody>
      <tr class="text-center">
        <td style="vertical-align: middle;">
          <?php
            setlocale(LC_TIME, 'id_ID'); // Set lokal ke Bahasa Indonesia
            echo strftime('%d %B %Y', strtotime($retribusi->tanggal));
          ?>
        </td>
        <td>
          Rp <?php echo number_format($retribusi->nilai_retribusi, 2, ',', '.'); ?>
          <br>
          (<?= $terbilang_retribusi ?> Rupiah)
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Form tanda tangan -->
  <div class="date">
    <div>
      <p>Bandar Lampung, ...... <?= date(" F Y") ?></p>
    </div>
  </div>

  <div class="signature">
    <div class="row" style="text-align: center;">
      <div class="col-sm-auto" style="font-size: 18pt; margin-left:60px;">
        <p>Mengetahui,</p>
        <p>Bendahara Penerimaan</p>
        <div style="margin-top:100px; color:transparent">Bendahara Penerimaan</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div style="text-align:left;">NIP.</div>
      </div>
      <div class="col-sm-auto ml-auto" style="font-size: 18pt; margin-right:60px;">
        <p style="color: transparent;">Pembayar / Penyetor,</p>
        <p>Pembayar / Penyetor,</p>
        <div style="margin-top:100px; color:transparent">Petugas</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
      </div>
    </div>
  </div>



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

<script>
window.onbeforeunload = function() {
  window.opener.location.href = '<?= site_url('retribusi'); ?>'; // Redirect ke halaman retribusi saat tab ditutup

};
</script>


</html>