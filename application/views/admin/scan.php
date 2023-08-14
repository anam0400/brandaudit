<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <!-- Scan via web cam -->
                <div class="video-wrap">
                    <video autoplay="true" id="video-webcam" class="col-md-12">
                        Browsermu anda tidak mendukung!
                    </video>
                </div>

                <canvas id="canvas" hidden="hidden" width="640" height="480"></canvas>
            </div>
            <div class="col-md-12">
                <button type="button" onclick="scanNow()" id="btnScan" class="btn btn-primary btn-flex col-md-12">
                    <span class="fa fa-camera"></span> Scan
                </button>  
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="kodebrand" class="form-label">Kode Brand</label>
                    <input type="input" class="form-control" id="kodebrand" value="-">
                </div>
                <div class="col-md-12 form-group">
                    <label for="recognizeResultToken" class="form-label">recognizeResultToken</label>
                    <input type="input" class="form-control" id="recognizeResultToken">
                </div>
                <div class="col-md-12 form-group">
                    <!-- <label for="urlRecognizeResultToken" class="form-label">urlRecognizeResultToken</label> -->
                    <input type="hidden" class="form-control" id="urlRecognizeResultToken">
                </div>
                
                <div class="col-md-12 form-group">
                    <button type="button" onclick="getBrand()" id="btnGetBrand" class="btn btn-primary btn-flex col-md-12">
                        <span class="fa fa-tags"></span> Get Brand!
                    </button>  
                </div>

                <div class="col-md-12 form-group">
                    <label for="errCode" class="form-label">ErrCode</label>
                    <input type="input" class="form-control" id="errCode">
                </div>
                <div class="col-md-12 form-group">
                    <label for="message" class="form-label">Message</label>
                    <input type="input" class="form-control" id="message">
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="errorMessage" class="form-label">Error Message</label>
                    <textarea class="form-control" id="errorMessage"></textarea>
                </div>
                
                <div class="clear"></div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Submit</button>   
                </div>
                <div class="col-md-4">
                <a href="<?=base_url()?>admin/CookiesLoc/delCookies" type="submit" class="btn btn-primary">Clear Cookies</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="msg"></div>

<script>
    // // seleksi elemen video
    var video = document.querySelector("#video-webcam");
    // navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia;
    const canvas = document.getElementById('canvas');

    // // kamera depan (laptop)
    // const constraints = {
    //     audio: false,
    //     video: {
    //         facingMode: "user"
    //     }
    // };

    // kamera belakang (phone)
    const constraints = {
        audio: false,
        video: {
            facingMode: {
                exact: 'environment'
            }
        }
    };

    async function init() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            handleSuccess(stream);
            // video.srcObject = stream;
            // setInterval(function(){
            //     checkQR(canvasData); 
            // }, 1500);
        } catch (e) {
            swal.fire("Opppsss!", "Izinkan menggunakan webcam belakang untuk scan Barcode!", "error");
            console.log(`navigator.getUserMedia error:${e.toString()}`);
        }
    }

    function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;

        var context = canvas.getContext('2d');
        // setInterval(function () {

        context.drawImage(video, 0, 0, 640, 480);
        var canvasData = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        // if ($('#kodebrand').val() == "-") {
        // cekQR(canvasData);
        // }
        // }, 5000);


    }

    function scanNow(){
        $('#btnScan').html("<span class='fa fa-spin fa-spinner'></span> Scanning...");

        getRecognizeResultToken().then(function(result) {
            if (result.status == 200) {
                if (result.data.recognizeResultTokenCount > 0) {
                    $('#recognizeResultToken').val(result.data.recognizeResultToken);
                    $('#urlRecognizeResultToken').val(result.data.urlRecognizeResultToken);
                }
                
                $('#errCode').val(result.errCode);
                $('#message').val(result.message);
                    
                $('#btnScan').html("<span class='fa fa-camera'></span> Scan");
            }
        }).catch(error => { 
            console.log(error); 
            $('#errorMessage').html(error);
            $('#errCode').val("E-999");
            $('#message').val("Error Response");
            $('#btnScan').html("<span class='fa fa-camera'></span> Scan");
        });
        
    }

    function getBrand(){
        $('#btnGetBrand').html("<span class='fa fa-spin fa-spinner'></span> Loading...");

        getKodeBrand($('#urlRecognizeResultToken').val()).then(function(result){
            if (result.status == 200) {
                if (result.data.brandCount > 0) {
                    $('#kodebrand').val(result.data.kode_brand);

                    $('#msg').html(result.message);
                } else if (result.data.brandCount == 0) {
                    $('#kodebrand').val(result.data.kode_brand);

                    if (result.data.kode_brand != "-") {
                        location.replace("<?=base_url()?>admin/produk/add/" + result.data.kode_brand);
                    }
                }
                    
                $('#errCode').val(result.errCode);
                $('#message').val(result.message);
                $('#errorMessage').html(result.response);

                $('#btnGetBrand').html("<span class='fa fa-tags'></span> Get Brand!");
            }
        }).catch(error => { 
            $('#errorMessage').html(error);
            $('#errCode').val("E-888");
            $('#message').val("Error Response getKodeBrand");
            $('#btnGetBrand').html("<span class='fa fa-tags'></span> Get Brand!");
        });
        
    }

    function getRecognizeResultToken(){
        return new Promise(function(resolve, reject) {
            var context = canvas.getContext('2d');
            // setInterval(function () {

            context.drawImage(video, 0, 0, 640, 480);
            var canvasData = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            $.ajax({
                type: 'POST',
                data: {
                    cat: canvasData
                },
                url: '<?=base_url()?>admin/Scan/cekQR',
                dataType: 'json',
            }).done(function(hasil) {
                // simpan hasil dari AJAX ke callback 'resolve' dari Promise
                // untuk kemudian nanti dipakai oleh fungsi '.then'
                resolve(hasil);
            }).fail(function(fail) {
                reject('Error pada request AJAX! '+JSON.stringify(fail));
            });
        })
    }

    function getKodeBrand(url = ""){
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'POST',
                data: {
                    url: url
                },
                url: '<?=base_url()?>admin/Scan/getKodeBrand',
                dataType: 'json',
            }).done(function(hasil) {
                // simpan hasil dari AJAX ke callback 'resolve' dari Promise
                // untuk kemudian nanti dipakai oleh fungsi '.then'
                resolve(hasil);
            }).fail(function(fail) {
                reject('Error pada request AJAX! '+JSON.stringify(fail));
            });
        })
    }    

    $('#btnClear').click(function () {
        clear();
    })

    function clear() {
        init();
        $('#kodebrand').val("-");
        $('#errCode').val("-");
        $('#message').val("-");
    }

    init();
</script>