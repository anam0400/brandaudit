<!DOCTYPE html>
<html lang="en">

<head>

  <?= @$_header?>

</head>

<body class="hold-transition sidebar-mini text-sm accent-primary" style="background-color: white;">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?= @$_menu?>

    <?= @$_sidebar?>

    <?= @$_content?>

    <?=@$_footer?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Ekko Lightbox -->
  <script src="<?=base_url()?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url()?>assets/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=base_url()?>assets/js/demo.js"></script>
  <script>
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
  </script>
</body>

</html>