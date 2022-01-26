<div class="card-body">
    <form action="<?= base_url('pkl/penilaian/') . $siswa_id ?>" method="post">

        <div class="form-group">
            <label for="nilai">Nilai Siswa</label>
            <input type="number" id="nilai" name="nilai" placeholder="0" class="form-control<?= form_error('nilai') ? ' is-invalid' : '' ?>">
            <?= form_error('nilai') ? '<span class="invalid-feedback">' . form_error('nilai') . '</span>' : '' ?>
        </div>
        <button class="btn btn-primary float-right">Kirim</button>
    </form>

</div>
<!-- /.card-body -->