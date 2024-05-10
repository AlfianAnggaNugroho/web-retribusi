<div class="card">
  <div class="card-header"
    style="background: linear-gradient(to right, #642EFE, white); color: white; text-shadow: 1px 1px 2px black;">
    <h6><strong><i class="fas fa-table" style="color: red;"></i> TABEL DATA RETRIBUSI
        BELUM BAYAR</strong></h6>
  </div>

  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover">
      <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <tr class="text-center">
          <th>No</th>
          <th>Penagih</th>
          <th>Nama Objek</th>
          <th>Wilayah</th>
          <!--<th class="d-none d-lg-table-cell">Alamat</th>
                    <th class="d-none d-lg-table-cell">NPWRD</th>-->
          <th>Status</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
                foreach ($retribusi_b_bayar as $rb): ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= $rb->nama_petugas ?></td>
          <td><?= $rb->nama_objek ?></td>
          <td><?= $rb->nama_wilayah ?></td>
          <!--<td class="d-none d-lg-table-cell"><?= $rb->alamat ?></td>
                        <td class="d-none d-lg-table-cell"><?= $rb->npwrd ?></td>-->
          <td><?= $rb->status ?></td>
          <td><?= $rb->tanggal ?></td>
          <td class="text-center">
            <button data-toggle="modal" data-target="#view<?= $rb->id_retribusi ?>" class="btn btn-primary btn-sm"><i
                class="fas fa-eye"></i></button>
            <button data-toggle="modal" data-target="#edit<?= $rb->id_retribusi ?>" class="btn btn-warning btn-sm"><i
                class="fas fa-edit"></i></button>
            <button data-toggle="modal" data-target="#bayar<?= $rb->id_retribusi ?>"
              class="btn btn-success btn-sm">Bayar</button>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Bayar -->
<?php foreach ($retribusi_b_bayar as $rb): ?>
<div class="modal fade" id="bayar<?= $rb->id_retribusi ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"
      style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, green 100%); color: white;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-money-bill"></i> <b> BAYAR RETRIBUSI</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('retribusi_b_bayar/bayar/' . $rb->id_retribusi) ?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="data_id" id="dataId<?= $rb->id_retribusi ?>">
            <div class="form-group">
              <label for="nilaiRetribusi">Nilai Retribusi</label>
              <input type="text" class="form-control" id="nilaiRetribusi<?= $rb->id_retribusi ?>" name="nilai_retribusi"
                placeholder="Rp." oninput="formatCurrencyInput(this)" onblur="formatCurrencyInput(this)">
            </div>

            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="text" class="form-control" id="keterangan<?= $rb->id_retribusi ?>" name="keterangan"
                placeholder="Opsional">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            <button onclick="removeCurrencyFormatAndSubmit(this)" data-input-id="nilaiRetribusi<?= $rb->id_retribusi ?>"
              type="submit" class="btn btn-success">
              <i class="fas fa-dollar-sign"></i> Bayar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>

<!-- Modal View -->
<?php foreach ($retribusi_b_bayar as $rb) : ?>
<div class="modal fade" id="view<?= $rb->id_retribusi ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"> </i> <b>DETAIL DATA RETRIBUSI BELUM
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
              <th style="width: 150px;">Status</th>
              <td><?= $rb->status ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Tanggal</th>
              <td><?= $rb->tanggal ?></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<?php endforeach ?>

<!-- Modal Edit -->
<?php foreach ($retribusi_b_bayar as $rb) : ?>
<div class="modal fade" id="edit<?= $rb->id_retribusi ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header"
        style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> <b>EDIT DATA RETRIBUSI BELUM
            BAYAR</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('retribusi_b_bayar/edit/' . $rb->id_retribusi) ?>" method="POST">


          <div class="card" style=" border-radius: 5px;">
            <div class="card-body"
              style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input value="<?= $rb->tanggal ?>" type="date" name="tanggal" class="form-control" id="tanggal"
                  placeholder="Tanggal"></input>
                <?= form_error('tanggal', '<div class="text-small text-danger">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            <button style="background: linear-gradient(to right, #642EFE, #000066); color: white;" type="submit"
              class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
          </div>
        </form>
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