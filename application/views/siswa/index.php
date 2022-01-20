<div class="card">
    <div class="card-header">
        <?= $this->session->flashdata('message') ?>
        <?php unset($_SESSION['message']) ?>
        <div class="float-sm-right">
            <a href="<?= base_url('siswapkl/add') ?>" class="btn btn-primary">+ Siswa PKL</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Pembimbing</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($table as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_pembimbing'] ?></td>
                        <td><?= $row['nohp_siswa'] ?></td>
                        <td><?= $row['email_siswa'] ?></td>
                        <td><?= $row['kelas_siswa'] ?></td>
                        <td>
                            <a href="<?= base_url('siswapkl/edit/') . $row['siswa_id'] ?>" class="badge bg-success">Ubah</a>
                            <a onClick="return confirm('Yakin ingin menghapus siswa ini ?')" href="<?= base_url('siswapkl/delete/') . $row['siswa_id'] ?>" class="badge bg-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->