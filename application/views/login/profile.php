<?php
// Inisialisasi variabel
$username = "";
$lastLogin = "";
$userLevel = "";

// Periksa apakah session 'username' dan 'last_login' tersedia
if ($this->session->userdata('username') && $this->session->userdata('last_login')) {
  $username = $this->session->userdata('username');
  $lastLogin = $this->session->userdata('last_login');
  $userLevel = $this->session->userdata('us_level');
} else {
  echo "Pengguna belum login.";
}
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline" id="mxheight">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                src="<?= base_url('assets/template')?>/dist/img/dlh.png" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center"><b><?= $username; ?></b></h3>
            <p class="text-muted text-center"><?= $userLevel; ?></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Username</b> <a class="float-right"><?= $username; ?></a>
              </li>
              <li class="list-group-item">
                <b>Role Account</b> <a class="float-right"><?= $userLevel; ?></a>
              </li>
              <li class="list-group-item">
                <b>Last Login</b> <a class="float-right"><?= $lastLogin ?> <i style="font-size: 10px"
                    class="fa fa-circle text-success"></i></a>
              </li>
            </ul>
            <a href="#settings" data-toggle="tab">
              <button
                style="background: linear-gradient(40deg, #642EFE, #3366FF, #000066); color: white; border-color: white;"
                class="btn btn-primary col-md-12"><i class="fa fa-edit" aria-hidden="true"></i>Edit Profile</button></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card" id="cardWithMaxHeight">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div><!-- /.card-header -->
          <?php foreach ($user as $us) : ?>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="<?= base_url('profile/edit/' . $us->id_user) ?>" method="POST">
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="username" value="<?= $username; ?>"
                        maxlength="15">
                      <?= form_error('username', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password" id="password" placeholder="">
                      <?= form_error('password', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        placeholder="">
                      <?= form_error('confirm_password', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <?php if (isset($token_generate)) : ?>
                  <input type="hidden" name="token" class="form-control" value="<?= $token_generate ?>">
                  <?php else :
                      redirect(base_url('profile/edit'));
                    endif; ?>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
          <?php endforeach ?>
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
// Mengambil tinggi dari elemen dengan ID "mxheight"
var maxHeightElement = document.getElementById("mxheight");
var maxHeight = maxHeightElement.clientHeight;

// Mengatur max-height dari kartu dengan ID "cardWithMaxHeight"
var cardWithMaxHeight = document.getElementById("cardWithMaxHeight");
cardWithMaxHeight.style.maxHeight = maxHeight + "px";
</script>