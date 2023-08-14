
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Perusahaan</th>
            <th>Jumlah</th>
            <th>Lokasi</th>
            <th>Maps</th>
            <th>Tanggal Pengumpulan</th>
            <th class="text-center">
                <a href="<?=base_url()?>admin/pengumpulan_sampah/add">
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
            <td><?=$key->merk_brand?></td>
            <td><?=$key->perusahaan?></td>
            <td><?=$key->jumlah?></td>
            <td><?=$key->lokasi?></td>
            <td><a href="https://www.google.com/maps/place/<?=$key->latitude?>+<?=$key->longitude?>" target="_BLANK"><i class="fa fa-map-marker"> </i> Lihat maps</a></td>
            <td><?=$key->tgl_pengumpulan?></td>
            <td>
                <a href="<?=base_url()?>admin/pengumpulan_sampah/edit/<?=$key->id_pengumpulan?>">
                    <button class="btn btn-warning text-white btn-sm">
                        <i class="far fa-edit"></i>
                    </button>
                </a>

                <a href="<?=base_url()?>admin/pengumpulan_sampah/delete/<?=$key->id_pengumpulan?>">
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

<script type="text/javascript">

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
        
    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY-MM-DD hh:mm:ss'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY-MM-DD hh:mm:ss'
        });
    
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "bSort": false,
        "buttons": ["excel", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

</script>