<?php
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

// Ambil semua data NPWRD dari database
$npwrd = $this->M_npwrd->get_all();

// Urutkan array berdasarkan nomor NPWRD secara ascending
usort($npwrd, function ($a, $b) {
    return strcmp($a->npwrd, $b->npwrd);
});
?>

<div class="card">
  <div class="card-header"
    style="background: linear-gradient(to right, #642EFE, white); color: white; text-shadow: 1px 1px 2px black;">
    <?php if (!$isAdmin) { ?><h6><strong><i class="fas fa-table" style="color: white;"></i> TABEL DATA NPWRD</strong>
    </h6><?php } ?>
    <div class="row align-items-center justify-content-between">
      <div class="col-md-auto">
        <?php if (!$isPetugas) { ?>
        <a href="<?= base_url('npwrd/tambah') ?>" class="btn btn-sm"
          style="background: linear-gradient(to right, #000066, #642EFE); color: white;">
          <i class="fas fa-plus" style="margin-right:5px;"></i> Tambah Data
        </a>
        <?php } ?>
      </div>
    </div>
  </div>



  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover text-nowrap">
      <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <tr class="text-center">
          <th>No</th>
          <th>Jenis Objek</th>
          <th>Nama Objek</th>
          <th class="display">Wilayah</th>
          <th class="display">Alamat</th>
          <th>NPWRD</th>
          <th class="display">Keterangan</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $no = 1;
        foreach ($npwrd as $np): ?>
        <tr>
          <td class="text-center">
            <?= $no++ ?>
          </td>
          <td>
            <?= $np->jenis_objek ?>
          </td>
          <td>
            <?= $np->nama_objek ?>
          </td>
          <td class="display">
            <?= $np->nama_wilayah ?>
          </td>
          <td class="display">
            <?= $np->alamat ?>
          </td>
          <td>
            <?php echo substr($np->npwrd, 0, 2) . '.' . substr($np->npwrd, 2); ?>
          </td>
          <td class="display">
            <?= $np->keterangan ?>
          </td>
          <td class="text-center">
            <button data-toggle="modal" data-target="#view<?= $np->id_npwrd ?>" class="btn btn-primary btn-sm"><i
                class="fas fa-eye"></i></button>
            <?php if (!$isPetugas) { ?>
            <button data-toggle="modal" data-target="#edit<?= $np->id_npwrd ?>" class="btn btn-warning btn-sm"><i
                class="fas fa-edit"></i></button>
            <a href="<?= base_url('npwrd/delete/' . $np->id_npwrd) ?>" class="btn btn-danger btn-sm"
              onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
            <?php } ?>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>

    </table>
  </div>
</div>

<!-- Alert Modal -->

<!-- Modal Edit -->
<style>
.display {
  display: none;
}

.form-row {
  display: flex;
  justify-content: space-between;
}

.form-row .form-group {
  flex: 1;
  margin-right: 10px;
  /* Jarak antara form jenis objek dan wilayah */
}

.custom-dropdown {
  max-height: 150px;
  /* Batas item yang ditampilkan */
  overflow-y: auto;
}
</style>

<?php foreach ($npwrd as $np): ?>
<div class="modal fade" id="edit<?= $np->id_npwrd ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header"
        style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-edit"></i> Edit Data NPWRD
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('npwrd/edit/' . $np->id_npwrd) ?>" method="POST">
          <div class="row">
            <div class="form-group col-md-5">
              <label for="jenis_objek">Jenis Objek</label>
              <select id="jenis_objek" class="form-control custom-dropdown" name="jenis_objek">
                <?php foreach ($tb_objek as $obk): ?>
                <option value="<?= $obk->nama_objek ?>" <?= $np->jenis_objek == $obk->nama_objek ? 'selected' : '' ?>>
                  <?= $obk->nama_objek ?>
                </option>
                <?php endforeach; ?>
              </select>
              <?= form_error('jenis_objek', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-7">
              <label for="nama_objek">Nama Objek</label>
              <input value="<?= $np->nama_objek ?>" type="text" name="nama_objek" class="form-control" id="nama_objek"
                placeholder="Nama Objek">
              <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-md-5">
              <label for="nama_wilayah">Wilayah</label>
              <select id="nama_wilayah" class="form-control custom-dropdown" name="nama_wilayah">
                <option value="" selected="">-- Select --</option>
                <?php foreach ($tb_wilayah as $wlh): ?>
                <option value="<?= $wlh->nama_wilayah ?>"
                  <?= $np->nama_wilayah == $wlh->nama_wilayah ? 'selected' : '' ?>>
                  <?= $wlh->nama_wilayah ?>
                </option>
                <?php endforeach; ?>
              </select>
              <?= form_error('nama_wilayah', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-7">
              <label for="alamat">Alamat</label>
              <input value="<?= $np->alamat ?>" type="text" name="alamat" class="form-control" id="alamat"
                placeholder="Alamat">
              <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-md-5">
              <label for="keterangan">Keterangan</label>
              <input value="<?= $np->keterangan ?>" type="text" name="keterangan" class="form-control" id="keterangan"
                placeholder="Opsional">
              <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-4">
              <label for="npwrd">NPWRD</label>
              <input value="<?= $np->npwrd ?>" type="number" name="npwrd" class="form-control" id="npwrd"
                placeholder="00000">
              <?= form_error('npwrd', '<div class="text-small text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-md-auto mt-auto ml-auto">
              <button type="reset" class="btn btn-danger" name="btn_reset"><i class="fa fa-eraser"
                  aria-hidden="true"></i> Reset</button>
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
<?php endforeach ?>


<!-- Modal View -->
<?php foreach ($npwrd as $np): ?>
<div class="modal fade" id="view<?= $np->id_npwrd ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"> </i> <b>DETAIL DATA NPWRD</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th style="width: 150px;">Nama Objek</th>
              <td><b><?= $np->nama_objek ?></b></td>
            </tr>
            <tr>
              <th style="width: 150px;">Jenis Objek</th>
              <td><?= $np->jenis_objek ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Wilayah</th>
              <td><?= $np->nama_wilayah ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Alamat</th>
              <td><?= $np->alamat ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">NPWRD</th>
              <td><?php echo substr($np->npwrd, 0, 2) . '.' . substr($np->npwrd, 2); ?></td>
            </tr>
            <tr>
              <th style="width: 150px;">Keterangan</th>
              <td><?= $np->keterangan ?></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<?php endforeach ?>