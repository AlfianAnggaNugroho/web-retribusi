<style>
.custom-dropdown {
  max-height: 150px;
  /* Batas item yang ditampilkan */
  overflow-y: auto;
}
</style>

<div class="card">
  <div class="card-header">
    <a href="<?= base_url('user/tambah')?>" class="btn btn-sm"
      style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
      <i class="fas fa-plus"></i> <strong>Tambah User</strong>s</a>
  </div>


  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover text-nowrap">
      <thead style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <tr class="text-center">
          <th>No</th>
          <th>Username</th>
          <th>Level Account</th>
          <th>Last Login</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $no = 1;
            foreach($user as $us) : ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= $us->username ?></td>
          <td><?= $us->us_level ?></td>
          <td><?= $us->last_login ?></td>
          <td class="text-center">
            <button data-toggle="modal" data-target="#edit<?= $us->id_user ?>" class="btn btn-warning btn-sm"
              style="margin-right: 4px"><i class="fas fa-edit"></i></button>
            <a href="<?= base_url('user/delete/' . $us->id_user) ?>" class="btn btn-danger btn-sm"
              style="margin-left: 4px"><i class="fas fa-trash"
                onclick="return confirm('Apakah anda yakin ingin menghapus data?')"></i></a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>

    </table>
  </div>
</div>

<!-- Alert Modal -->

<!-- Modal Edit-->
<?php foreach($user as $us) : ?>
<div class="modal fade" id="edit<?= $us->id_user ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"
        style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-users"></i> Edit Data Users
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('user/edit/' . $us->id_user) ?>" method="POST">
          <div class="row">
            <div class="form-group col-md-12">
              <label for="username">Username</label>
              <input value="<?= $us->username ?>" type="text" name="username" class="form-control" id="username"
                placeholder="" maxlength="15">
              <?= form_error('username', '<div class="text-small text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-md-6">
              <label for="us_level">Role Account</label>
              <select id="us_level" class="form-control custom-dropdown" name="us_level" required>
                <option value="" selected disabled>-- Select --</option>
                <option value="Admin" <?= $us->us_level === 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="Petugas" <?= $us->us_level === 'Petugas' ? 'selected' : '' ?>>Petugas</option>
                <option value="Pimpinan" <?= $us->us_level === 'Pimpinan' ? 'selected' : '' ?>>Pimpinan</option>
              </select>
              <?= form_error('us_level', '<div class="text-small text-danger">', '</div>'); ?>
            </div>


            <div class="form-group col-md-6">
              <label for="password">New Password</label>
              <input value="" type="password" name="password" class="form-control" id="password" placeholder="password">
              <?= form_error('password', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
          </div>
          <?php if(isset($token_generate)){ ?>
          <input type="hidden" name="token" class="form-control" value="<?= $token_generate?>">
          <?php }else {
                redirect(base_url('user/edit'));
              }?>
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