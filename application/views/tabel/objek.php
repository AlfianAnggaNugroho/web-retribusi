<div class="card">
   <div class="card-header">
        <a href="<?= base_url('objek/tambah')?>" class="btn btn-sm" style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <i class="fas fa-plus"></i> Tambah Objek</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
        <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
            <tr class="text-center">
                <th>No</th>
                <th>Jenis Objek</th>
                <th>Action</th>
            </tr>
         </thead>
            
        <tbody>
            <?php $no = 1;
            foreach($objek as $obk) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $obk->nama_objek ?></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#edit<?= $obk->id_objek ?>" class="btn btn-warning btn-sm" style="margin-right: 4px"><i class="fas fa-edit"></i></button>
                    <a href="<?= base_url('objek/delete/' . $obk->id_objek) ?>" class="btn btn-danger btn-sm" style="margin-left: 4px" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</div>

<!-- Alert Modal -->

<!-- Modal Edit-->
<?php foreach($objek as $obk) : ?>
<div class="modal fade" id="edit<?= $obk->id_objek ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title">
          <i class="fas fa-edit"></i> Edit Jenis Objek
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('objek/edit/' . $obk->id_objek) ?>" method="POST">
          <div class="form-group">
            <label for="nama_objek">Jenis objek</label>
            <input value="<?= $obk->nama_objek ?>" type="text" name="nama_objek" class="form-control" id="nama_objek" placeholder="Nama objek">
            <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            <button style="background: linear-gradient(to right, #642EFE, #000066); color: white;" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 
<?php endforeach ?>


