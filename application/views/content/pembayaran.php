<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="box box-primary color-palette-box">
	<form action="<?= base_url('pembayaran/cari')?>" method="POST" id="fr_CrPl">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-user"></i> PILIH DATA PELANGGAN</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					
					<div class="form-group">
						<label>Pilih Pelanggan:</label>
						<select class="form-control select2" name="pelanggan" id="pelanggan">
							<option value="-">Pilih Pelanggan</option>
							<?php foreach($pelanggan as $k=>$v) { ?>
							<option value="<?= $v['pelanggan_id']?>"><?= $v['pelanggan_nama'] ?></option>
							<?php } ?>
						</select>
						<p class="help-block">*) Pilih salah satu pelanggan</p>
					</div>
	
				</div>
			</div>
		</div>
		<div class="box-footer with-border text-center">
			
			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-refresh"></i> SUBMIT UNTUK PROSES </button>
			
		</div>
	</form>
	</div>
</div>
<div class="col-md-3"></div>