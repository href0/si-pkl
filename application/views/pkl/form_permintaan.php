<div class="card-body">
    <form action="<?= base_url('pkl/add') ?>" method="post">
        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']) ?>
        <div class="form-group">
            <label for="jumlah_siswa">Jumlah Siswa</label>
            <input type="number" id="jumlah_siswa" name="jumlah_siswa" class="form-control<?= form_error('jumlah_siswa') ? ' is-invalid' : '' ?>" autofocus>
            <?= form_error('jumlah_siswa') ? '<span class="invalid-feedback">' . form_error('jumlah_siswa') . '</span>' : '' ?>
        </div>
        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk PKL</label>
            <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="form-control<?= form_error('tanggal_masuk') ? ' is-invalid' : '' ?>">
            <?= form_error('tanggal_masuk') ? '<span class="invalid-feedback">' . form_error('tanggal_masuk') . '</span>' : '' ?>

        </div>
        <button class="btn btn-primary float-right">Kirim</button>
    </form>

</div>
<!-- /.card-body -->

<script>
    $(document).ready(function() {
        $(function() {
            let currentDate = new Date();
            console.log(currentDate)
            $("#tanggal_masuk").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: "2022-01-15",
                maxDate: "2022-03-15",
            });
            $('#tanggal_masuk').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });
    });
</script>