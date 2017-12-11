
<h3 class="text-center">LAPORAN KEUANGAN</h3>

<table id="tbReportKeuangan" class="table table-bordered" >
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
