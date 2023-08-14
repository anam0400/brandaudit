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
                zoom: 17
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
            let pos = L.marker([latitude, longitude], {
                    draggable: true
                }).addTo(peta)
                .openPopup();
            pos.on('dragend', function (e) {
                document.getElementById('latitude').value = pos.getLatLng().lat;
                document.getElementById('longitude').value = pos.getLatLng().lng;
            });
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
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah <?=@$headerTitle?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    
    <?php echo form_open_multipart('admin/lokasi/addProccess')?>
         
        <!-- <form id="form1" method="POST" action="<?=base_url()?>admin/lokasi/addProccess"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputNama">Nama Lokasi <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="inputNama" class="form-control form-control-sm" name="lokasi_nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="map-canvas">Maps <span class="text-sm text-danger">*</span></label>
                        <div class="panel-body" style="height:500px;" id="map-canvas"></div>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="latitude" class="form-control form-control-sm" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude <span class="text-sm text-danger">*</span></label>
                        <input type="text" id="longitude" class="form-control form-control-sm" name="longitude"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="image"> Upload gambar <span class="text-sm text-danger">*</span></label>
                        <input type="file" id="image" class="form-control form-control-sm" name="image">
                </div>
                    <div class="form-group text-left" style="float: left;">
                        <button type="button" onclick="javascript:{window.history.back()}" class="btn btn-danger">
                            <i class="fas fa-chevron-left"></i> Kembali
                        </button>
                    </div>

                    <div class="form-group text-right" style="float: right;">
                        <button type="submit" class="btn btn-info" id="btnSubmit">
                            <i class="far fa-save"></i> Simpan
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                </div>
            </div>
                <?php echo form_close()  ?>

        <!-- </form> -->
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

    $('#btnSubmit').click(function () {
        // add();
    });

    function add() {
        $.ajax({
            url: '<?=base_url()?>admin/lokasi/addProccess',
            type: 'POST',
            data: $('#form1').serialize(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.succ) {
                    swal.fire("Yeayyyy!", response.msg, "success");
                    $('#form1').clear();
                } else {
                    swal.fire("Oooppsss!", response.msg, "error");
                }
            },
            error: function (err) {
                swal.fire("Oooppsss!", "Anda tidak terhubung ke server.", "error");
            }
        });
    }
</script>