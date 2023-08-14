<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah <?=@$headerTitle?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="form1" method="POST" action="<?=base_url()?>admin/pengumpulan_sampah/addProccess">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputid">Produk <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputid" class="form-control form-control-sm" name="kode_brand" required autocomplete="off" list="listProduk" onblur="cekProduk()">
                        <datalist name="listProduk" id="listProduk">
                        <?php foreach ($produk->data->result as $key){ ?>
                            <option value="<?=$key->kode_brand?>"><?=$key->merk_brand?></option>
                        <?php } ?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="inputnama">Nama Produk <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputnama" class="form-control form-control-sm" name="nama_produk" disabled>
                    </div>
                    <div class="form-group">
                        <label for="inputjumlah">Jumlah </label>
                        <input type="number" id="inputjumlah" class="form-control form-control-sm" name="jumlah" value="1" min="1" max="99" required>
                    </div>
                    <!-- <div class="form-floating">
                        <label for="inputcatatan">Catatan</label>
                        <textarea class="form-control" placeholder="Masukkan catatan di sini" id="inputcatatan"></textarea>
                    </div>    -->
                </div>

                <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label for="inputlokasi">Lokasi</label>
                        <input type="text" id="inputlokasi" class="form-control form-control-sm" name="lokasi">
                    </div>
                    <div class="form-group">
                        <label for="inputlatitude">Latitude</label>
                        <input type="text" id="inputlatitude" class="form-control form-control-sm" name="latitude">
                    </div>
                    <div class="form-group">
                        <label for="inputlongitude">Longitude</label>
                        <input type="text" id="inputlongitude" class="form-control form-control-sm" name="longitude">
                    </div>
                    <div class="form-group">
                        <label for="inputtgl">Tanggal Pengumpulan</label>
                        <input type="text" id="inputtgl" class="form-control form-control-sm" name="tgl_pengumpulan">
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group text-left" style="float: left;">
                        <button type="button" onclick="javascript:{window.history.back()}" class="btn btn-danger">
                            <i class="fas fa-chevron-left"></i> Kembali
                        </button>
                    </div>                    
                </div>
                <div class="col-md-3">
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
<div id="message"></div>

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

function cekProduk(){
    $.get('<?=base_url()?>admin/pengumpulan_sampah/cekData', 'kode_brand='+$('#inputid').val(), function(data){
        data = JSON.parse(data);
        if (data.status == 200){
            if (data.foundBrandsCount > 0){
                $('#inputnama').val(data.data.merk_brand);
            }else{
                $('#inputnama').val("");
                $('#message').html(data.message);
            }
        }else{
            $('#inputnama').val("");
        }
    })
}

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
        url     : '<?=base_url()?>admin/pengumpulan_sampah/addProccess',
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