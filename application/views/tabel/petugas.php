<div class="card">
  <div class="card-header">
    <a href="<?= base_url('petugas/tambah')?>" class="btn btn-sm"
      style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
      <i class="fas fa-plus"></i> Tambah Penagih</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover">
      <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <tr class="text-center">
          <th>No</th>
          <th>Nama Penagih</th>
          <th>No.Telepon</th>
          <th>Alamat</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php $no = 1;
            foreach($petugas as $pgs) : ?>
        <tr>
          <td class="text-center"><?= $no++ ?></td>
          <td><?= $pgs->nama_petugas ?></td>
          <td><?= $pgs->no_telp ?></td>
          <td><?= $pgs->alamat ?></td>
          <td class="text-center">
            <button data-toggle="modal" data-target="#edit<?= $pgs->id_petugas ?>" class="btn btn-warning btn-sm"
              style="margin-right: 4px"><i class="fas fa-edit"></i></button>
            <a href="<?= base_url('petugas/delete/' . $pgs->id_petugas) ?>" class="btn btn-danger btn-sm"
              style="margin-left: 4px" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i
                class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Alert Modal -->

<?php foreach($petugas as $pgs) : ?>
<div class="modal fade" id="edit<?= $pgs->id_petugas ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"
        style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-edit"></i> Edit Data Petugas Penagih
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('petugas/edit/' . $pgs->id_petugas) ?>" method="POST">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nama_petugas">Nama Penagih</label>
              <input value="<?= $pgs->nama_petugas ?>" type="text" name="nama_petugas" class="form-control"
                placeholder="Nama Penagih">
              <?= form_error('nama_petugas', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="no_telp">Nomor Telepon</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">+62</span>
                </div>
                <input value="<?= $pgs->no_telp ?>" type="number" name="no_telp" class="form-control" id="no_telp"
                  placeholder="Nomor Telepon">
              </div>
              <?= form_error('no_telp', '<div class="text-small text-danger">', '</div>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea type="text" name="alamat" style="width:100%;" class="form-control" id="alamat"
              placeholder="Alamat"><?= $pgs->alamat ?></textarea>
            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="form-group ">
            <button type="reset" class="btn btn-danger" name="btn_reset" style="width:95px;"><i class="fa fa-eraser"
                aria-hidden="true"></i> Reset</button>
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