<div class="card">
    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']) ?>
    <div class="card-header">
        <div class="float-sm-right">
            <a href="<?= base_url('pkl/add') ?>" class="btn btn-primary">+ Permohonan PKL</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($table as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nohp_siswa'] ?></td>
                        <td><?= $row['email_siswa'] ?></td>
                        <td><?= $row['nilai'] ?? 'NULL' ?></td>
                        <td>
                            <a href="<?= base_url('pkl/penilaian/') . $row['id_siswa'] ?>" class="btn btn-primary">+ Penilaian</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- <script>
    $(document).ready(function() {
        $(function() {
            $("#table_bengkel").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#table_bengkel_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    })
</script> -->