<div class="card">
   <div class="card-header">
        <a href="<?= base_url('wilayah/tambah')?>" class="btn btn-sm" style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
        <i class="fas fa-plus"></i> Tambah wilayah</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
        <thead style="background: linear-gradient(to right, #642EFE, #000066); color: white;">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Wilayah</th>
                <th>Action</th>
            </tr>
         </thead>
        
        <tbody>
            <?php $no = 1;
            foreach($wilayah as $wlh) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $wlh->nama_wilayah ?></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#edit<?= $wlh->id_wilayah ?>" class="btn btn-warning btn-sm" style="margin-right: 4px"><i class="fas fa-edit"></i></button>
                    <a href="<?= base_url('wilayah/delete/' . $wlh->id_wilayah) ?>" class="btn btn-danger btn-sm" style="margin-left: 4px" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</div>

<!-- Alert Modal -->

<!-- Modal Edit-->
<?php foreach($wilayah as $wlh) : ?>
<div class="modal fade" id="edit<?= $wlh->id_wilayah ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="background: linear-gradient(40deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <h5 class="modal-title">
          <i class="fas fa-edit"></i> Edit Wilayah
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('wilayah/edit/' . $wlh->id_wilayah) ?>" method="POST">
          <div class="form-group">
            <label for="nama_wilayah">Nama wilayah</label>
            <input value="<?= $wlh->nama_wilayah ?>" type="text" name="nama_wilayah" class="form-control" id="nama_wilayah" placeholder="Nama wilayah">
            <?= form_error('nama_wilayah', '<div class="text-small text-danger">', '</div>'); ?>
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

