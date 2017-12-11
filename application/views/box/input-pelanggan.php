<div class="box box-primary color-palette-box">
<form action="<?= base_url('pelanggan/save')?>" method="POST" id="fr_Save">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-plus"></i> TAMBAH DATA PELANGGAN</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-lg-6 col-xs-12">
				<!--div class="form-group">
					<label>Kode Pelanggan:</label>
					
					<input type="text" id="pelanggan_kode" name="pelanggan_kode" class="form-control" value="<?= isset($data->pelanggan_kode) ? $data->pelanggan_kode : '' ?>" />
					<p class="help-block">*) Kode Tidak Boleh Kosong</p>
				</div-->
				<div class="form-group">
					<label>Nama Pelanggan:</label>
					<input type="hidden" name="mode" value="<?= $mode?>" />
					<input type="hidden" name="id" value="<?= isset($data->pelanggan_id) ? $data->pelanggan_id : '' ?>" />
					<input type="text" id="pelanggan_nama" name="pelanggan_nama" class="form-control" value="<?= isset($data->pelanggan_nama) ? $data->pelanggan_nama : '' ?>" />
					<p class="help-block">*) Nama Tidak Boleh Kosong</p>
				</div>
				<div class="form-group">
					<label>Alamat Pelanggan:</label>
					<input type="text" id="pelanggan_alamat" name="pelanggan_alamat" class="form-control" value="<?= isset($data->pelanggan_alamat) ? $data->pelanggan_alamat : '' ?>" />
					<p class="help-block">*) Alamat Tidak Boleh Kosong</p>
				</div>
				<div class="form-group">
					<label style="display:block">RT/RW Pelanggan:</label>
					<select class="form-control" name="pelanggan_rt" style="width:20%;display:inline-block">
						<?php foreach($rt as $k=>$v) { ?>
						<option <?= isset($data->pelanggan_rt) && $data->pelanggan_rt == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
					<select class="form-control" name="pelanggan_rw" style="width:20%;display:inline-block">
						<?php foreach($rw as $k=>$v) { ?>
						<option <?= isset($data->pelanggan_rw) && $data->pelanggan_rw == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12">
				<div class="form-group">
					<label>Tanggal Mulai Berlangganan:</label>
					<input type="text" name="pelanggan_tgl_mulai_berlangganan" class="form-control datepicker" readonly value="<?= isset($data->pelanggan_tgl_mulai_berlangganan) && $data->pelanggan_tgl_mulai_berlangganan != '0000-00-00' ? formatDate($data->pelanggan_tgl_mulai_berlangganan, 'm/d/Y') : date('m/d/Y') ?>" />
					<p class="help-block">*) Tanggal Tidak Boleh Kosong</p>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="pelanggan_tvkabel" value="1" <?= isset($data->pelanggan_tvkabel) && $data->pelanggan_tvkabel == '1' ? 'checked' : '' ?>> Berlangganan TV Kabel
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="pelanggan_sampah" value="1" <?= isset($data->pelanggan_sampah) && $data->pelanggan_sampah == '1' ? 'checked' : '' ?>> Berlangganan Iuran Sampah
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer with-border">
		<span class="pull-right">
			<a href="<?= base_url('pelanggan') ?>" class="btn btn-default btn-flat"><i class="fa fa-undo"></i> Kembali</a>
			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
		</span>
	</div>
</form>
</div>