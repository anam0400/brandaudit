<script>
    let latitude = "";
    let longitude = "";
    $(document).ready(function () {
        navigator.geolocation.getCurrentPosition(function (position) {

            sendLatitude(position.coords.latitude);
            sendLongitude(position.coords.longitude);

            latitude = position.coords.latitude;
            longitude = position.coords.longitude;

            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            var mapOptions = {
                center: [latitude, longitude],
                zoom: 10
            }
            var peta = new L.map('map-canvas', mapOptions);
            // console.log(latitude);
            L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: 'pk.eyJ1IjoibWlyd2Fuc3lhaHMiLCJhIjoiY2tjdjhrZWU4MDF1dTJ1bWxybHYzcjUyeiJ9.pBy872j-S0fYVPy9K_T1Uw'
                }).addTo(peta);

            <?php 
            if (@$num_rows->data->sampahByArea){
                foreach (@$num_rows->data->sampahByArea as $key) { ?>
                L.marker([<?=@$key->latitude?>, <?=@$key->longitude?>], {
                        draggable: false,
                        alt: '<?=@$key->lokasi?>'
                    }).addTo(peta)
                    .bindPopup('<?=@$key->lokasi?>, Jumlah sampah <?=@$key->jumlah?>!')
                    .openPopup();
            <?php } 
            }?>
        }, function (e) {
            showError(e);
            alert('Geolocation Tidak Mendukung Pada Browser Anda');
        }, {
            enableHighAccuracy: true
        });
    });

    function sendLatitude(position) {

        return position;
        // longitude 	= position.coords.longitude;

    }

    function sendLongitude(position) {

        return position;
        // longitude 	= position.coords.longitude;

    }

    function showError(error) {
        var view = document.getElementById("lokasi");
        switch (error.code) {
            case error.PERMISSION_DENIED:
                view.innerHTML = "<p>Yah, mau deteksi lokasi tapi ga boleh :(</p>"
                break;
            case error.POSITION_UNAVAILABLE:
                view.innerHTML = "<p>Yah, Info lokasimu nggak bisa ditemukan nih</p>"
                break;
            case error.TIMEOUT:
                view.innerHTML = "<p>Requestnya timeout bro</p>"
                break;
            case error.UNKNOWN_ERROR:
                view.innerHTML = "<p>An unknown error occurred.</p>"
                break;
        }
    }
</script>
<div class="row">
    <div class="col-md-12">
        <?=$this->session->flashdata('msg')?>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <a href="<?=base_url()?>admin/produk">
            <div class="info-box" style="background-color:#006a4e;">
                <span class="info-box-icon elevation-1" style="background-color:#FFDF00;"><img src="<?=base_url()?>assets/img/produk.png"></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="color:white;">Produk</span>
                    <span class="info-box-number" style="color:white;">
                        <?=@$num_rows->data->produk?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <a href="<?=base_url()?>admin/instansi">
            <div class="info-box mb-3" style="background-color:#006a4e;">
                <span class="info-box-icon elevation-1" style="background-color:#FFDF00;"><img src="<?=base_url()?>assets/img/instansi.png"></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="color:white;">Perusahaan</span>
                    <span class="info-box-number" style="color:white;">
                        <?=@$num_rows->data->perusahaan?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <a href="<?=base_url()?>admin/instansi">
            <div class="info-box mb-3" style="background-color:#006a4e;">
                <span class="info-box-icon elevation-1" style="background-color:#FFDF00;"><img src="<?=base_url()?>assets/img/organisasi.png"></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="color:white;">Organisasi</span>
                    <span class="info-box-number" style="color:white;">
                        <?=@$num_rows->data->organisasi?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <a href="<?=base_url()?>admin/relawan">
            <div class="info-box mb-3" style="background-color:#006a4e;">
                <span class="info-box-icon elevation-1" style="background-color:#FFDF00;"><img src="<?=base_url()?>assets/img/relawan.png"></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="color:white;">Relawan</span>
                    <span class="info-box-number" style="color:white;">
                        <?=@$num_rows->data->relawan?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-md-8">
        <div class="card" style="background-color: #006a4e;">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title" style="color:white;">Penghasil Sampah Terbanyak</h3>
                    <!-- <a href="javascript:void(0);">View Report</a> -->
                </div>
            </div>
            <div class="card-body" >
                <!-- <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span>Sales Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">Since last month</span>
                    </p>
                </div> -->
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="165"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2" style="color:white;">
                        <i class="fas fa-square" style="color:#FFDF00;"></i> All period
                    </span>

                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-4">
        <!-- RANKING PERUSAHAAN -->
        <div class="card direct-chat direct-chat-warning" style="background-color: #006a4e;">
            <div class="card-header">
                <h3 class="card-title" style="color:white;">Penghasil Sampah Terbanyak</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus" style="color:white;"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times" style="color:white;"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <?php
                    if (@$num_rows->data->sampah){
                        $no = 1;
                        foreach ($num_rows->data->sampah as $key) {
                    ?>
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-text" style="margin-left: 0px">
                            <?=$no?>. <?=$key->perusahaan?> <span class="badge badge-warning"><?=$key->jumlah?></span>
                        </div>
                    </div>
                    <!-- /.direct-chat-msg -->
                    <?php $no++; }
                    } ?>
                </div>
                <!-- /.direct-chat-pane -->
            </div>
        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="height:300px;" id="map-canvas"></div>
    </div>
</div>

<script src="<?=base_url()?>assets/plugins/chart.js/Chart.min.js"></script>

<script>
    
  var ticksStyle = {
    fontColor: 'white',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: <?=json_encode(@$num_rows->data->grafik->label)?>,
      datasets: [
        {
          backgroundColor: '#FFDF00',
          borderColor: '#FFDF00',
          data: <?=json_encode(@$num_rows->data->grafik->dataLabel)?>
        },
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