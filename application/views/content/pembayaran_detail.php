<div class="col-md-4">
	<div class="box box-primary color-palette-box">
	
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-user"></i> DATA PELANGGAN</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					
					<div class="form-group">
						<label>Nama Pelanggan:</label>
						<input type="text" class="form-control" value="<?= $pelanggan->pelanggan_nama ?>" readonly />
					</div>
					<div class="form-group">
						<label>Alamat:</label>
						<input type="text" class="form-control" value="<?= $pelanggan->pelanggan_alamat ?>" readonly />
					</div>
					<div class="form-group">
						<label>RT/RW:</label>
						<input type="text" class="form-control" value="<?= $pelanggan->pelanggan_rt.'/'.$pelanggan->pelanggan_rw ?>" readonly />
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" disabled <?= isset($pelanggan->pelanggan_tvkabel) && $pelanggan->pelanggan_tvkabel == '1' ? 'checked' : '' ?>> Berlangganan TV Kabel
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" disabled <?= isset($pelanggan->pelanggan_sampah) && $pelanggan->pelanggan_sampah == '1' ? 'checked' : '' ?>> Berlangganan Iuran Sampah
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer with-border">
			<span class="pull-right">
				<button class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalHarga"><i class="fa fa-tags"></i> Cek Harga</button>
				<button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalPrint"><i class="fa fa-print"></i> Cetak Data Pembayaran</button>
			</span>
		</div>
		<!-- Modal Harga -->
		<div class="modal fade" id="modalHarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md">
				
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Info Harga</h4>
						</div>
						<div class="modal-body">
							<table id="tbHarga" class="table table-striped table-bordered" >
								<thead>
									<tr>
										<th>ID</th>
										<th>Tgl Berlaku</th>
										<th>Tgl Berakhir</th>
										<th>Iuran TVKabel</th>
										<th>Iuran Sampah</th>
										
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($harga)){
									foreach($harga as $K=>$v) {
								?>		
								<tr>
									<td><?= $v['harga_id']?></td>
									<td><?= formatDate($v['harga_tgl_berlaku'], 'd-m-Y')?></td>
									<td><?= $v['harga_tgl_berakhir'] != '0000-00-00' ? formatDate($v['harga_tgl_berakhir'], 'd-m-Y') : 's/d sekarang'?></td>
									<td><?= formatCurrency($v['harga_tvkabel'])?></td>
									<td><?= formatCurrency($v['harga_iuran_sampah'])?></td>
								</tr>
								<?php
								}
								}?>
								</tbody>
						</table>
						</div>
						<div class="modal-footer">
							
							<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
							<a href="<?= base_url('harga')?>" class="btn btn-primary btn-flat" ><i class="fa fa-tags"></i> Update Harga</a>
						</div>
					</div>
				
			</div>
		</div>
		<!-- End Modal Harga -->
		
		<!-- Modal Cetak -->
		<div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Cetak Pembayaran</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Pilih Tahun</label>
								<select class="form-control select2" name="tahun_cetak" id="tahun_cetak" >
									<?php for($i=date('Y');$i>=2014;$i--) { ?>
									<option <?= isset($_POST['tahun']) && $_POST['tahun'] == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="pelanggan_id" id="pelanggan_id" value="<?= $pelanggan->pelanggan_id?>"/>
							<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
							<a data-url="<?= base_url('report-pembayaran/print')?>/" class="btn btn-primary btn-flat" id="btn-cetak-bayar" ><i class="fa fa-print"></i> Cetak</a>
						</div>
					</div>
				
			</div>
		</div>
		<!-- End Modal Cetak -->
	</div>
	
</div>
<div class="col-md-8">
	<div class="box box-primary color-palette-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-tags"></i> DATA PEMBAYARAN</h3>
		</div>
		<div class="box-header with-border">
		<form method="POST" id="filter_bayar" action="<?= base_url('report-pembayaran/detail-bayar/'.$pelanggan->pelanggan_id)?>">
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
					<button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Tampilkan Data</button>
					
				</div>
			</div>
		</form>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<table id="tbHasil" class="table table-striped table-bordered dt-responsive nowrap" >
					</table>
				</div>
			</div>
		</div>
	</div>

</div>