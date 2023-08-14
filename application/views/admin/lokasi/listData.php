<table id="example1" class="table table-bordered table-striped">
<style>
    .center-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }
     
</style>    
<thead>
        <tr>
            <th>Lokasi</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Gambar Lokasi</th>
            <th>Maps</th>
            <th class="text-center">
                <a href="<?=base_url()?>admin/lokasi/add">
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
                if ($key->status == "1"){
                    $status = "success";
                    $text   = "Aktif";
                    $url    = "0";
                }else{
                    $status = "danger";
                    $text   = "Tidak aktif";
                    $url    = "1";
                }
        ?>
        <tr>
            <td><a style="text-decoration: none; color: black;" href="<?=base_url()?>admin/lokasi/status/<?=$key->id?>/<?=$url?>"><?=$key->lokasi_nama?> <span class="badge badge-<?=$status?>"><?=$text?></span></a></td>
            <td><?=$key->latitude?></td>
            <td><?=$key->longitude?></td>
            <td class="center-image">
                <img src="<?=base_url()?>upload/lokasi/<?=$key->image?>"  width="300" height="300">
            </td>   
            <td><a href="https://www.google.com/maps/place/<?=$key->latitude?>+<?=$key->longitude?>" target="_BLANK"><i class="fa fa-map-marker"> </i> Lihat maps</a></td>
            <td>
                <a href="<?=base_url()?>admin/lokasi/edit/<?=$key->id?>">
                    <button class="btn btn-warning text-white btn-sm">
                        <i class="far fa-edit"></i>
                    </button>
                </a>

                <a href="<?=base_url()?>admin/lokasi/delete/<?=$key->id?>">
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