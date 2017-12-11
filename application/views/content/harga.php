<div class="col-md-5">
	<div class="box box-primary color-palette-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-tag"></i> HARGA YANG BERLAKU SAAT INI</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-6 col-xs-12">
					
					<div class="form-group">
						<label>Harga Iuran TV Kabel:</label>
						<input type="hidden" name="id" value="<?= isset($data->harga_id) ? $data->harga_id : '' ?>" />
						<input type="text" name="harga_tvkabel" class="form-control tNumb" value="<?= isset($data->harga_tvkabel) ? number_format($data->harga_tvkabel,0,'.',',') : '' ?>" readonly />
						
					</div>
					<div class="form-group">
						<label>Harga Iuran Sampah:</label>
						<input type="text" name="harga_iuran_sampah" class="form-control tNumb" value="<?= isset($data->harga_iuran_sampah) ? number_format($data->harga_iuran_sampah, 0,'.',',') : '' ?>" readonly />
						
					</div>
				</div>
				<div class="col-lg-6 col-xs-12">
					<div class="form-group">
						<label>Tanggal Mulai Berlaku:</label>
						<input type="text" name="harga_tgl_berlaku" class="form-control datepicker" readonly value="<?= isset($data->harga_tgl_berlaku) && $data->harga_tgl_berlaku != '0000-00-00' ? formatDate($data->harga_tgl_berlaku, 'm/d/Y') : date('m/d/Y') ?>" />
						
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer with-border">
			<span class="pull-right">
				<button type="submit" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAddHarga"><i class="fa fa-pencil"></i> Update Harga</button>
			</span>
		</div>
	</div>
	
	<!-- Modal Input Baru -->
		<div class="modal fade" id="modalAddHarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">+ Update Harga Baru</h4>
				</div>
				<form method="POST" action="<?= base_url('harga/save')?>" id="fr_Harga">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-xs-12">
							
							<div class="form-group">
								<label>Harga Iuran TV Kabel:</label>
								<input type="text" id="harga_tvkabel" name="harga_tvkabel" class="form-control tNumb" value="0" />
								<p class="help-block">*) Harga Iuran TV Kabel Tidak Boleh Kosong</p>
							</div>
							<div class="form-group">
								<label>Harga Iuran Sampah:</label>
								<input type="text" id="harga_iuran_sampah" name="harga_iuran_sampah" class="form-control tNumb" value="0" />
								<p class="help-block">*) Harga Iuran Sampah Tidak Boleh Kosong</p>
							</div>
						</div>
						<div class="col-lg-6 col-xs-12">
							<div class="form-group">
								<label>Tanggal Mulai Berlaku:</label>
								<input type="text" name="harga_tgl_berlaku" class="form-control datepicker" readonly value="<?= date('m/01/Y') ?>" />
								<p class="help-block">*) Tanggal Tidak Boleh Kosong</p>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</a>
					<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
				</div>
				</form>
			</div>
		  </div>
		</div>
	
</div>
<div class="col-md-7">
	<div class="box box-primary color-palette-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-tags"></i> HISTORY PERUBAHAN HARGA</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<table id="tbList" class="table table-striped table-bordered" data-source="<?= base_url('harga/list-data') ?>">
						<thead>
							<tr>
								<th>ID</th>
								<th>Iuran TVKabel</th>
								<th>Iuran Sampah</th>
								<th>Tgl Berlaku</th>
								<th>Tgl Berakhir</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>