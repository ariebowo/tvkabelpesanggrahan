<div class="col-md-4">
	<div class="box box-primary color-palette-box">
	<form action="<?= base_url('pembayaran/hitung')?>" method="POST" id="fr_Hitung">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-user"></i> DATA PELANGGAN</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					
					<div class="form-group">
						<label>Pilih Nama Pelanggan:</label>
						<select class="form-control select2" name="pelanggan" id="pelanggan">
							<option value="-">Pilih Pelanggan</option>
							<?php foreach($pelanggan as $k=>$v) { ?>
							<option value="<?= $v['pelanggan_id']?>"><?= $v['pelanggan_nama'] ?></option>
							<?php } ?>
						</select>
						<p class="help-block">*) Pilih salah satu pelanggan</p>
					</div>
					<div class="form-group">
						<label>Jumlah Yang Dibayarkan:</label>
						<input type="text" name="jml_bayar" id="jml_bayar" class="form-control tNumb" value="0" />
						<p class="help-block">*) Jumlah Bayar Tidak Boleh Kosong</p>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer with-border">
			<span class="pull-right">
				<input type="hidden" name="preview" value="1" />
				<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-refresh"></i> Hitung Otomatis</button>
			</span>
		</div>
	</form>
	</div>
	
</div>
<div class="col-md-8">
	<div class="box box-primary color-palette-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-tags"></i> HASIL PERHITUNGAN</h3>
		</div>
		<div class="box-header form-inline">
			<div class="form-group">
				<label class="col-md-5">Jumlah Bayar:</label>
				<div class="col-md-8">
					<input class="form-control" id="txt-jml-bayar" value="0" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-5">Sisa Bayar:</label>
				<div class="col-md-8">
					<input class="form-control" id="txt-sisa-bayar" value="0" readonly />
				</div>
			</div>
		</div>
		
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<div class="alert alert-warning txt-center" id="loader" style="display:none">
						<span class="fa fa-refresh fa-spin"></span> <strong> Sedang memproses ...</strong>
					</div>
					<table id="tbHasil" class="table table-striped table-bordered" >
						<thead>
							<tr>
								<th>Pembayaran(Bulan)</th>
								<th>Iuran TVKabel</th>
								<th>Iuran Sampah</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<form id="form_Simpan" action="<?= base_url('pembayaran/hitung') ?>" method="POST">
		<div class="box-footer with-border txt-center">
			
			<input type="hidden" name="pelanggan" id="pelanggan-id" value="0" />
			<input type="hidden" name="jml_bayar" id="jml-pembayaran" value="0" />
			<input type="hidden" name="preview" value="0" />
			<button type="submit" class="btn btn-primary btn-flat" id="btn-simpan" disabled> <i class="fa fa-save"></i> Simpan</button>
			
		</div>
		</form>
	</div>
	
	<!-- Modal Delete -->
	<div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
		  </div>
		  <div class="modal-body">
			<p class="modal-text">Data berhasil disimpan</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">OK</button>
			<!--a href="#" class="btn btn-primary btn-flat" data-dismiss="modal">Lihat Detail Pembayaran</a-->
		  </div>
		</div>
	  </div>
	</div>
	
</div>