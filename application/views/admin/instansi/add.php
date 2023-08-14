<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah <?=@$headerTitle?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="form1" method="POST" action="<?=base_url()?>admin/instansi/addProccess">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputnama">Nama Instansi<span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputnama" class="form-control form-control-sm" name="nama_instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_instansi">Jenis Instansi <span class="text-sm text-danger">*</span></label>
                        <select name="jenis_instansi" id="jenis_instansi" class="form-control form-control-sm">
                        <?php $arr = array('perusahaan', 'organisasi'); ?>
                        <?php for($i = 0; $i < count($arr); $i++){ ?>
                            <option value="<?=$arr[$i]?>"><?=ucwords($arr[$i])?></option>
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
});

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
        url     : '<?=base_url()?>admin/instansi/addProccess',
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