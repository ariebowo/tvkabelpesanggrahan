<div class="navbar navbar-primary navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url(); ?>">TVKABEL/RET. SAMPAH</a>
        </div>
        <div class="navbar-collapse collapse">
		<?php if($this->session->userdata('user_type') == 'superadmin' ) { ?>
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar-o"></i> MASTER <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('pelanggan') ?>"><i class="fa fa-users"></i> Data Pelanggan</a></li>
                <li><a href="<?= base_url('harga') ?>"><i class="fa fa-tag"></i> Data Harga</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-opencart"></i> TRANSAKSI <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li ><a href="<?= base_url('data-hutang')?>"><i class="fa fa-book"></i> Data Hutang</a></li>
				<li ><a href="<?= base_url('pembayaran/add')?>"><i class="fa fa-money"></i> Input Pembayaran</a></li>
				<li ><a href="<?= base_url('pengeluaran/')?>"><i class="fa fa-clock-o"></i> Input Pengeluaran</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> LAPORAN <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('report-pembayaran') ?>"><i class="fa fa-file"></i> Laporan Pembayaran</a></li>
				<li class="divider"></li>
				<li><a href="<?= base_url('report-keuangan') ?>"><i class="fa fa-file"></i> Laporan Keuangan</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?= base_url('logout') ?>"><i class="fa fa-unlock"></i> Keluar</a></li>
          </ul>
		<?php }else{ ?>
			<ul class="nav navbar-nav">
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-opencart"></i> TRANSAKSI <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li ><a href="<?= base_url('data-hutang')?>"><i class="fa fa-book"></i> Data Hutang</a></li>
				<li ><a href="<?= base_url('pembayaran/add')?>"><i class="fa fa-money"></i> Input Pembayaran</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?= base_url('logout') ?>"><i class="fa fa-unlock"></i> Keluar</a></li>
          </ul>
		<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>