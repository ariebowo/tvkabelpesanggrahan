
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/css/responsive.bootstrap.min.css" >
    <link rel="stylesheet" href="<?= base_url() ?>assets/lib/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
	<!--DataTables-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrapv2.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.min.css">
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-image:url('<?= base_url('assets/img/bg.jpg')?>')">

    <!-- Fixed navbar -->
    <?= $this->load->view('navigation') ?>

    <div class="container" style="margin:0;width:100%">

		<!-- Main component for a primary marketing message or call to action -->
		<section class="content">
		
			<section class="content">
		
				<?= $content ?>
				
			</section>
		</section>
		
		<!-- Modal Delete -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
			  </div>
			  <div class="modal-body">
				<p class="modal-text"></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
				<a type="button" class="btn btn-primary btn-flat" id="btn-Del">Hapus</a>
			  </div>
			</div>
		  </div>
		</div>
		
		
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <!--script src="<!?= base_url() ?>assets/js/jquery.number.js"></script-->
    <script src="<?= base_url() ?>assets/js/number_format.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script src="<?= base_url() ?>assets/css/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTablesv2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrapv2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>
	<!-- DateRangePicker -->
	<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Custom -->
	<?php if(isset($custom_js)) { ?>
	<script src="<?php echo base_url() ?>assets/js/<?= $custom_js ?>"></script>
	<?php } ?>
  </body>

<!-- Mirrored from getbootstrap.com/examples/navbar-fixed-top/ by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 17 Feb 2014 23:39:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
</html>
