<?php
if (empty($data))
{
    redirect('admin/relawan');
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah <?=@$headerTitle?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="form1" method="POST" action="<?=base_url()?>admin/relawan/editProccess/<?=$id?>">
            <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputnama">Nama <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputnama" class="form-control form-control-sm" name="nama_relawan" required value="<?=$data->data->result->nama_relawan?>">
                    </div>
                    <div class="form-group">
                        <label for="inputkontak">Kontak</label>
                        <input type="text" id="inputkontak" class="form-control form-control-sm" name="kontak_relawan" required value="<?=$data->data->result->kontak_relawan?>">
                    </div>         
                               
                </div>

                <div class="col-md-6">
                <div class="form-group">
                        <label for="inputemail">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm" onchange="cekSelect()">
                        <?php $arr = array('laki-laki', 'Perempuan'); ?>
                        <?php for($i = 0; $i < count($arr); $i++){ ?>
                            <option value="<?=$arr[$i]?>"><?=ucwords($arr[$i])?></option>
                        <?php } ?>
                        </select>
                    </div>   
                    <div class="form-group">
                        <label for="jenis_relawan">Jenis <span class="text-sm text-danger">*</span></label>
                        <select name="jenis_relawan" id="jenis_relawan" class="form-control form-control-sm" onchange="cekSelect()">
                        <?php $arr = array('perorangan', 'organisasi'); ?>
                        <?php for($i = 0; $i < count($arr); $i++){ ?>
                            <option value="<?=$arr[$i]?>" <?=($arr[$i] == $data->data->result->jenis_relawan)?'selected':''?>><?=ucwords($arr[$i])?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="cssOrganisasi">
                        <label for="instansi_nama">Organisasi</label>
                        <select name="instansi_nama" id="instansi_nama" class="form-control form-control-sm">
                        <?php foreach ($organisasi->data->result as $key){ ?>
                            <option value="<?=$key->nama_instansi?>" <?=(@$key->nama_instansi == @$data->data->result->nama_instansi)?'selected':''?>><?=$key->nama_instansi?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-left" style="float: left;">
                        <button type="button" onclick="javascript:{window.history.back()}" class="btn btn-danger">
                            <i class="fas fa-chevron-left"></i> Kembali
                        </button>
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class="form-group text-right" style="float: right;">
                        <button type="submit" class="btn btn-info" id="btnSubmit">
                            <i class="far fa-save"></i> Simpan
                        </button>
                    </div>                    
                </div>
            </div>
        </form>
    </div>
</div>

<?=$this->session->flashdata('msg')?>

<!-- InputMask -->
<script src="<?=base_url()?>assets/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?=base_url()?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();

  cekSelect();
});

function cekSelect()
{
    if ($('#jenis_relawan').val() == "organisasi"){
        $('#cssOrganisasi').css("display", "block");
    }else{
        $('#cssOrganisasi').css("display", "none");
    }
}
//Date picker
$('#inputDOB').datetimepicker({
    format: 'L'
});

$('#btnSubmit').click(function()
{
    // add();
});

function add()
{
    $.ajax({
        url     : '<?=base_url()?>admin/relawan/addProccess',
        type    : 'POST',
        data    : $('#form1').serialize(),
        success : function(response)
        {
            response = JSON.parse(response);
            if (response.succ)
            {
                swal.fire("Yeayyyy!", response.msg, "success");
                $('#form1').clear();
            }
            else
            {
                swal.fire("Oooppsss!", response.msg, "error");
            }
        },
        error   : function(err)
        {
            swal.fire("Oooppsss!", "Anda tidak terhubung ke server.", "error");
        }
    });
}
</script>