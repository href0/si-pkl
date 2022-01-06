<div class="card-body">
    <form action="<?= base_url('pkl/add') ?>" method="post">
        <div class="form-group">
            <label for="jumlah_siswa">Jumlah Siswa</label>
            <input type="number" id="jumlah_siswa" name="jumlah_siswa" class="form-control" autofocus>
        </div>
        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk PKL</label>
            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control">
        </div>
        <button class="btn btn-primary float-right">Kirim</button>
    </form>

</div>
<!-- /.card-body -->