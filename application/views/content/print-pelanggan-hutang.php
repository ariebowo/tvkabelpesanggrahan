<div class="box box-primary color-palette-box">
	<div class="box-header with-border txt-center">
		<h3 class="box-title"><i class="fa fa-tags"></i> DATA PELANGGAN <?= $jenis == 'iuran_kabel' ? 'TV KABEL' : 'IURAN SAMPAH' ?> RT <?= $rt ?> RW <?= $rw ?> <br/>YANG BELUM MELAKUKAN PEMBAYARAN/BELUM LUNAS</h3>
	</div>
	<div class="box-header with-border">
	
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
				<td><?= $bulan[$_GET['bulan']].' '.$_GET['tahun']?></td>
			</tr>
			<?php
				}
			}?>
			</tbody>
			
		</table>
	</div>
</div>