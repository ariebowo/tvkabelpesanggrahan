<div class="box box-primary color-palette-box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tags"></i> LAPORAN PEMBAYARAN</h3>
	</div>
	<div class="box-header with-border">
		<form method="POST">
			
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
					<button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Tampilkan Data</button>
					<a href="<?= base_url('report-keuangan') ?>" class="btn btn-flat btn-default"><i class="fa fa-close"></i> Bersihkan Filter</a>
					<?php if($data['bulan'] != '-' && $data['tahun'] != '-') {
					?>	
					<div class="pull-right">
						<a href="<?= base_url('report-keuangan/cetak?bulan='.$data['bulan'].'&tahun='.$data['tahun'])?>" target="_blank" class="btn btn-flat btn-danger"><i class="fa fa-print"></i> Cetak</a>
					</div>
					<?php }	?>
				</div>
			</div>
		</form>
	</div>
	<div class="box-body">
		<div class="row" style="padding:15px">
			<div class="col-lg-12 col-xs-12" >
			<?php if($data['bulan'] != '-' && $data['tahun'] != '-') {
				$saldo = 0;
			?>	
				<h3 class="text-center">LAPORAN KEUANGAN</h3>
				
				<table id="tbReportKeuangan" class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>No.</th>
							<th>Tanggal/Bulan</th>
							<th>Keterangan</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Saldo</th>
						</tr>
						
					</thead>
					<tbody>
						<tr>
							<td colspan="6">PENERIMAAN</td>
						</tr>
						<tr>
							<td></td>
							<td><?= $bulan[$data['bulan']].' '.$data['tahun'] ?></td>
							<td>Iuran TV Kabel</td>
							<td><?= 'Rp '.formatCurrency($data['iuran_tvkabel']) ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td><?= $bulan[$data['bulan']].' '.$data['tahun'] ?></td>
							<td>Iuran Sampah</td>
							<td><?= 'Rp '.formatCurrency($data['iuran_sampah']) ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="6">PENGELUARAN</td>
						</tr>
						<?php 
							$keluar = 0;
						if(!empty($data['pengeluaran']))
						{
							
							foreach($data['pengeluaran'] as $k=>$v) {
							
							$keluar += $v['total'];
						?>
						<tr>
							<td></td>
							<td><?= date('d F Y',strtotime($v['tanggal'])) ?></td>
							<td><?= $v['keterangan']?></td>
							<td></td>
							<td><?= 'Rp '.formatCurrency($v['total']) ?></td>
							<td></td>
						</tr>
						<?php } }
							$saldo = $data['iuran_sampah'] + $data['iuran_tvkabel'];
							$saldo = $saldo - $keluar;
						?>
						<tr>
							<th colspan="5">SALDO AKHIR</th>
							<th><span <?= $saldo < 0 ? 'style="color:red"' : '' ?>><?= 'Rp '.formatCurrency($saldo) ?></span></th>
						</tr>
					</tbody>
				</table>
			<?php } ?>
			</div>
		</div>
	</div>
</div>