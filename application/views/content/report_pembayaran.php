<div class="box box-primary color-palette-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tags"></i> LAPORAN PEMBAYARAN</h3>
	</div>
	<div class="box-header with-border">
		<form id="fr_filter" method="POST">
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter RT</label>
					<select class="form-control select2" name="rt" id="rt" >
						<option value="-">Semua</option>
						<?php foreach($rt as $k=>$v) { ?>
						<option <?= isset($_POST['rt']) && $_POST['rt'] == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter RW</label>
					<select class="form-control select2" name="rw" id="rw" >
						<option value="-">Semua</option>
						<?php foreach($rt as $k=>$v) { ?>
						<option <?= isset($_POST['rw']) && $_POST['rw'] == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter Pelanggan</label>
					<select class="form-control select2" name="pelanggan" id="pelanggan" >
						<option value="-">Semua</option>
						<?php foreach($pelanggan as $k=>$v) { ?>
						<option <?= isset($_POST['nama_pelanggan']) && $_POST['nama_pelanggan'] == $v['pelanggan_id'] ? 'selected' : '' ?> value="<?= $v['pelanggan_id'] ?>"><?= $v['pelanggan_nama'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter Tahun</label>
					<select class="form-control select2" name="tahun" id="tahun" >
						<?php for($i=date('Y');$i>=2014;$i--) { ?>
						<option <?= isset($_POST['tahun']) && $_POST['tahun'] == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" style="margin-top:25px">
					<button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Filter</button>
					<a href="<?= base_url('report-pembayaran') ?>" class="btn btn-flat btn-default"><i class="fa fa-close"></i> Bersihkan Filter</a>
				</div>
			</div>
		</form>
	</div>
	<div class="box-body">
		<div class="row" style="padding:15px">
			<div class="col-lg-12 col-xs-12" style="overflow:auto">
				<!--table id="example1" class="table table-striped table-bordered" -->
				<table id="tbList" class="table table-striped table-bordered" data-source="<?= base_url('report-pembayaran/list-data')?>">
					<thead>
						<tr>
							<th rowspan="2">Pelanggan</th>
							<th rowspan="2">RT/RW</th>
							<!--th rowspan="2">Hutang</th-->
							<th colspan="2" class="txt-center">Januari</th>
							<th colspan="2" class="txt-center">Februari</th>
							<th colspan="2" class="txt-center">Maret</th>
							<th colspan="2" class="txt-center">April</th>
							<th colspan="2" class="txt-center">Mei</th>
							<th colspan="2" class="txt-center">Juni</th>
							<th colspan="2" class="txt-center">Juli</th>
							<th colspan="2" class="txt-center">Agustus</th>
							<th colspan="2" class="txt-center">September</th>
							<th colspan="2" class="txt-center">Oktober</th>
							<th colspan="2" class="txt-center">November</th>
							<th colspan="2" class="txt-center">Desember</th>
						</tr>
						<tr>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
							<th>TVKabel</th>
							<th>Sampah</th>
						</tr>
					</thead>
					<tbody>
					<!--?php foreach($dt_pelanggan as $k=>$v) { ?>
						<tr>
							<td ><a href="<?= base_url('report-pembayaran/detail/'.$v['pelanggan_id']) ?>"><?= $v['pelanggan_nama']?></a></td>
							<td ><?= $v['pelanggan_rt']?>/<?= $v['pelanggan_rw']?></td>
							<td >-</td>
							<?php foreach($bulan as $main=>$val) { 
								$currentLangganan = date('Y-m', strtotime($v['pelanggan_tgl_mulai_berlangganan']));
								$currentBayar = $pembayaran['year'].'-'.$main;
								$tgl = $pembayaran['year'].'-'.$main.'-01';
							?>
							<td class="txt-center">
								<?php if($v['pelanggan_tvkabel'] == '1') {
									
									if( ($v['pelanggan_tgl_mulai_berlangganan'] < $tgl) || ($currentLangganan == $currentBayar) )
									{
										if( isset($pembayaran['tvkabel'][$v['pelanggan_id']][$main]))
										{
											echo formatCurrency($pembayaran['tvkabel'][$v['pelanggan_id']][$main]);
										}else{
											echo '<span class="label label-danger">Blm bayar</span>';
										}
										if( isset($pembayaran['lunas_tvkabel'][$v['pelanggan_id']][$main]) && $pembayaran['lunas_tvkabel'][$v['pelanggan_id']][$main] == '1') { echo '&nbsp;<span class="label label-success"><i class="fa fa-check"></i></span>'; }
										
									}else{
										echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
									}
									
								}else{
									echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
								}?>
							</td>
							<td class="txt-center">
								<?php if($v['pelanggan_sampah'] == '1') {
									if( ($v['pelanggan_tgl_mulai_berlangganan'] < $tgl)  || ($currentLangganan == $currentBayar) )
									{
										if( isset($pembayaran['sampah'][$v['pelanggan_id']][$main]))
										{
											echo formatCurrency($pembayaran['sampah'][$v['pelanggan_id']][$main]);
										}else{
											echo '<span class="label label-danger">Blm bayar</span>';
										}
										if( isset($pembayaran['lunas_sampah'][$v['pelanggan_id']][$main]) && $pembayaran['lunas_sampah'][$v['pelanggan_id']][$main] == '1') { echo '&nbsp;<span class="label label-success"><i class="fa fa-check"></i></span>'; }
									}else{
										echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
									}
									
								}else{
									echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
								}?>
							</td>
							<?php } ?>
							
						</tr>
					<!?php } ?-->
					</tbody>
					<tfoot>
						<tr>
							<th rowspan="2">TOTAL PEMASUKAN</th>
							<th rowspan="2"></th>
							<!--th rowspan="2">-</th-->
							<th colspan="2" class="txt-center">Januari</th>
							<th colspan="2" class="txt-center">Februari</th>
							<th colspan="2" class="txt-center">Maret</th>
							<th colspan="2" class="txt-center">April</th>
							<th colspan="2" class="txt-center">Mei</th>
							<th colspan="2" class="txt-center">Juni</th>
							<th colspan="2" class="txt-center">Juli</th>
							<th colspan="2" class="txt-center">Agustus</th>
							<th colspan="2" class="txt-center">September</th>
							<th colspan="2" class="txt-center">Oktober</th>
							<th colspan="2" class="txt-center">November</th>
							<th colspan="2" class="txt-center">Desember</th>
						</tr>
						<tr>
							<th><span id="tot-tvkabel-januari"></span></th>
							<th><span id="tot-sampah-januari"></span></th>
							<th><span id="tot-tvkabel-februari"></span></th>
							<th><span id="tot-sampah-februari"></th>
							<th><span id="tot-tvkabel-maret"></span></th>
							<th><span id="tot-sampah-maret"></th>
							<th><span id="tot-tvkabel-april"></span></th>
							<th><span id="tot-sampah-april"></th>
							<th><span id="tot-tvkabel-mei"></span></th>
							<th><span id="tot-sampah-mei"></th>
							<th><span id="tot-tvkabel-juni"></span></th>
							<th><span id="tot-sampah-juni"></th>
							<th><span id="tot-tvkabel-juli"></span></th>
							<th><span id="tot-sampah-juli"></th>
							<th><span id="tot-tvkabel-agustus"></span></th>
							<th><span id="tot-sampah-agustus"></th>
							<th><span id="tot-tvkabel-september"></span></th>
							<th><span id="tot-sampah-september"></th>
							<th><span id="tot-tvkabel-oktober"></span></th>
							<th><span id="tot-sampah-oktober"></th>
							<th><span id="tot-tvkabel-november"></span></th>
							<th><span id="tot-sampah-november"></th>
							<th><span id="tot-tvkabel-desember"></span></th>
							<th><span id="tot-sampah-desember"></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>