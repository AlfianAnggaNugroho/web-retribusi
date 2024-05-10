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

$sqlFilter = "";
$jenis = "";
$namaobjek = "";
$canPrint = false; // Inisialisasi untuk memeriksa apakah ada data yang bisa dicetak

if (isset($_POST['btnTampil'])) {
    $jenis = isset($_POST['cmbJenis']) ? $_POST['cmbJenis'] : '';
    $namaobjek = isset($_POST['cmbNamaObjek']) ? $_POST['cmbNamaObjek'] : '';

    // Inisialisasi filter SQL
    $sqlFilter = "WHERE 1=1";

    if (!empty($jenis)) {
        $sqlFilter .= " AND A.jenis_objek = '$jenis'";
    }
    if (!empty($namaobjek)) {
        $sqlFilter .= " AND A.nama_objek = '$namaobjek'";
    }

    // Periksa apakah ada data yang bisa dicetak
    $sqlCekData = "SELECT COUNT(*) as total FROM tb_npwrd A $sqlFilter";
    $resultCekData = $mysqli->query($sqlCekData);
    $rowCekData = $resultCekData->fetch_assoc();
    $totalData = $rowCekData['total'];
    
    if ($totalData > 0) {
        $canPrint = true;
    }
}

?>

<div class="card">
  <div style="background: linear-gradient(20deg, #000066 0%, #642EFE 70%, #642EFE 100%); color: white;"
    class="card-header text-white">
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; align-items: center;">
        <i class="fas fa-print" style="margin-right: 10px;"></i>
        <h6 style="margin: 0;"><b>CETAK NOMOR POKOK WAJIB RETRIBUSI DAERAH</b></h6>
      </div>
      <div style="display: flex; align-items: center;">
        <i class="fas fa-money-check" style="margin-right: 10px;"></i>
        <h6>Jenis: <b><?php echo (!empty($jenis) ? $jenis : 'Semua'); ?></b>,
          Nama Objek: <b><?php echo (!empty($namaobjek) ? $namaobjek : 'Semua'); ?></b></h6>
      </div>
    </div>
  </div>

  <!-- /.card-header -->
  <div class="card-body">
    <form style="margin-bottom: 2%" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form10"
      target="_self">
      <div class="row mb-3">
        <div class="col-lg-3" style="max-height: 150px; overflow-y: auto;">
          <label for="cmbJenis">Pilih Jenis Objek</label>
          <select name="cmbJenis" class="form-control">
            <option value="">Semua Jenis</option>
            <?php
                            $sqlJenis = "SELECT DISTINCT jenis_objek FROM tb_npwrd";
                            $resultJenis = $mysqli->query($sqlJenis);
                            while ($rowJenis = $resultJenis->fetch_assoc()) {
                                $selected = ($rowJenis['jenis_objek'] == $jenis) ? 'selected' : '';
                                echo '<option value="' . $rowJenis['jenis_objek'] . '" ' . $selected . '>' . $rowJenis['jenis_objek'] . '</option>';
                            }
                            ?>
          </select>
        </div>

        <div class="col-lg-3" style="max-height: 150px; overflow-y: auto;">
          <label for="cmbNamaObjek">Pilih Nama Objek</label>
          <select name="cmbNamaObjek" class="form-control">
            <option value="">Semua Nama Objek</option>
            <?php
                            $sqlNamaObjek = "SELECT DISTINCT nama_objek FROM tb_npwrd";
                            $resultNamaObjek = $mysqli->query($sqlNamaObjek);
                            while ($rowNamaObjek = $resultNamaObjek->fetch_assoc()) {
                                $selected = ($rowNamaObjek['nama_objek'] == $namaobjek) ? 'selected' : '';
                                echo '<option value="' . $rowNamaObjek['nama_objek'] . '" ' . $selected . '>' . $rowNamaObjek['nama_objek'] . '</option>';
                            }
                            ?>
          </select>
        </div>


        <div class="col-lg-2"></div>
        <div class="col-lg-2">
          <label>&nbsp;</label>
          <button name="btnTampil" type="submit" class="btn btn-primary btn-block float-end">
            <i style="margin-right:5px" class="fas fa-eye"></i>Tampilkan Data</button>
        </div>
        <div class="col-lg-2">
          <label>&nbsp;</label>
          <?php
                            // Tombol cetak hanya aktif jika ada data yang bisa dicetak
                            if ($canPrint) {
                            ?>
          <a href="cetak_npwrd?jenis=<?php echo $jenis; ?>&objek=<?php echo $namaobjek; ?>" target="_blank"
            class="btn btn-warning btn-block float-end" role="button">
            <i style="margin-right:5px" class="fas fa-print"></i> Cetak Laporan
          </a>
          <?php
                            } else {
                                // Jika tidak ada data yang bisa dicetak, tombol cetak dinonaktifkan
                            ?>
          <button type="button" class="btn btn-warning btn-block float-end" disabled>
            <i style="margin-right:5px" class="fas fa-print"></i> Cetak Laporan
          </button>
          <?php
                            }
                            ?>
        </div>
      </div>

    </form>

    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-hover">
        <thead class="table">
          <tr class="text-center">
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
                            if (isset($_POST['btnTampil'])) {
                                $sql = "SELECT A.* FROM tb_npwrd A $sqlFilter ORDER BY A.npwrd ASC";
                                $myQry = $mysqli->query($sql) or die("Query salah : " . $mysqli->error);
                                $nomor = 1;

                                while ($myData = $myQry->fetch_assoc()) {

                            ?>
          <tr>
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
                            }
                            ?>
        </tbody>
      </table>
    </div>

  </div>

  <!-- Tambahkan tautan ke Bootstrap JS di sini jika diperlukan -->
  </body>

  <?php
// Tutup koneksi database
$mysqli->close();
?>