<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/png" sizes="16x16"
    href="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

  * {
    margin: 0;
    padding: 0;
    font-family: 'poppins', sans-serif;
  }

  section {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100%;

    background: url('<?= base_url('assets/template')?>/dist/img/background1.jpg') no-repeat;
    background-position: center;
    background-size: cover;
  }

  .form-box {
    position: relative;
    width: 400px;
    height: 450px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;

  }

  .form-value {
    position: relative;
  }

  h2 {
    font-size: 2em;
    color: #fff;
    text-align: center;
    position: relative;
    z-index: 1;
  }

  .inputbox {
    position: relative;
    margin: 30px 0;
    width: 310px;
    border-bottom: 2px solid #fff;
  }

  .inputbox label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
  }

  input:focus~label,
  input:valid~label {
    top: -5px;
  }

  .inputbox input {
    width: 75%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding: 0 35px 0 5px;
    color: #fff;
  }

  .inputbox ion-icon {
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2em;
    top: 20px;
  }

  .forget {
    margin: -15px 0 15px;
    font-size: .9em;
    color: #fff;
    display: flex;
    justify-content: space-between;
  }

  .forget label input {
    margin-right: 3px;

  }

  .forget label a {
    color: #fff;
    text-decoration: none;
  }

  .forget label a:hover {
    text-decoration: underline;
  }

  button {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight: 600;
  }

  .register {
    font-size: .9em;
    color: #fff;
    text-align: center;
    margin: 25px 0 10px;
  }

  .register p a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
  }

  .register p a:hover {
    text-decoration: underline;
  }

  .flash-data {
    position: relative;
    font-size: 8pt;
    z-index: 9999;
    padding: 10px;
    align-items: center;

    background: transparent;
    border-radius: 15px;
    backdrop-filter: blur(15px);

  }

  .flash-warning {
    color: #fff;
  }

  input:-webkit-autofill,
  input:-webkit-autofill:hover,
  input:-webkit-autofill:focus {
    -webkit-text-fill-color: #fff;
    /* Mengubah warna teks menjadi putih */
    transition: background-color 5000s ease-in-out 0s;
    /* Menambahkan efek transisi agar perubahan latar belakang tidak terjadi secara instan */
  }

  /* Gaya untuk teks petunjuk */
  input::-webkit-input-placeholder {
    color: #fff;
    /* Mengubah warna teks petunjuk menjadi putih */
  }

  .logo-container {
    text-align: center;
  }

  .logo {
    max-width: 75px;
    /* Sesuaikan ukuran logo sesuai kebutuhan */
    margin-bottom: 10px;
    margin-top: -100px;
    /* Jarak antara logo dan teks "Login" */
  }
  </style>


</head>

<body>
  <section>
    <div class="form-box">
      <div class="form-value">
        <?php if ($this->session->flashdata('msg')) { ?>
        <div class="flash-data flash-warning">
          <strong>Warning!</strong><br> <?= $this->session->flashdata('msg'); ?>
        </div>
        <?php } ?>
        <form action="<?= base_url('login/proses_login') ?>" method="post">
          <!-- Tambahkan tag <div> untuk logo dan teks "Login" -->
          <div class="logo-container">
            <img src="<?= base_url('assets/template')?>/dist/img/dlh.png" alt="Logo" class="logo">
            <h2>Login</h2>
          </div>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input name="username" type="text" class="form-control" placeholder="username" required>
            <label for="">Username</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            <label for="">Password</label>
          </div>
          <div class="forget">

          </div>
          <?php if(isset($token_generate)){ ?>
          <input type="hidden" name="token" value="<?php echo $token_generate ?>">
          <?php }else {
                        redirect(base_url());
                      }?>
          <button type="submit" name="login">Sign In</button>
          <div class="register">
            <p>SI-Retribusi <a href="#">Dinas Lingkungan Hidup</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>


</html>