<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=base_name()?> | Log in</title>
  <link rel="favicon icon" href="<?=base_url()?>assets/img/brandaudit.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert2/sweetalert2.css">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet">
  
  <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .container { 
  height: 200px;
  position: relative;
  border: 3px solid green; 
}

.vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }

    p{
      font-family: 'Public Sans', sans-serif;
      color: black;
      font-size: 18px;
    }
  </style>

</head>
<body class="hold-transition login-page" style="background-color:white;>
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="<?=base_url()?>"><b><?=base_name()?></b></a>
  </div>
  /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" style="box-shadow: 0px 0px 2px 2px #d3d3d3; border-radius: 5%; width:480px; height:100%">
      <img src="assets/img/2.png" widht = "200" height= "100">
      <p class="login-box-msg" style="color:#006a4e;"><b>Silahkan Masuk Terlebih Dahulu</b></p>

      <form method="post" id="form-login">
        <div class="input-group mb-3">
          <input type="email" class="form-control" style="border-color: #006a4e;" placeholder="Username" name="email" required>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" style="border-color: #006a4e; width:-3%;" placeholder="Password" name="password" required>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" class="btn btn-primary btn-block center-block" style="background-color:#006a4e; border-color:#006a4e;" id="btnSubmit">Login</button>
          </div>
          <!-- /.col -->
        </div>
        <!-- <div class="row">
        <img src="assets/img/sponsor 1.png" style="display:block; margin:auto;">
        </div> -->
      </form>
      <!-- <div class="social-auth-links text-center mb-3">
        <a href="<?=base_url()?>auth/oauth2" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
      </div> -->
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<div class="load"></div>
<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/plugins/sweetalert2/sweetalert2.js"></script>
<script>
  $('#form-login').submit(function(e)
  {
    auth();
  });

  $('#btnSubmit').click(function()
  {
    auth();
  })

  function auth()
  {
    let formData = $('#form-login').serialize();
    
    $('.load').html(`
      <div class="preloader">
        <div class="loading">
          <img src="<?= base_url('assets/img/brandaudit.png') ?>" width="80">
          <p>Harap Tunggu</p>
        </div>
      </div>
    `);
    $.ajax({
      url     : '<?=base_url()?>auth/secure', 
      type    : 'POST',
      data    : formData, 
      success : function(response)
      {
        response = JSON.parse(response);
        if (response.status == 200){
          $('.load').html("");
          swal.fire("Yeayyyy!", response.message, "success");
          location.replace("<?=base_url()?>" + response.data.redirect);
        }else{
          $('.load').html("");
          swal.fire("Ooppsss!", response.message, "error");
        }
      },
      error   : function(err)
      {
        swal.fire("Ooppsss!", "Kamu tidak tersambung ke server kami.", "error");
      }
    });
  }
</script>
</body>
</html>
