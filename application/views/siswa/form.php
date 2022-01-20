<div class="card-body">

    <?php
    $nama_pembimbing = '';
    $nama_siswa = '';
    $kelas = '';
    $email = '';
    $nohp = '';
    if ($edit_siswa) {
        $nama_pembimbing = $edit_siswa['nama_pembimbing'];
        $nama_siswa = $edit_siswa['nama_siswa'];
        $kelas = $edit_siswa['kelas_siswa'];
        $email  = $edit_siswa['email_siswa'];
        $nohp  = $edit_siswa['nohp_siswa'];
    }
    ?>

    <form action="<?= base_url('siswapkl/') . $type == 'add' ?? 'edit/' . $type ?>" method="post">

        <!-- Pilih Pembimbing -->
        <div class="form-group">
            <label for="pembimbing">Pilih Pembimbing</label>
            <?php if ($type == 'add') : ?>
                <select class="custom-select<?= form_error('pembimbing') ? '  is-invalid' : '' ?>" name="pembimbing" aria-label="Default select example">
                    <option selected disabled>-- Pilih Pembimbing --</option>
                    <?php foreach ($pembimbing as $row) : ?>
                        <option value="<?= $row['pembimbing_id'] ?>"><?= $row['nama_pembimbing'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else : ?>
                <input class="form-control" disabled value="<?= $nama_pembimbing ?>">
            <?php endif; ?>
            <div class="invalid-feedback"><?= form_error('pembimbing') ?></div>
        </div>

        <!-- NAMA -->
        <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control <?= form_error('nama_siswa') ? '  is-invalid' : '' ?>" value="<?= set_value('nama_siswa') ? set_value('nama_siswa') : $nama_siswa ?>">
            <div class="invalid-feedback"><?= form_error('nama_siswa') ?></div>
        </div>
        <!-- KELAS -->
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" class="form-control <?= form_error('kelas') ? '  is-invalid' : '' ?>" value="<?= set_value('kelas') ? set_value('kelas') : $kelas ?>">
            <div class="invalid-feedback"><?= form_error('kelas') ?></div>
        </div>
        <!-- EMAIL -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control <?= form_error('email') ? '  is-invalid' : '' ?>" value="<?= set_value('email') ? set_value('email') : $email ?>">
            <div class="invalid-feedback"><?= form_error('email') ?></div>
        </div>
        <!-- No HP -->
        <div class="form-group">
            <label for="nohp">No Handphone</label>
            <input type="text" name="nohp" class="form-control <?= form_error('nohp') ? '  is-invalid' : '' ?>" value="<?= set_value('nohp') ? set_value('nohp') : $nohp ?>">
            <div class="invalid-feedback"><?= form_error('nohp') ?></div>
        </div>

        <input type="text" name="type" value="<?= $type ?>" hidden />
        <button class="btn btn-primary float-right">Simpan</button>
    </form>

</div>
<!-- /.card-body -->