<div class="card">
    <div class="card-header">
        <div class="float-sm-right">
            <a href="<?= base_url('pkl/add') ?>" class="btn btn-primary">+ Permohonan PKL</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="table_bengkel" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Agenda</th>
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
                        <td>
                            <a href="#" class="btn btn-primary">+ Agenda</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

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