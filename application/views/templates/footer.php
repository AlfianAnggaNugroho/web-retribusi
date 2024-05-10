<footer class="main-footer">

  <!-- Toast Tambah -->
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div id="tambah" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="width: 300px; height: 120px; background:black; color:white;">
        <div class="toast-header" style="background:black; color:white">
          <img src="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png" class="rounded mr-2">
          <strong class="mr-auto">Pemberitahuan!</strong>
          <small style="color:teal">Tambah Data</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body" style="text-align: left;">
          <div style="display: flex; align-items: center;">
            <i class="fas fa-check-circle fa-3x moving-icon"
              style="color: teal; margin-right: 8px; vertical-align: middle;"></i>
            <div>
              Data sudah berhasil <strong>ditambah!!!</strong>.
              <div style="font-size: 11px;"> Sistem informasi retribusi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Edit -->
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0px;">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div id="edit" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="width: 300px; height: 120px; background:black; color:white;">
        <div class="toast-header" style="background:black; color:white">
          <img src="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png" class="rounded mr-2">
          <strong class="mr-auto">Pemberitahuan!</strong>
          <small style="color:orange">Edit</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body" style="text-align: left;">
          <div style="display: flex; align-items: center;">
            <i class="fas fa-check-circle fa-3x moving-icon"
              style="color: orange; margin-right: 8px; vertical-align: middle;"></i>
            <div>
              Data sudah berhasil di <strong>edit!!!</strong>.
              <div style="font-size: 11px;"> Sistem informasi retribusi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Delete -->
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div id="delete" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="width: 300px; height: 120px; background:black; color:white;">
        <div class="toast-header" style="background:black; color:white">
          <img src="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png" class="rounded mr-2">
          <strong class="mr-auto">Pemberitahuan!</strong>
          <small style="color:red">Delete</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body" style="text-align: left;">
          <div style="display: flex; align-items: center;">
            <i class="fas fa-check-circle fa-3x moving-icon"
              style="color: red; margin-right: 8px; vertical-align: middle;"></i>
            <div>
              Data sudah berhasil <strong>dihapus!!!</strong>.
              <div style="font-size: 11px;"> Sistem informasi retribusi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Eror -->
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div id="eror" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="width: 300px; height: 120px; background:black; color:white;">
        <div class="toast-header" style="background:black; color:white">
          <img src="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png" class="rounded mr-2">
          <strong class="mr-auto">Pemberitahuan!</strong>
          <small style="color:red">Eror</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body" style="text-align: left;">
          <div style="display: flex; align-items: center;">
            <i class="fas fa-times-circle fa-3x moving-icon"
              style="color: red; margin-right: 8px; vertical-align: middle;"></i>
            <div>
              Terjadi eror ketika memasukan data!!!.
              <div style="font-size: 11px;"> Sistem informasi retribusi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Bayar -->
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div id="bayar" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
        style="width: 300px; height: 120px; background:black; color:white;">
        <div class="toast-header" style="background:black; color:white">
          <img src="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png" class="rounded mr-2">
          <strong class="mr-auto">Pemberitahuan!</strong>
          <small style="color:green">Bayar</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body" style="text-align: left;">
          <div style="display: flex; align-items: center;">
            <i class="fas fa-check-circle fa-3x moving-icon"
              style="color: green; margin-right: 8px; vertical-align: middle;"></i>
            <div>
              Berhasil melakukan <strong>pembayaran!!!</strong>.
              <div style="font-size: 11px;"> Sistem informasi retribusi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.2
  </div>
  <strong>Copyright &copy; 2023 <a href="https://www.instagram.com/alvnangga/" target="_blank">UTI Alfian Angga
      Nugroho</a>.</strong>
  All rights
  reserved.
</footer>

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
</div>
</body>

<!-- jQuery -->
<script src="<?= base_url('assets/template') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars -->
<script src="<?= base_url('assets/template') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- jsGrid -->
<script src="<?= base_url('assets/template') ?>/plugins/jsgrid/demos/db.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/jsgrid/jsgrid.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/template') ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?= base_url('assets/template') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/template') ?>/dist/js/demo.js"></script>
<!-- page script -->


<!-- <script src="<?= base_url('assets/template') ?>/plugins/bootstrap/js/bootstrap.min.js"></script> -->

<!-- ChartJS -->
<script src="<?= base_url('assets/template') ?>/plugins/chart.js/Chart.min.js"></script>

<script>
$(function() {
  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});
</script>

<script>
// Membuat pesan flash data menghilang setelah 5 detik
$(document).ready(function() {
  setTimeout(function() {
    $('.alert').alert('close');
  }, 2000); // Waktu dalam milidetik (5000ms = 5 detik)
});
</script>

<!-- JavaScript -->
<script>
// Fungsi untuk mengubah angka menjadi format mata uang saat pengguna mengetik
function formatCurrencyInput(input) {
  // Mengambil nilai input tanpa tanda baca dan spasi
  var value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  // Menampilkan nilai yang sudah diformat pada input
  input.value = 'Rp ' + value;
}

// Fungsi untuk menghapus format mata uang sebelum submit
function removeCurrencyFormatAndSubmit(button) {
  // Mengambil elemen input terkait
  var input = document.getElementById(button.getAttribute('data-input-id'));
  // Menghapus semua karakter selain angka
  var value = input.value.replace(/[^\d]/g, '');
  // Set nilai asli pada elemen input
  input.value = value;

  // Sekarang, Anda dapat mengirimkan formulir atau data ke server
  // Misalnya:
  var form = button.closest('form');
  form.submit();
}
</script>


<!--Script Toast -->
<script>
$(document).ready(function() {
  var toastData = <?= json_encode($this->session->flashdata('toast')) ?>;
  if (toastData) {
    var toast = $('#' + toastData.type);
    toast.removeClass('hide');
    toast.toast('show');

    // Membuat pesan flash data menghilang setelah 2 detik (2000 milidetik)
    setTimeout(function() {
      $('.alert').alert('close');
    }, 2000);
  }
});
</script>

</html>