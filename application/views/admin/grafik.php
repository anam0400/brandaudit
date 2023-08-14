<div class="row">
    <div class="col-md-12">
        <?=$this->session->flashdata('msg')?>
    </div>
</div>

<form action="<?=base_url()?>admin/grafik" method="get">
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" name="uid" value="<?=base64_encode(time())?>">
            <select name="lokasi" class="form-control">
                <option value="">Pilih Lokasi</option>
                <?php foreach ($num_rows->data->lokasi as $key) { ?>
                <option value="<?=$key->lokasi_nama?>" <?=(@$_GET['lokasi'] == $key->lokasi_nama)?'selected':''?>><?=$key->lokasi_nama?></option>
                <?php } ?>
            </select>   
        </div>
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
        </div>
    </div>
</form>
<div class="clear"></div><br />
<div class="row">
    <!-- /.col -->
    <div class="col-2 col-sm-2 col-md-2">
        <div class="card card-outline card-sm card-primary">
            <div class="card-header">
                <span class="info-box-text">Total Sampah</span>
            </div>
            <div class="card-body">
                <span class="info-box-number" style="font-size: 30px">
                    <?=@number_format($num_rows->data->semuaSampah, 0, ',', '.')?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php $arrColor = array('success', 'info', 'danger', 'primary', 'warning'); $i = 0;?>
    <?php $arrColors = array('#28a745', '#17a2b8', '#dc3545', '#007bff', '#ffc107');?>
    <?php foreach (@$num_rows->data->jenisSampah as $key){ ?>
    <!-- /.col -->
    <div class="col-2 col-sm-2 col-md-2">
        <div class="card card-outline card-sm card-<?=$arrColor[$i]?>">
            <div class="card-header">
                <span class="info-box-text"><?=@$key->jenis_nama?></span>
            </div>
            <div class="card-body">
                <span class="info-box-number" style="font-size: 30px"><?=@$key->jumlah?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php $i++;} ?>
</div>

<div class="row">
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Area Sampah</h3>
                </div>
            </div>
            <div class="card-body">
            

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="165"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <?php $i=0; foreach ($num_rows->data->grafikSampahPerTempat->dataJenisSampah as $key) { ?>
                    <span class="mr-2">
                        <i class="fas fa-square text-<?=$arrColor[$i]?>"></i> <?=$key?>
                    </span>
                    <?php $i++;} ?>

                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>
<!-- /.row -->



<script src="<?=base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $salesChart = $('#sales-chart')
    
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: <?=json_encode(@$num_rows->data->grafikSampahPerTempat->dataTempat)?> ,
            datasets: [
                <?php $i = 0; foreach ($num_rows->data->grafikSampahPerTempat->dataSampah as $key) { ?>
                {
                    backgroundColor: '<?=$arrColors[$i]?>',
                    borderColor: '<?=$arrColors[$i]?>',
                    data: <?= json_encode(@$key) ?>
                }, 
                <?php $i++;} ?>
            ]
        },
        
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scaleFontColor: "#FFFFFF",
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // // Include a dollar sign in the ticks
                        // callback: function (value) {
                        //   if (value >= 1000) {
                        //     value /= 1000
                        //     value += 'k'
                        //   }

                        //   return '$' + value
                        // }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
        
    })
</script>