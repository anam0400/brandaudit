<?php
if (empty($data))
{
    // redirect('admin/produk');
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah <?=@$headerTitle?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="form1" method="POST" action="<?=base_url()?>admin/produk/editProccess/<?=$id?>">
            <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputkode">Kode <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputkode" class="form-control form-control-sm" name="kode_brand" required value="<?=$data->data->result->kode_brand?>">
                    </div>
                    <div class="form-group">
                        <label for="inputmerk">Merk <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputmerk" class="form-control form-control-sm" name="merk_brand" required value="<?=$data->data->result->merk_brand?>">
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">Perusahaan <span class="text-sm text-danger">*</span></label>
                        <select name="perusahaan" id="perusahaan" class="form-control form-control-sm select2">
                        <?php foreach ($perusahaan->data->result as $key){ ?>
                            <option value="<?=$key->nama_instansi?>" <?=($key->nama_instansi == $data->data->result->perusahaan)?'selected':''?>><?=$key->nama_instansi?></option>
                        <?php } ?>
                        </select>
                    </div>           
                    <div class="form-group">
                        <label for="jenis_produk">Jenis Sampah <span class="text-sm text-danger">*</span></label>
                        <select name="jenis_produk" id="jenis_produk" class="form-control form-control-sm select2">
                        <?php foreach ($jenis_produk->data->result as $key){ ?>
                            <option value="<?=$key->jenis_produk?>" <?=($key->jenis_produk == $data->data->result->jenis_produk)?'selected':''?>><?=ucfirst($key->jenis_produk)?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="imageUpload">Upload Gambar <span class="text-sm text-danger">*</span></label>
                        <input type="file" id="imageUpload" class="form-control-file" name="image" accept="image/*">
                    </div> -->
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

<script src="<?=base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
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

$(function () {
	$('.select2').select2();
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
        url     : '<?=base_url()?>admin/produk/addProccess',
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