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
  /* Lebar card */
  margin-bottom: 20px;
  /* Jarak antara card */
}

.custom-card2 {
  width: 100%;
  /* Lebar card */
}

@media (min-width: 768px) {
  .custom-card {
    width: 50%;
    /* Lebar card pada layar lebih besar */
  }

  .custom-card2 {
    width: 45%;
    /* Lebar card pada layar lebih besar */
  }
}
</style>


<div class="card-container">
  <div class="card custom-card"
    style="background: linear-gradient(300deg, #3366FF 5%, #642EFE 30%, #000066 100%); color: white;">
    <div class="card-header">
      <h3 class="card-title">
        <div class="fas fa-plus" style="margin-right:10px"></div>
        <strong>Form Tambah Data Petugas Penagih</strong>
      </h3>
    </div>
    <div class="card-body">
      <form action="<?= base_url('petugas/tambah_aksi') ?>" method="POST">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="nama_petugas">Nama Penagih</label>
            <input type="text" name="nama_petugas" class="form-control" id="nama_kategori" placeholder="Nama Penagih">
            <?= form_error('nama_petugas', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="no_telp">Nomor Telepon</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">+62</span>
              </div>
              <input type="number" name="no_telp" class="form-control" id="nama_kategori" placeholder="Nomor Telepon">
            </div>
            <?= form_error('no_telp', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea type="text" name="alamat" style="width:100%;" class="form-control" id="nama_kategori"
            placeholder="Alamat"></textarea>
          <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group ">
          <button type="reset" class="btn btn-danger" name="btn_reset" style="width:95px;"><i class="fa fa-eraser"
              aria-hidden="true"></i> Reset</button>
        </div>

    </div>
    <div class="card-footer">
      <div class=" form-group text-center d-flex justify-content-between">
        <a style="color: black" type="button" class="btn btn-warning col-md-3" onclick="history.back(-1)"
          name="btn_kembali">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
        </a>
        <a type="button" class="btn btn-info col-md-4 mx-4" href="<?=base_url('petugas')?>" name="btn_listsatuan">
          <i class="fa fa-table" aria-hidden="true"></i> Lihat Data Penagih
        </a>
        <button
          style="background: linear-gradient(40deg, #642EFE, #3366FF, #000066); color: white; border-color: white;"
          type="submit" class="btn btn-primary col-md-3"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
      </div>
    </div>
  </div>
  </form>
  <div class="card custom-card2">
    <img src="<?= base_url('assets/template')?>/dist/img/task.png" class="card-img-top" style="height:310px">
    <div class="card-body">
      <p class="card-text">Tambahkan data <strong>Penagih</strong> menggunakan form yang sudah disediakan. Jika form
        sudah di isi
        berdasarkan data yang ingin ditambahkan selanjutnya tekan tombol
        <b>Submit</b>
      </p>
    </div>
  </div>
</div>