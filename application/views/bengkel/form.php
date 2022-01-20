<div class="card-body">
    <?= $this->session->flashdata('message') ?>
    <?php unset($_SESSION['message']) ?>
    <?php
    $username_edit = '';
    $password = '';
    $user_id = '';
    $bengkel_edit = '';
    $email_edit = '';
    $nohp_edit = '';
    $alamat_edit = '';
    if ($edit_bengkel) {
        $username_edit = $edit_bengkel['username'];
        $password = $edit_bengkel['password'];
        $user_id = $edit_bengkel['user_id'];
        $bengkel_edit = $edit_bengkel['nama_bengkel'];
        $email_edit  = $edit_bengkel['email'];
        $nohp_edit  = $edit_bengkel['nohp'];
        $alamat_edit  = $edit_bengkel['alamat'];
    }
    ?>
    <form action="<?= base_url('siswapkl/') . $type == 'add' ?? 'edit/' . $type ?>" method="post">

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control <?= form_error('username') ? '  is-invalid' : '' ?>" value="<?= set_value('username') ? set_value('username') : $username_edit ?>" <?= $type == 'edit' ? 'disabled' : '' ?>>
            <div class="invalid-feedback"><?= form_error('username') ?></div>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control <?= form_error('password') ? '  is-invalid' : '' ?>" placeholder="<?= $type == 'edit' ? 'Kosongkan password jika tidak ingin mengubah password' : '' ?>">
            <div class="invalid-feedback"><?= form_error('password') ?></div>
        </div>
        <!-- nama_bengkel -->
        <div class="form-group">
            <label for="nama_bengkel">Nama Bengkel</label>
            <input type="nama_bengkel" name="nama_bengkel" class="form-control <?= form_error('nama_bengkel') ? '  is-invalid' : '' ?>" value="<?= set_value('nama_bengkel') ? set_value('nama_bengkel') : $bengkel_edit ?>">
            <div class="invalid-feedback"><?= form_error('nama_bengkel') ?></div>
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control <?= form_error('email') ? '  is-invalid' : '' ?>" value="<?= set_value('email') ? set_value('email') : $email_edit ?>">
            <div class="invalid-feedback"><?= form_error('email') ?></div>
        </div>
        <!-- No Handphone -->
        <div class="form-group">
            <label for="nohp">No Handphone</label>
            <input type="nohp" name="nohp" class="form-control <?= form_error('nohp') ? '  is-invalid' : '' ?>" value="<?= set_value('nohp') ? set_value('nohp') : $nohp_edit ?>">
            <div class="invalid-feedback"><?= form_error('nohp') ?></div>
        </div>
        <!-- alamat -->
        <div class="form-group">
            <label for="alamat">Alamat Bengkel</label>
            <input type="alamat" name="alamat" class="form-control <?= form_error('alamat') ? '  is-invalid' : '' ?>" value="<?= set_value('alamat') ? set_value('alamat') : $alamat_edit ?>">
            <div class="invalid-feedback"><?= form_error('alamat') ?></div>
        </div>

        <input type="text" name="type" value="<?= $type ?>" hidden />
        <input type="text" name="user_id" value="<?= $user_id ?>" hidden />
        <button class="btn btn-primary float-right">Simpan</button>
    </form>

</div>
<!-- /.card-body -->