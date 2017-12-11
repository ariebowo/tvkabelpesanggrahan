<div class="box box-primary color-palette-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tags"></i> DATA PENGELUARAN</h3>
		<div class="pull-right">
			<button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Input Pengeluaran</button>
		</div>
	</div>
	<div class="box-header with-border">
		<form>
		<div class="row">
			
			<div class="col-lg-9"></div>
			<div class="col-lg-3">
				
				<div class="form-group">
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" class="form-control pull-right active" id="date-range" value="<?= $dateRange ?>">
					</div>
					<!-- /.input group -->
				</div>
					<!--button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan Data</button-->
				
			</div>
		</div>
		</form>
		<!-- Modal Add -->
			<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">+ Input Pengeluaran</h4>
				  </div>
				  <div class="modal-body">
					<form action="<?= base_url('pengeluaran/save')?>" method="POST">
					<div class="modal-body">
					
						<div class="form-group">
							<label>Tanggal:</label>
							<input type="text" id="tanggal" name="tanggal" class="form-control datepicker" value="<?= date('m/d/Y') ?>" readonly />
							
						</div>
						
						<div class="form-group">
							<label>Keterangan:</label>
							<input type="text" class="form-control" name="keterangan" value="" />
							
						</div>
						
						<div class="form-group">
							<label>Nominal:</label>
							<input type="text" class="form-control tNumb" name="total" value="" />
							
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
						<button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-save"></i> Simpan</button>
					</div>
					</form>
				  </div>
				</div>
			  </div>
			</div>
		
	</div>
	<div class="box-body">
		<div class="row" style="padding:15px">
			<div class="col-lg-12 col-xs-12" style="overflow:auto">
				<!--table id="example1" class="table table-striped table-bordered" -->
				<table id="tbList" class="table table-striped table-bordered" data-source="<?= base_url('pengeluaran/list-data')?>/">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
							<th>Jumlah</th>
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