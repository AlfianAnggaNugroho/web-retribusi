<style>
/* CSS untuk mengatur container */
.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

/* CSS untuk mengatur card */
.custom-card {
  width: 100%;
  /* Lebar card pada layar kecil */
  margin-bottom: 20px;
  /* Jarak antara card */
}

.custom-card2 {
  width: 100%;
  /* Lebar card pada layar kecil */
}

@media (min-width: 768px) {

  /* Mengatur lebar card ketika lebar layar lebih besar dari 768px */
  .custom-card {
    width: 60%;
    /* Lebar card pada layar yang lebih besar */
  }

  .custom-card2 {
    width: 35%;
    /* Lebar card pada layar yang lebih besar */
  }
}
</style>


<div class="card-container">
  <div class="card custom-card"
    style="background: linear-gradient(300deg, #3366FF 5%, #642EFE 30%, #000066 100%); color: white;">
    <div class="card-header">
      <h3 class="card-title">
        <div class="fas fa-plus" style="margin-right:10px"></div>Form Tambah
      </h3>
    </div>
    <div class="card-body">
      <form action="<?= base_url('npwrd/tambah_aksi') ?>" method="POST">
        <div class="form-row">
          <!-- Kolom 1 -->
          <div class="col-md-5 mb-3">
            <label for="jenis_objek">Jenis Objek</label>
            <select id="jenis_objek" class="form-control" name="jenis_objek">
              <option value="" selected="">-- Select --</option>
              <?php foreach ($tb_objek as $obk) : ?>
              <option value="<?php echo $obk->nama_objek; ?>" <?= set_select('jenis_objek', $obk->nama_objek); ?>>
                <?php echo $obk->nama_objek; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('jenis_objek', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="col-md-7 ml-auto">
            <label for="nama_objek">Nama Objek</label>
            <input value="<?= set_value('nama_objek'); ?>" type="text" name="nama_objek" class="form-control"
              id="nama_objek" placeholder="Nama Objek">
            <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="col-md-5 mb-3">
            <label for="nama_wilayah">Wilayah</label>
            <select id="nama_wilayah" class="form-control" name="nama_wilayah">
              <option value="" selected="">-- Select --</option>
              <?php foreach ($tb_wilayah as $wlh) : ?>
              <option value="<?php echo $wlh->nama_wilayah; ?>" <?= set_select('nama_wilayah', $wlh->nama_wilayah); ?>>
                <?php echo $wlh->nama_wilayah; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('nama_wilayah', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <!-- Kolom 2 -->
          <div class="col-md-7 ml-auto">
            <label for="alamat">Alamat</label>
            <input value="<?= set_value('alamat'); ?>" type="text" name="alamat" class="form-control" id="alamat"
              placeholder="Jl.">
            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="col-md-5">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Opsional">
          </div>
          <div class="col-md-3">
            <label for="npwrd">NPWRD</label>
            <input value="<?= set_value('npwrd'); ?>" type="number" name="npwrd" class="form-control" id="npwrd"
              placeholder="00000">
            <?= form_error('npwrd', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="col-md-2 ml-auto">
            <label for="keterangan" style="color:transparent">Reset</label>
            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-eraser" aria-hidden="true"></i>
              Reset</button>
          </div>
        </div>

        <div class="form-group row"
          style="margin-top: 5%; border-top: 1px solid rgba(0, 0, 0, 0.2); text-align: center;">
          <div class="col-md-auto">
            <a style="color:black; margin-top: 30px;" type="button" class="btn btn-warning btn-block"
              onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>
              Kembali</a>
          </div>
          <div class="col-md-4 ml-auto">
            <a style="margin-top: 30px;" type="button" class="btn btn-info btn-block" href="<?=base_url('npwrd')?>"
              name="btn_npwrd"><i class="fa fa-table" aria-hidden="true"></i> Lihat Data NPWRD</a>
          </div>
          <div style="margin-top: 30px;" class="col-md-2 ml-auto">
            <button
              style="background: linear-gradient(40deg, #642EFE, #3366FF, #000066); color: white; border-color: white;"
              type="submit" class="btn btn-primary btn-block"><i class="fa fa-save" aria-hidden="true"></i>
              Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card custom-card2">
    <img src="<?= base_url('assets/template')?>/dist/img/task.png" class="card-img-top" style="height:310px">
    <div class="card-body">
      <p class="card-text">Tambahkan data <strong>NPWRD</strong> menggunakan form yang sudah disediakan. Jika form sudah
        di isi berdasarkan data yang ingin ditambahkan selanjutnya tekan tombol
        <b>Submit</b>
      </p>
    </div>
  </div>
</div>