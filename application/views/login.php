<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Pembayaran TV Kabel & Iuran Sampah | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/lib/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.min.css">
  <!--link rel="stylesheet" href="<?php echo base_url()?>assets/css/skin-black-light.css"-->
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition" style="background-image:url('<?= base_url('assets/img/bg.jpg')?>')">
<div class="login-box">
	<div class="login-logo" >
		<img src="<?= base_url('assets/img/logo-login.jpg')?>" style="max-width:100%">
	</div>
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php if( $this->session->userdata('error_login') ) { ?>
		<div class="alert alert-danger" style="z-index:5">
			
			<span class="fa fa-warning"></span> <strong> Gagal Login!</strong> Username atau password salah.
		</div>
	<?php }?>
    <p class="login-box-msg">Log in to start your session</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
 
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url()?>assets/admin/js/jquery.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>assets/admin/js/bootstrap.min.js"></script>

</body>
</html>
