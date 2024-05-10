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

$sqlPeriode = "";
$awalTgl = "";
$akhirTgl = "";
$tglAwal = "";
$tglAkhir = "";
$petugas = "";
$namaobjek = "";

if (isset($_POST['btnTampil'])) {
    $tglAwal    = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-y');
    $tglAkhir   = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('Y-m-d');
    $petugas    = isset($_POST['cmbPetugas']) ? $_POST['cmbPetugas'] : '';
    $namaobjek  = isset($_POST['cmbNamaObjek']) ? $_POST['cmbNamaObjek'] : '';

    $sqlPeriode = "where A.tanggal BETWEEN '$tglAwal' AND '$tglAkhir'";
    
    if (!empty($petugas)) {
        $sqlPeriode .= " AND A.nama_petugas = '$petugas'";
    }
    if (!empty($namaobjek)) {
        $sqlPeriode .= " AND A.nama_objek = '$namaobjek'";
    }
    $totalRetribusi = 0; // Inisialisasi total retribusi
    
} else {
    $awalTgl    = "01-".date('m-y');
    $akhirTgl   = date('d-m-y');

    $sqlPeriode = "where A.tanggal BETWEEN '$awalTgl' AND '$akhirTgl'";
    $totalRetribusi = 0; // Inisialisasi total retribusi
}

$userLevel = "";
// Periksa apakah session 'username' dan 'last_login' tersedia
if ($this->session->userdata('username') && $this->session->userdata('last_login')) {
  $username = $this->session->userdata('username');
  $lastLogin = $this->session->userdata('last_login');
  $userLevel = $this->session->userdata('us_level');
} else {
  echo "Pengguna belum login.";
}

$isAdmin = ($userLevel === 'Admin');
?>


<div class="card">
  <div style="background: linear-gradient(20deg, #000066 0%, #642EFE 70%, green 100%); color: white;"
    class="card-header text-white">
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; align-items: center;">
        <i class="fas fa-print" style="margin-right: 10px;"></i>
        <h6 style="margin: 0;"><b>LAPORAN SUDAH BAYAR RETRIBUSI</b></h6>
      </div>

      <div style="display: flex; align-items: center;">
        <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i>
        <h6 style="margin: 0;">Periode <b><?php echo date('d F Y', strtotime($tglAwal)); ?></b> s/d
          <b><?php echo date('d F Y', strtotime($tglAkhir)); ?></b>
        </h6>
      </div>
    </div>
  </div>




  <!-- /.card-header -->
  <div class="card-body">
    <form style="margin-bottom: 2%" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form10"
      target="_self">
      <div class="row mb-3">
        <div class="col-lg-3">
          <label for="txtTglAwal">Dari Tanggal</label>
          <input name="txtTglAwal" type="date" class="form-control"
            value="<?php echo isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : $awalTgl; ?>" size="10" />
        </div>
        <div class="col-lg-3">
          <label for="txtTglAkhir">Sampai Tanggal</label>
          <input name="txtTglAkhir" type="date" class="form-control"
            value="<?php echo isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : $akhirTgl; ?>" size="10" />
        </div>
        <div class="col-lg-2 ml-auto">
          <label>&nbsp;</label>
          <button name="btnTampil" type="submit" class="btn btn-primary btn-block">
            <i style="margin-right:5px" class="fas fa-eye"></i>Tampilkan Data
          </button>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-3" style="max-height: 150px; overflow-y: auto;">
          <label for="cmbPetugas">Pilih Petugas</label>
          <select name="cmbPetugas" class="form-control">
            <option value="">Semua Petugas</option>
            <?php
        $sqlPetugas = "SELECT DISTINCT nama_petugas FROM tb_retribusi";
        $resultPetugas = $mysqli->query($sqlPetugas);
        while ($rowPetugas = $resultPetugas->fetch_assoc()) {
          $selected = ($rowPetugas['nama_petugas'] == $petugas) ? 'selected' : '';
          echo '<option value="' . $rowPetugas['nama_petugas'] . '" ' . $selected . '>' . $rowPetugas['nama_petugas'] . '</option>';
        }
        ?>
          </select>
        </div>

        <div class="col-lg-3" style="max-height: 150px; overflow-y: auto;">
          <label for="cmbNamaObjek">Pilih Nama Objek</label>
          <select name="cmbNamaObjek" class="form-control">
            <option value="">Semua Nama Objek</option>
            <?php
        $sqlNamaObjek = "SELECT DISTINCT nama_objek FROM tb_retribusi";
        $resultNamaObjek = $mysqli->query($sqlNamaObjek);
        while ($rowNamaObjek = $resultNamaObjek->fetch_assoc()) {
          $selected = ($rowNamaObjek['nama_objek'] == $namaobjek) ? 'selected' : '';
          echo '<option value="' . $rowNamaObjek['nama_objek'] . '" ' . $selected . '>' . $rowNamaObjek['nama_objek'] . '</option>';
        }
        ?>
          </select>
        </div>

        <?php if (!$isAdmin) { ?>
        <div class="col-lg-2 ml-auto">
          <a href="cetak?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir; ?>&petugas=<?php echo $petugas; ?>&objek=<?php echo $namaobjek; ?>"
            target="_blank" class="btn btn-warning btn-block" role="button">
            <i style="margin-right:5px" class="fas fa-print"></i> Cetak Laporan
          </a>
        </div>
        <?php }?>
      </div>
    </form>



    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-hover">
        <thead class="table">
          <tr class="text-center">
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
          <?php if (isset($_POST['btnTampil'])) { ?>
          <?php                                
                                $sql = "SELECT A.* FROM tb_retribusi A $sqlPeriode ORDER BY A.tanggal ASC";
                                $myQry = $mysqli->query($sql) or die("Query salah : " . $mysqli->error);
                                $nomor = 1;
                                
                                while ($myData = $myQry->fetch_assoc()) {
                                    $totalRetribusi += $myData['nilai_retribusi']; // Akumulasi total retribusi
                                ?>
          <tr>
            <td class="text-center"><?php echo $nomor; ?></td>
            <td><?php echo $myData['nama_petugas']; ?></td>
            <td><?php echo $myData['nama_objek']; ?></td>
            <td><?php echo $myData['nama_wilayah']; ?></td>
            <td><?php echo $myData['npwrd']; ?></td>
            <td>Rp. <?php echo number_format($myData['nilai_retribusi'], '0', ',', '.'); ?></td>
            <td><?php echo $myData['tanggal']; ?></td>
          </tr>
          <?php
                                    $nomor++;
                                }
                                ?>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5"><b>Total Nilai Retribusi</b></td>
            <td colspan="2"><b>Rp. <?php echo number_format($totalRetribusi, 0, ',', '.'); ?></b></td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div>
</div>


<?php
// Tutup koneksi database
$mysqli->close();
?>