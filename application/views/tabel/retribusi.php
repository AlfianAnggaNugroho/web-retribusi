<?php
// Periksa apakah session 'username' dan 'last_login' tersedia
if ($this->session->userdata('username') && $this->session->userdata('last_login')) {
  $username = $this->session->userdata('username');
  $lastLogin = $this->session->userdata('last_login');
  $userLevel = $this->session->userdata('us_level');
} else {
  echo "Pengguna belum login.";
}

// Tentukan apakah pengguna adalah "Petugas atau Admin"
$isPetugas = ($userLevel === 'Petugas');
$isAdmin = ($userLevel === 'Admin');
?>
<style>
/* Hanya sembunyikan elemen dengan class .display-column pada tabel DataTables */
table.dataTable .display-column {
  display: none;
}
</style>

<div class="card">
  <div class="card-header"
    style="background: linear-gradient(to right, #642EFE, white); color: white; text-shadow: 1px 1px 2px black;">
    <h6><strong><i class="fas fa-table" style="color: green;"></i> TABEL DATA RETRIBUSI
        SUDAH BAYAR</strong></h6>
  </div>




  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover text-nowrap">
      <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <tr class="text-center">
          <th>No</th>
          <th>Penagih</th>
          <th>Nama Objek</th>
          <!--<th>Wilayah</th>-->
          <th>Nilai Retribusi</th>
          <!--<th class="display-column">Alamat</th> 
                <th class="display-column">NPWRD</th> 
                <th class="display-column">Keterangan</th>-->
          <th>Tanggal Bayar</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $no = 1;
            foreach($retribusi as $rb) : ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= $rb->nama_petugas ?></td>
          <td><?= $rb->nama_objek ?></td>
          <!--<td><?= $rb->nama_wilayah ?></td>-->
          <td>Rp. <?php echo number_format($rb->nilai_retribusi,'0',',','.')?></td>
          <!--<td class="display-column"><?= $rb->alamat ?></td> 
                <td class="display-column"><?= $rb->npwrd ?></td> 
                <td class="display-column"><?= $rb->keterangan ?></td>-->
          <td><?= $rb->tanggal ?></td>
          <td class="text-center">
            <?php if (!$isAdmin) { ?>
            <button class="btn btn-success btn-sm btn-print" data-retribusi-id="<?= $rb->id_retribusi ?>">
              <i class="fas fa-print"></i>
            </button>
            <?php } ?>

            <button data-toggle="modal" data-target="#view<?= $rb->id_retribusi ?>" class="btn btn-primary btn-sm"><i
                class="fas fa-eye"></i></button>
            <?php if (!$isPetugas) { ?>
            <button data-toggle="modal" data-target="#edit<?= $rb->id_retribusi ?>" class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i></button>
            <a href="<?= base_url('retribusi/delete/' . $rb->id_retribusi) ?>" class="btn btn-danger btn-sm"
              onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
            <?php } ?>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot style="background: linear-gradient(to right, #642EFE, #000066); color: white;" class="text-center">
        <tr>
          <td colspan="3"><b>Total Keseluruhan Nilai Retribusi :</b></td>
          <td colspan="3"><b>Rp. <?= number_format($sumretribusi, 0, ',', '.') ?></b></td>
        </tr>
      </tfoot>

    </table>
  </div>
</div>


<!-- Alert Modal -->

<!-- Modal Edit -->
<?php foreach ($retribusi as $rb) : ?>
<div class="modal fade" id="edit<?= $rb->id_retribusi ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header"
        style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> <b>EDIT DATA RETRIBUSI SUDAH
            BAYAR</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('retribusi/edit/' . $rb->id_retribusi) ?>" method="POST">

          <div class="card" style=" border-radius: 5px;">
            <div class="card-body"
              style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white; border-radius: 10px;">
              <label for="nama_objek" class="objek-label">Nama Objek <i class="fas fa-info-circle"
                  data-toggle="tooltip"></i></label>
              <div class="input-group input-group-sm">
                <div class="input-group input-group-sm" style="position: relative;">
                  <input value="<?= $rb->nama_objek ?>" name="nama_objek"
                    style="margin-bottom: 10px; height: 30px; padding-left: 30px; border-radius:13px;" type="search"
                    id="nama_objek" class="form-control" placeholder="Cari Nama Objek" aria-label="Search">
                  <i class="fas fa-search" style="position: absolute; top: 8px; left: 10px; color: black;"></i>
                </div>
              </div>
              <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
              <?php
                                $tb_npwrd_sorted = array();

                                // Isi $tb_npwrd dari database atau sumber data lainnya
                                
                                // Menyusun ulang array $tb_npwrd berdasarkan nama objek
                                usort($tb_npwrd, function ($a, $b) {
                                    return strcmp($a->nama_objek, $b->nama_objek);
                                });
                                // Inisialisasi nomor urut
                                $nomor_urut = 1;
                                ?>
              <select value="<?= $rb->nama_objek ?>" multiple="multiple" id="nama_objek_select" class="form-control"
                name="nama_objek_select">
                <!-- Ubah tinggi sesuai kebutuhan Anda -->
                <?php foreach ($tb_npwrd as $obk): ?>
                <option style="font-weight: bold;" value="<?php echo $obk->nama_objek; ?>"
                  data-npwrd="<?php echo substr($obk->npwrd, 0, 2) . '.' . substr($obk->npwrd, 2); ?>"
                  data-wilayah="<?php echo $obk->nama_wilayah; ?>" data-alamat="<?php echo $obk->alamat; ?>">
                  <?php echo $nomor_urut . '.  ' . $obk->nama_objek; ?>
                </option>
                <?php
                                        // Tambahkan 1 pada nomor urut setiap kali iterasi
                                        $nomor_urut++;
                                        ?>
                <?php endforeach; ?>
              </select>

            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="nama_wilayah">Wilayah</label>
                <input value="<?= $rb->nama_wilayah ?>" type="text" name="nama_wilayah" class="form-control"
                  id="nama_wilayah" placeholder="" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input value="<?= $rb->alamat ?>" type="text" name="alamat" class="form-control" id="alamat"
                  placeholder="" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="npwrd">NPWRD</label>
                <input value="<?= $rb->npwrd ?>" type="text" name="npwrd" class="form-control" id="npwrd" placeholder=""
                  readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="nama_petugas">Penagih</label>
                <select id="nama_petugas" class="form-control" name="nama_petugas">
                  <?php foreach ($tb_petugas as $pgs) : ?>
                  <option value="<?= $pgs->nama_petugas; ?>"
                    <?= $rb->nama_petugas == $pgs->nama_petugas ? 'selected' : null ?>><?= $pgs->nama_petugas; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nilai_retribusi">Nilai Retribusi</label>
                <input value="<?= $rb->nilai_retribusi ?>" type="text" name="nilai_retribusi" class="form-control"
                  id="nilai_retribusi" placeholder="Rp." oninput="formatCurrencyInput(this)"
                  onblur="formatCurrencyInput(this)">
                <?= form_error('nilai_retribusi', '<div class="text-small text-danger">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="tanggal">Tanggal Bayar</label>
                <input value="<?= $rb->tanggal ?>" type="date" name="tanggal" class="form-control" id="tanggal"
                  placeholder="Tanggal"></input>
                <?= form_error('tanggal', '<div class="text-small text-danger">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input value="<?= $rb->keterangan ?>" type="text" name="keterangan" class="form-control" id="keterangan"
                  placeholder="Opsional">
                <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            <button onclick="removeCurrencyFormatAndSubmit(this)" data-input-id="nilai_retribusi"
              style="background: linear-gradient(to right, #642EFE, #000066); color: white;" type="submit"
              class="btn btn-primary">
              <i class="fas fa-save"></i> Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>

<!-- Modal View -->
<?php foreach ($retribusi as $rb) : ?>
<div class="modal fade" id="view<?= $rb->id_retribusi ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"> </i> <b>DETAIL DATA RETRIBUSI SUDAH
            BAYAR</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th style="width: 150px;">Nama Objek</th>
              <td><b><?= $rb->nama_objek ?></b></td>
            </tr>
            <tr>
              <th style="width: 150px;">Penagih</th>
              <td><?= $rb->nama_petugas ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Wilayah</th>
              <td><?= $rb->nama_wilayah ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Alamat</th>
              <td><?= $rb->alamat ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">NPWRD</th>
              <td><?= $rb->npwrd ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Nilai Retribusi</th>
              <td>Rp. <?php echo number_format($rb->nilai_retribusi,'0',',','.')?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Status</th>
              <td><?= $rb->status ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Tanggal Bayar</th>
              <td><?= $rb->tanggal ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Keterangan</th>
              <td><?= $rb->keterangan ?></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<?php endforeach ?>


<script>
// Menangkap elemen-elemen yang diperlukan
var modalEdits = document.querySelectorAll(".modal.fade[id^='edit']");

modalEdits.forEach(function(modalEdit) {
  var namaObjekSelect = modalEdit.querySelector(".form-control[name='nama_objek_select']");
  var npwrdInput = modalEdit.querySelector(".form-control[name='npwrd']");
  var wilayahInput = modalEdit.querySelector(".form-control[name='nama_wilayah']");
  var alamatInput = modalEdit.querySelector(".form-control[name='alamat']");
  var searchInput = modalEdit.querySelector(".form-control[name='nama_objek']");
  var nilaiRetribusiInput = modalEdit.querySelector(".form-control[name='nilai_retribusi']");

  // Menambahkan event listener untuk perubahan pada dropdown nama_objek
  namaObjekSelect.addEventListener("change", function() {
    // Mendapatkan nilai npwrd yang sesuai dari atribut data
    var selectedOption = this.options[this.selectedIndex];
    var npwrd = selectedOption.getAttribute("data-npwrd");
    var nama_wilayah = selectedOption.getAttribute("data-wilayah");
    var alamat = selectedOption.getAttribute("data-alamat");

    // Mengisi nilai npwrd
    npwrdInput.value = npwrd;
    wilayahInput.value = nama_wilayah;
    alamatInput.value = alamat;

    // Mengisi otomatis kolom pencarian
    searchInput.value = selectedOption.value;
  });

  // Fungsi untuk mengubah angka menjadi format mata uang saat modal edit dibuka
  formatCurrencyInput(nilaiRetribusiInput);

  // Menambahkan event listener untuk perubahan pada input nilai retribusi
  nilaiRetribusiInput.addEventListener("input", function() {
    formatCurrencyInput(this);
  });

  // Fungsi formatCurrencyInput yang sudah ada sebelumnya
  function formatCurrencyInput(input) {
    var value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = 'Rp ' + value;
  }

  // Fungsi untuk melakukan pencarian
  searchInput.addEventListener("input", function() {
    var input, filter, select, option, i;
    input = searchInput;
    filter = input.value.toUpperCase();
    select = namaObjekSelect;
    option = select.getElementsByTagName("option");

    for (i = 0; i < option.length; i++) {
      if (option[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
        option[i].style.display = "";
      } else {
        option[i].style.display = "none";
      }
    }
  });
});
</script>

<!-- Fungsi untuk Button Cetak Struk -->
<script>
$(document).ready(function() {
  $('.btn-print').click(function() {
    // Dapatkan ID retribusi dari tombol yang ditekan
    var retribusiId = $(this).data('retribusi-id');

    // Redirect ke halaman cetak dengan ID retribusi sebagai parameter
    window.open('<?= base_url('cetak_struk/index/') ?>' + retribusiId, '_blank');
  });
});
</script>