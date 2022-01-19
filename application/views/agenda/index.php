<div class="card">
    <div class="card-header">
        <?= $this->session->flashdata('message') ?>
        <?php unset($_SESSION['message']) ?>
        <div class="float-sm-right">
            <a href="<?= base_url('agenda/add') ?>" class="btn btn-primary">+ Masukkan Agenda</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kegiatan</th>
                    <th>Nilai Budaya Industri</th>
                    <th>Tanggal Kegiatan</th>
                    <?php if ($role == '1' || $role == '2') : ?>
                        <th>Bengkel</th>
                    <?php endif; ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($agenda as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_siswa']  ?></td>
                        <td><?= $row['kegiatan'] ?></td>
                        <td><?= $row['nilai_budaya_industri'] ?></td>
                        <td><?= $row['tanggal_kegiatan'] ?></td>
                        <?php if ($role == '1' || $role == '2') : ?>
                            <td><?= $row['nama_bengkel'] ?></td>
                        <?php endif; ?>
                        <td>
                            <a href="<?= base_url('agenda/edit/') . $row['agenda_id'] ?>" class="badge bg-success">Ubah</a>
                            <a onClick="return confirm('Yakin ingin menghapus agenda ini ?')" href="<?= base_url('agenda/delete/') . $row['agenda_id'] ?>" class="badge bg-danger">Hapus</a>
                        </td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- /.card -->