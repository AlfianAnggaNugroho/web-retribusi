<style>
    /* CSS untuk mengatur container */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    /* CSS untuk mengatur card */
    .custom-card {
        width: 60%; /* Lebar card */
        margin-bottom: 20px; /* Jarak antara card */
    }

    .custom-card2 {
        width: 35%; /* Lebar card */
    }
</style>

<div class="card-container">
<div class="card custom-card2">
<form style="margin:10px" action="<?= base_url('retribusi/tambah_aksi') ?>" method="POST">
    <div class="card-body" style="background: linear-gradient(to bottom, #642EFE, #000066); color: white;">
        <label for="nama_objek" style="height: 30px;">Nama Objek</label>
        <div class="input-group input-group-sm">
            <input name="nama_objek" style="margin-bottom:-3px; height: 30px;" type="search" id="nama_objek" class="form-control" placeholder="Cari Nama Objek" aria-label="Search">
            <?= form_error('nama_objek', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
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
        <select multiple id="nama_objek_select" class="form-control" name="nama_objek_select" style="height: 300px;"> <!-- Ubah tinggi sesuai kebutuhan Anda -->
            <?php foreach ($tb_npwrd as $obk) : ?>
                <option value="<?php echo $obk->nama_objek; ?>" data-npwrd="<?php echo substr($obk->npwrd, 0, 2) . '.' . substr($obk->npwrd, 2); ?>" data-wilayah="<?php echo $obk->nama_wilayah; ?>" data-alamat="<?php echo $obk->alamat; ?>"><?php echo $nomor_urut . '. ' . $obk->nama_objek; ?></option>
                <?php
                // Tambahkan 1 pada nomor urut setiap kali iterasi
                $nomor_urut++;
                ?>
            <?php endforeach; ?>
        </select>
    </div>
</div>

    
    <div class="card custom-card">
    <div class="card-header" style="background: #642EFE; color: white">
        <h3 class="card-title"><div class="fas fa-plus" style="margin-right:10px"></div>Form Tambah</h3>
    </div>
    <div class="card-body">
        
        <div class="row" style="margin: 1px">
        <div class="form-group col-md-3">
            <label for="nama_petugas">Petugas</label>
            <select id="nama_petugas" class="form-control" name="nama_petugas">
                <option value="" selected="">-- Select --</option>
                <?php foreach ($tb_petugas as $ptgs) : ?>
                    <option value="<?php echo $ptgs->nama_petugas; ?>"><?php echo $ptgs->nama_petugas; ?></option>
                <?php endforeach; ?>
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
            <label for="nilai_retribusi">Nilai Retribusi</label>
            <input type="number" name="nilai_retribusi" class="form-control" id="nilai_retribusi" placeholder="Rp.">
            <?= form_error('nilai_retribusi', '<div class="text-small text-danger">', '</div>'); ?>
        </div>

        <div class="form-group col-md-5">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal">
            <?= form_error('tanggal', '<div class="text-small text-danger">', '</div>'); ?>
        </div>

        <div class="form-group col-md-4">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Opsional">
            <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>

        <div class="form-group col-md-2">
        <label style="color:white" for="keterangan">Reset</label>
            <button type="reset" class="btn btn-danger" name="btn_reset"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
        </div>
    </div>

    <div class="form-group" style="margin-top: 5%; display: flex; justify-content: space-between;">
        <a type="button" class="btn btn-warning" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
        <a type="button" class="btn btn-info" href="<?= base_url('retribusi') ?>" name="btn_retribusi"><i class="fa fa-table" aria-hidden="true"></i> Lihat Data Retribusi</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
    </div>

            </div>
            <script>
                // Menangkap elemen-elemen yang diperlukan
                var namaObjekSelect = document.getElementById("nama_objek_select");
                var npwrdInput = document.getElementById("npwrd");
                var wilayahInput = document.getElementById("nama_wilayah");
                var alamatInput = document.getElementById("alamat");
                var searchInput = document.getElementById("nama_objek");

                // Menambahkan event listener untuk perubahan pada dropdown nama_objek
                namaObjekSelect.addEventListener("change", function () {
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

                // Fungsi untuk melakukan pencarian
                searchInput.addEventListener("input", function () {
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
        </form>
    </div>
</div>
