<div class="box box-primary color-palette-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tags"></i> CARI DATA PELANGGAN YANG BELUM MELAKUKAN PEMBAYARAN/BELUM LUNAS PEMBAYARAN</h3>
	</div>
	<div class="box-header with-border">
		<form id="fr_filter" method="POST">
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter Jenis Bayar</label>
					<select class="form-control select2" name="jenis_bayar" id="jenis_bayar" >
						<option value="-">Pilih Jenis Bayar</option>
						<option <?= isset($_POST['jenis_bayar']) && $_POST['jenis_bayar'] == 'iuran_kabel' ? 'selected' : '' ?> value="iuran_kabel">Iuran Kabel</option>
						<option <?= isset($_POST['jenis_bayar']) && $_POST['jenis_bayar'] == 'iuran_sampah' ? 'selected' : '' ?> value="iuran_sampah">Iuran Sampah</option>
						
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter RT</label>
					<select class="form-control select2" name="rt" id="rt" >
						<option value="-">Pilih RT</option>
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
						<option value="-">Pilih RW</option>
						<?php foreach($rt as $k=>$v) { ?>
						<option <?= isset($_POST['rw']) && $_POST['rw'] == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter Bulan</label>
					<select class="form-control select2" name="bulan" id="bulan" >
						<option value="-">Pilih Bulan</option>
						<?php foreach($bulan as $k=>$v) { ?>
						<option <?= isset($_POST['bulan']) && $_POST['bulan'] == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter Tahun</label>
					<select class="form-control select2" name="tahun" id="tahun" >
						<option value="-">Pilih Tahun</option>
						<?php for($i=date('Y');$i>=2014;$i--) { ?>
						<option <?= isset($_POST['tahun']) && $_POST['tahun'] == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" style="margin-top:25px">
					<label style="display:block;color:red">*) Mohon Isi Semua Pilihan Opsi Diatas</label>
					<button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Tampilkan Data</button>
					<a href="<?= base_url('data-hutang') ?>" class="btn btn-flat btn-default"><i class="fa fa-close"></i> Bersihkan Filter</a>
					<?php if(!empty($data)){ ?>
					<a href="<?= $url_export ?>" target="_blank" class="btn btn-flat btn-danger"><i class="fa fa-print"></i> Cetak</a>	
					<?php } ?>
				</div>
			</div>
		</form>
	</div>
	<div class="box-body">
			<div class="col-lg-12 col-xs-12">
				<!--table id="example1" class="table table-striped table-bordered" -->
				<table id="tbList" class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>Nama Pelanggan</th>
							<th>RT/RW</th>
							<th>Bulan Tunggakan</th>
						</tr>
						
					</thead>
					<tbody>
					<?php if(!empty($data))
					{
						foreach($data as $k=>$v) {
					?>
					<tr>
						<td><?= $v['pelanggan_nama']?></td>
						<td><?= $v['pelanggan_rt'].'/'.$v['pelanggan_rw']?></td>
						<td><?= $bulan[$_POST['bulan']].' '.$_POST['tahun']?></td>
					</tr>
					<?php
						}
					}?>
					</tbody>
					
				</table>
			</div>

	</div>
</div>