<section class="content">
	
	<div class="box box-primary color-palette-box">
        <div class="box-header with-border txt-center">
          <h1 class="box-title"><i class="fa fa-tags"></i> SISTEM INFORMASI PEMBAYARAN TV KABEL & RETRIBUSI SAMPAH</h1>
        </div>
        <div class="box-body">

			<div class="row">
			<?php if($this->session->userdata('user_type') == 'superadmin') { ?>
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?=  formatCurrency($tot_pelanggan)?></h3>
							<p>Jumlah Pelanggan</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
						<a href="<?= base_url('pelanggan'); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>Rp. <?= !empty($pembayaran->bayar_tvkabel) ? formatCurrency($pembayaran->bayar_tvkabel) : 0?></h3>
							<p>Pembayaran TV Kabel Bulan Ini</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
						<a href="<?= base_url('report-pembayaran')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>Rp. <?= !empty($pembayaran->bayar_sampah) ? formatCurrency($pembayaran->bayar_sampah) : 0 ?></h3>
							<p>Pembayaran Iuran Sampah Bulan Ini</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
						<a href="<?= base_url('report-pembayaran')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>Rp. <?= !empty($tot_pengeluaran->total) ? formatCurrency($tot_pengeluaran->total) : 0 ?></h3>
							<p>Pengeluaran Bulan Ini</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
						<a href="<?= base_url('report-keuangan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<?php }else{ ?>
				
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>Rp. <?= !empty($pembayaran->bayar_tvkabel) ? formatCurrency($pembayaran->bayar_tvkabel) : 0?></h3>
							<p>Pembayaran TV Kabel Bulan Ini</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
						<a href="#" class="small-box-footer">Info lebih lanjut hubungi admin <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-lg-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>Rp. <?= !empty($pembayaran->bayar_sampah) ? formatCurrency($pembayaran->bayar_sampah) : 0 ?></h3>
							<p>Pembayaran Iuran Sampah Bulan Ini</p>
						</div>
						<div class="icon">
							<i class="fa fa-tags"></i>
						</div>
						<a href="#" class="small-box-footer">Info lebih lanjut hubungi admin <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
			<?php } ?>
			</div>
		</div>
		<div class="box-footer with-border txt-center">
          <h3 class="box-title">DESA PESANGGRAHAN BATU</h3>
        </div>
	</div>
	
	<div class="clearfix"></div>
</section>