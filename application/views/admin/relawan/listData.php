<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kontak</th>
            <th>jenis kelamin</th>
            <th>Jenis Relawan <small>(Organisasi)</small></th>
            <th class="text-center">
                <a href="<?=base_url()?>admin/relawan/add">
                    <button class="btn btn-info btn-sm">
                        <i class="far fa-plus-square"></i>
                    </button>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($data as $key) {
        ?>
        <tr>
            <td><?=$key->nama_relawan?></td>
            <td><?=$key->kontak_relawan?></td>
            <td><?=$key->jenis_kelamin?></td>
            <td><?=ucwords($key->jenis_relawan)?> <small>(<?=$key->instansi_nama?>)</small></td>
            <td>
                <a href="<?=base_url()?>admin/relawan/edit/<?=$key->id_relawan?>">
                    <button class="btn btn-warning text-white btn-sm">
                        <i class="far fa-edit"></i>
                    </button>
                </a>

                <a href="<?=base_url()?>admin/relawan/delete/<?=$key->id_relawan?>">
                    <button class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<!-- DataTables  & Plugins -->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
        
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "bSort": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>