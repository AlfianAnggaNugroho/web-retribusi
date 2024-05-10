<style>
/* CSS untuk mengatur container */
.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

/* CSS untuk mengatur card */
.custom-card {
  width: calc(65% - 10px);
  /* Lebar card, dengan padding 10px antar card */
  margin-bottom: 20px;
  /* Jarak antara card */
}

.custom-card2 {
  width: calc(35% - 10px);
  /* Lebar card, dengan padding 10px antar card */
}

/* Gaya untuk elemen form status */
.status-label {
  font-weight: bold;
  font-size: 18px;
  /* Sesuaikan dengan ukuran yang Anda inginkan */
  color: white;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.ic-label {
  color: #ffc107;
}

.objek-label {
  font-weight: bold;
  font-size: 18px;
  /* Sesuaikan dengan ukuran yang Anda inginkan */
  color: white;
}

/* Gaya untuk dropdown status */
.status-dropdown {
  font-weight: bold;
  font-size: 18px;
  /* Sesuaikan dengan ukuran yang Anda inginkan */
  background-color: #ffc107;
  color: black;
}

/* Warna latar belakang untuk "Belum Bayar" */
.belum-bayar {
  color: red !important;
  font-weight: bold;
  font-size: 18px;
}

/* Warna latar belakang untuk "Sudah Bayar" */
.sudah-bayar {
  color: green !important;
  font-weight: bold;
  font-size: 18px;
}

/* CSS untuk mengatur tampilan dropdown */
.status-dropdown {
  font-weight: bold;
  font-size: 18px;
  border-radius: 5px;
  /* Tambahkan border-radius */
  width: 100%;
  /* Buat dropdown mengisi lebar container */
  margin-bottom: 10px;
  /* Tambahkan jarak antara elemen-elemen */
}

.status-dropdown option::before {
  content: "\2022";
  /* Unicode karakter untuk lingkaran bulat */
  margin-right: 5px;
  /* Jarak antara lingkaran dan teks */
}

/* Media query untuk layar berukuran lebih kecil */
@media (max-width: 768px) {
  .card-container {
    flex-direction: column;
    /* Mengubah tata letak menjadi tumpukan vertikal pada layar kecil */
  }

  .custom-card {
    width: 100%;
    /* Mengisi lebar layar penuh pada layar kecil */
  }

  .custom-card2 {
    width: 100%;
    /* Mengisi lebar layar penuh pada layar kecil */
  }
}
</style>

<!-- Pada form action, tambahkan 'tambah_data_retribusi' sebelum 'tambah_aksi' -->
<form style="margin:10px" action="<?= base_url('tambah_data_retribusi/tambah_aksi') ?>" method="POST">
  <div class="card-container">
    <div class="card custom-card2" style=" border-radius: 10px;">
      <div class="card-body"
        style="background: linear-gradient(120deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
        <label for="nama_objek" class="objek-label">Nama Objek <i class="fas fa-info-circle"
            data-toggle="tooltip"></i></label>
        <div class="input-group input-group-sm">
          <div class="input-group input-group-sm" style="position: relative;">
            <input name="nama_objek" style="margin-bottom: 10px; height: 30px; padding-left: 30px; border-radius:13px;"
              type="search" id="nama_objek" class="form-control" placeholder="Cari Nama Objek" aria-label="Search">
            <i class="fas fa-search" style="position: absolute; top: 8px; left: 10px; color: black;"></i>
          </div>
        </div>
        <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
        <?php
                $tb_npwrd_sorted = array();

                // Isi $tb_npwrd dari database atau sumber data lainnya
                
                // Menyusun ulang array $tb_npwrd berdasarkan nama objek
                usort($tb_npwrd, function ($a, $b) {
                    return strcmp($a->nama_objek, $b->nama_objek);
                });
                // Inisialisasi nomor urut
                $nomor_urut = 1;
                ?>
        <select multiple="multiple" id="nama_objek_select" class="form-control" name="nama_objek_select">
          <!-- Ubah tinggi sesuai kebutuhan Anda -->
          <?php foreach ($tb_npwrd as $obk): ?>
          <option style="font-weight: bold;" value="<?php echo $obk->nama_objek; ?>"
            data-npwrd="<?php echo substr($obk->npwrd, 0, 2) . '.' . substr($obk->npwrd, 2); ?>"
            data-wilayah="<?php echo $obk->nama_wilayah; ?>" data-alamat="<?php echo $obk->alamat; ?>">
            <?php echo $nomor_urut . '.  ' . $obk->nama_objek; ?>
          </option>
          <?php
                        // Tambahkan 1 pada nomor urut setiap kali iterasi
                        $nomor_urut++;
                        ?>
          <?php endforeach; ?>
        </select>

      </div>
    </div>


    <div class="card custom-card"
      style="background: linear-gradient(120deg, #000066 0%, #642EFE 70%, orange 100%); color: white;">
      <div class="card-header" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <h3 class="card-title">
          <div class="fas fa-plus" style="margin-right:10px"></div>Form Tambah
        </h3>
      </div>
      <div class="card-body">

        <div class="row" style="margin: 1px">
          <div class="form-group col-md-12">
            <label for="status" class="status-label">Status <i class="fas fa-question-circle ic-label"
                data-toggle="tooltip" title="Penting untuk memilih status terlebih dahulu!"></i>
              <?= form_error('status', '<div class="text-small text-danger">', '</div>'); ?></label>
            <select id="status" class="form-control status-dropdown" name="status">
              <option value="" selected="">-- Select --</option>
              <option value="Belum Bayar" class="belum-bayar"><strong>Belum Bayar</strong></option>
              <option value="Sudah Bayar" class="sudah-bayar"><strong>Sudah Bayar</strong></option>
            </select>
          </div>


          <div class="form-group col-md-4">
            <label for="nama_wilayah">Wilayah</label>
            <input type="text" name="nama_wilayah" class="form-control" id="nama_wilayah" placeholder="" readonly>
            <?= form_error('nama_wilayah', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="form-group col-md-5">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="" readonly>
            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="form-group col-md-3">
            <label for="npwrd">NPWRD</label>
            <input type="text" name="npwrd" class="form-control" id="npwrd" placeholder="" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="nama_petugas">Petugas Penagih</label>
            <select id="nama_petugas" class="form-control" name="nama_petugas">
              <option value="" selected="">-- Select --</option>
              <?php foreach ($tb_petugas as $ptgs): ?>
              <option value="<?php echo $ptgs->nama_petugas; ?>">
                <?php echo $ptgs->nama_petugas; ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group col-md-5">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal">
            <?= form_error('tanggal', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="form-group col-md-3" id="nilai_retribusi_group">
            <label for="nilai_retribusi">Nilai Retribusi</label>
            <input type="text" name="nilai_retribusi" class="form-control" id="nilai_retribusi" placeholder="Rp."
              oninput="formatCurrencyInput(this)" onblur="formatCurrencyInput(this)">
            <?= form_error('nilai_retribusi', '<div class="text-small text-danger">', '</div>'); ?>
          </div>

          <div class="form-group col-md-4" id="keterangan_group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Opsional">
            <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
          </div>


          <div class="form-group col-md-2">
            <label style="color:transparent" for="keterangan">Reset</label>
            <button type="reset" class="btn btn-danger" name="btn_reset"><i class="fa fa-eraser" aria-hidden="true"></i>
              Reset</button>
          </div>
        </div>
      </div>

      <div class="card-footer" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
        <div class="form-group form-button-container" style="display: flex; justify-content: space-between;">
          <a style="color:black" type="button" class="btn btn-warning" onclick="history.back(-1)" name="btn_kembali"><i
              class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
          <button onclick="removeCurrencyFormatAndSubmit(this)" data-input-id="nilai_retribusi" type="submit"
            name="btn_submit_simpan" value="Simpan & Cetak" id="simpan_cetak_group" class="btn btn-success btn-print"><i
              class="fa fa-print" aria-hidden="true"></i>
            Simpan & Cetak</button>
          <button onclick="removeCurrencyFormatAndSubmit(this)" data-input-id="nilai_retribusi" type="submit"
            class="btn btn-primary">
            <i class="fas fa-save"></i> Submit</button>
        </div>




      </div>
      <script>
      // Menangkap elemen-elemen yang diperlukan
      var namaObjekSelect = document.getElementById("nama_objek_select");
      var npwrdInput = document.getElementById("npwrd");
      var wilayahInput = document.getElementById("nama_wilayah");
      var alamatInput = document.getElementById("alamat");
      var searchInput = document.getElementById("nama_objek");
      var statusDropdown = document.getElementById("status");

      function setSelectHeight() {
        var selectedStatus = statusDropdown.value;
        var selectHeight;

        if (selectedStatus === "Sudah Bayar") {
          selectHeight = "380px";
        } else if (selectedStatus === "Belum Bayar") {
          selectHeight = "300px";
        } else {
          selectHeight = "380px"; // Jika tidak dipilih, tinggi tetap 380px
        }

        namaObjekSelect.style.height = selectHeight;
      }

      // Menambahkan event listener untuk perubahan pada dropdown nama_objek
      namaObjekSelect.addEventListener("change", function() {
        // Mendapatkan nilai npwrd yang sesuai dari atribut data
        var selectedOption = this.options[this.selectedIndex];
        var npwrd = selectedOption.getAttribute("data-npwrd");
        var nama_wilayah = selectedOption.getAttribute("data-wilayah");
        var alamat = selectedOption.getAttribute("data-alamat");

        // Mengisi nilai npwrd
        npwrdInput.value = npwrd;
        wilayahInput.value = nama_wilayah;
        alamatInput.value = alamat;

        // Mengisi otomatis kolom pencarian
        searchInput.value = selectedOption.value;
      });

      // Menangani perubahan pada dropdown Status
      var statusDropdown = document.getElementById("status");
      var nilaiRetribusiGroup = document.getElementById("nilai_retribusi_group");
      var keteranganGroup = document.getElementById("keterangan_group");
      var simpancetakGroup = document.getElementById("simpan_cetak_group");

      statusDropdown.addEventListener("change", function() {
        setSelectHeight(); // Atur tinggi nama_objek_select berdasarkan status
        var selectedStatus = this.value;

        // Jika Status "Belum Bayar" dipilih, sembunyikan form Nilai Retribusi dan Keterangan
        if (selectedStatus === "Belum Bayar") {
          nilaiRetribusiGroup.style.display = "none";
          keteranganGroup.style.display = "none";
          simpancetakGroup.style.display = "none";
        } else {
          // Jika Status "Sudah Bayar" dipilih, tampilkan kembali form Nilai Retribusi dan Keterangan
          nilaiRetribusiGroup.style.display = "block";
          keteranganGroup.style.display = "block";
          simpancetakGroup.style.display = "block";
        }

      });

      // Panggil setSelectHeight saat halaman dimuat untuk mengatur tinggi awal nama_objek_select
      window.addEventListener("load", setSelectHeight);

      // Panggil setSelectHeight saat perubahan status terjadi
      statusDropdown.addEventListener("change", setSelectHeight);

      // Fungsi untuk melakukan pencarian
      searchInput.addEventListener("input", function() {
        var input, filter, select, option, i;
        input = searchInput;
        filter = input.value.toUpperCase();
        select = namaObjekSelect;
        option = select.getElementsByTagName("option");

        for (i = 0; i < option.length; i++) {
          if (option[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            option[i].style.display = "";
          } else {
            option[i].style.display = "none";
          }
        }
      });
      </script>

      <script>
      // Mendapatkan elemen dropdown
      var statusDropdown = document.getElementById("status");

      // Menambahkan event listener untuk perubahan nilai pada dropdown
      statusDropdown.addEventListener("change", function() {
        var selectedValue = this.value;
        // Menghapus kelas latar belakang yang ada pada dropdown
        statusDropdown.classList.remove("belum-bayar", "sudah-bayar");

        // Menambahkan kelas latar belakang berdasarkan nilai yang dipilih
        if (selectedValue === "Belum Bayar") {
          statusDropdown.classList.add("belum-bayar");
        } else if (selectedValue === "Sudah Bayar") {
          statusDropdown.classList.add("sudah-bayar");
        }
      });
      </script>

      <!-- Fungsi untuk Button Cetak Struk -->


</form>
</div>
</div>