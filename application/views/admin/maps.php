<div class="row">
    <div class="col-md-6">
        <form id="form1" method="POST" action="<?=base_url()?>admin/CookiesLoc">
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-label" for="namaLokasi">Nama Lokasi</label>
						<input type="input" class="form-control" id="namaLokasi" name="namaLokasi">
						<div class="panel-heading">
							<span class="glyphicon glyphicon-globe"></span> Peta
						</div>
					<div class="panel-body" style="height:300px;" id="map-canvas"></div>
				</div>
                <div class="col-md-12 form-group">
                    <label class="form-label" for="latitude">Latitude</label>
                    <input class="form-control" type="text" id="latitude" placeholder="" name="latitude" required autocomplete="off" >
                </div>
                <div class="col-md-12 form-group">
                    <label class="form-label" for="longitude">Longitude</label>
                    <input class="form-control" type="text" id="longitude" placeholder="" name="longitude" required autocomplete="off" >
                </div>
				<div class="col-md-12">
					<a href="scan">
						<button type="submit" class="btn btn-primary">Submit</button>
					</a>
            	</div>
            </div>
        </form>
    </div>
</div>

<script>
    let latitude = "";
	let longitude = "";

	$(document).ready(function() {
		navigator.geolocation.getCurrentPosition(function (position) {

		sendLatitude(position.coords.latitude);
		sendLongitude(position.coords.longitude);

		latitude 	= position.coords.latitude;
		longitude 	= position.coords.longitude;

		$('#latitude').val(latitude);
		$('#longitude').val(longitude);

		var mapOptions = {
			center: [latitude,longitude],
			zoom: 17
		}

		var peta = new L.map('map-canvas', mapOptions);
		// console.log(latitude);
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
		    id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1,
		    accessToken: 'pk.eyJ1IjoibWlyd2Fuc3lhaHMiLCJhIjoiY2tjdjhrZWU4MDF1dTJ1bWxybHYzcjUyeiJ9.pBy872j-S0fYVPy9K_T1Uw'}).addTo(peta);
					let pos = L.marker([latitude, longitude],{draggable:true}).addTo(peta)
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

			function sendLatitude(position){

				return position;
				// longitude 	= position.coords.longitude;

			}function sendLongitude(position){

				return position;
				// longitude 	= position.coords.longitude;

			}
			function showError(error) {
				var view = document.getElementById("lokasi");
				switch(error.code) {
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