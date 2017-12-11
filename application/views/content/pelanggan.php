<div class="box box-primary color-palette-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tags"></i> DATA PELANGGAN</h3>
		<span class="pull-right">
			<a href="<?= base_url('pelanggan') ?>" class="btn btn-flat btn-default">
				<i class="fa fa-refresh"></i> Refresh Data
			</a>
			<a href="<?= base_url('pelanggan/add') ?>" class="btn btn-flat btn-success">
				<i class="fa fa-plus"></i> Tambah Pelanggan
			</a>
		</span>
	</div>
	<div class="box-header with-border">
		<form id="fr_filter" method="POST">
			<div class="col-md-2">
				<div class="form-group">
					<label>Filter RT</label>
					<select class="form-control" name="rt" id="rt" >
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
					<select class="form-control" name="rw" id="rw" >
						<option value="-">Semua</option>
						<?php foreach($rt as $k=>$v) { ?>
						<option <?= isset($_POST['rw']) && $_POST['rw'] == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group" style="margin-top:25px">
					<button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Filter</button>
					<a href="<?= base_url('pelanggan') ?>" class="btn btn-flat btn-default"><i class="fa fa-close"></i> Bersihkan Filter</a>
				</div>
			</div>
		</form>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<table id="tbList" class="table table-striped table-bordered dt-responsive nowrap" data-source="<?= base_url('pelanggan/list-data') ?>">
					<thead>
						<tr>
							<th>Kode Pelanggan</th>
							<th>Nama Pelanggan</th>
							<th>Alamat</th>
							<th>RT</th>
							<th>RW</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>