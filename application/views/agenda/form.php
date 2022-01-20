<div class="card-body">
    <?php
    $kegiatan = '';
    $tanggal_kegiatan = '';
    $nilai_budaya = '';
    $pilih_siswa = '';
    if ($edit_agenda) {
        $kegiatan = $edit_agenda['kegiatan'];
        $tanggal_kegiatan = $edit_agenda['tanggal_kegiatan'];
        $pilih_siswa = $edit_agenda['nama_siswa'];
        $nilai_budaya  = $edit_agenda['nilai_budaya_industri'];
    }
    ?>
    <form action="<?= base_url('agenda/') . $type == 'add' ?? 'edit/' . $type ?>" method="post">
        <div class="form-group">
            <label for="jumlah_siswa">Pilih Siswa</label>
            <?php if ($type == 'add') : ?>
                <select class="custom-select<?= form_error('siswa') ? '  is-invalid' : '' ?>" name="siswa" aria-label="Default select example">
                    <option selected disabled>-- Pilih Siswa --</option>
                    <?php foreach ($siswa as $row) : ?>
                        <option value="<?= $row['siswa_id'] ?>"><?= $row['nama_siswa'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else : ?>
                <input class="form-control" disabled value="<?= $pilih_siswa ?>">
            <?php endif; ?>
            <div class="invalid-feedback"><?= form_error('siswa') ?></div>
        </div>
        <div class="form-group">
            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
            <input type="text" name="tanggal_kegiatan" class="form-control <?= form_error('tanggal_kegiatan') ? '  is-invalid' : '' ?>" id="datepicker" value="<?= set_value('tanggal_kegiatan') ? set_value('tanggal_kegiatan') : $tanggal_kegiatan ?>">
            <div class="invalid-feedback"><?= form_error('tanggal_kegiatan') ?></div>
        </div>
        <div class="form-group">
            <label for="kegiatan">Kegiatan</label>
            <?php $data = [
                'name'      => 'kegiatan',
                'value'     => set_value('kegiatan') ? set_value('kegiatan') : $kegiatan,
                'rows'      => '4',
                'class'     => form_error('kegiatan') ? 'form-control is-invalid' : 'form-control',
            ];
            echo form_textarea($data); ?>
            <div class="invalid-feedback"><?= form_error('kegiatan') ?></div>
        </div>
        <div class="form-group">
            <label for="nilai_budaya">Nilai Budaya Industri</label>
            <?php $data = [
                'name'      => 'nilai_budaya',
                'value'     => set_value('nilai_budaya') ? set_value('nilai_budaya') : $nilai_budaya,
                'rows'      => '4',
                'class'     => form_error('nilai_budaya') ? 'form-control is-invalid' : 'form-control',
            ];
            echo form_textarea($data); ?>
            <div class="invalid-feedback"><?= form_error('nilai_budaya') ?></div>
        </div>
        <input type="text" name="type" value="<?= $type ?>" hidden />
        <button class="btn btn-primary float-right">Simpan</button>
    </form>

</div>
<!-- /.card-body -->