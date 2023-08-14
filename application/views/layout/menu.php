<div id="mmsg"></div>
<?php
  if (@$this->input->cookie('lokasiCookies')){
    $cookies = $this->input->cookie('lokasiCookies');
    $cookies = explode(";", $cookies);
  }
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary text-sm"  style="background-color: white;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:#006a4e;"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <form id="formLokasi">
          <select name="location" id="location" class="form-control form-control-sm" style="background-color:#FFDF00; border-color:#FFDF00;">
            <option value="-" style="color:white;">Pilih lokasi</option>
            <?php foreach ($this->userdata->data->dataLokasi as $key) { ?>
            <option value="<?=$key->id?>" <?=(@$cookies[0] == $key->id)?'selected':''?>><?=$key->lokasi_nama?></option>
            <?php } ?>
          </select>
      <!-- <li class="nav-item">
      <form id="formLokasi">
          <select name="lokasi" class="form-control">
                <option value="">Pilih Lokasi</option>
                <?php foreach ($num_rows->data->lokasi as $key) { ?>
                <option value="<?=$key->lokasi_nama?>" <?=(@$_GET['lokasi'] == $key->lokasi_nama)?'selected':''?>><?=$key->lokasi_nama?></option>
                <?php } ?>
            </select>    -->
        </form>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">1 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 1 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->
  <script>
    $('#location').change(function(){
        // alert($('#location').val());
        if ($('#location').val() != "-"){
          $.post('<?=base_url()?>admin/CookiesLoc', 'id='+$('#location').val(), function(data){
            // alert(data);
            data = JSON.parse(data);
            if (data.succ == "1"){
              $('#mmsg').html(data.message);
            }
          })
        }
    })
  </script>