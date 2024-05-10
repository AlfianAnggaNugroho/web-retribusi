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
        <div class="fas fa-users" style="margin-right:10px"></div>
        <strong>Form Tambah Users</strong>
      </h3>
    </div>
    <div class="card-body">
      <form action="<?= base_url('user/tambah_aksi') ?>" method="POST">
        <div class="row">
          <div class="form-group col-md-12">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" maxlength="15">
            <?= form_error('username', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="us_level">Role Account</label>
            <select id="us_level" class="form-control custom-dropdown" name="us_level" required>
              <option value="" selected disabled>-- Select --</option>
              <option value="Admin">Admin</option>
              <option value="Petugas">Petugas</option>
              <option value="Pimpinan">Pimpinan</option>
            </select>
            <?= form_error('us_level', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <?= form_error('password', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
        </div>
        <?php if(isset($token_generate)){ ?>
        <input type="hidden" name="token" class="form-control" value="<?= $token_generate?>">
        <?php }else {
        redirect(base_url('form/tambah'));
        }?>

    </div>
    <div class="card-footer">
      <div class=" form-group text-center d-flex justify-content-between">
        <a style="color: black" type="button" class="btn btn-warning col-md-3" onclick="history.back(-1)"
          name="btn_kembali">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
        </a>
        <a type="button" class="btn btn-info col-md-4 mx-4" href="<?=base_url('user')?>" name="btn_listsatuan">
          <i class="fa fa-table" aria-hidden="true"></i> Lihat Data Users
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
      <p class="card-text">Tambahkan <strong>Users</strong> menggunakan form yang sudah disediakan. Jika form
        sudah di isi
        berdasarkan data yang ingin ditambahkan selanjutnya tekan tombol
        <b>Submit</b>
      </p>
    </div>
  </div>
</div>