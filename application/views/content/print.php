<div class="box box-primary color-palette-box">
	<div class="box-header with-border txt-center">
		<h3 class="box-title"><i class="fa fa-tags"></i> DATA PEMBAYARAN TV KABEL & IURAN SAMPAH</h3>
	</div>
	<div class="box-header with-border">
	
		<table style="padding:5px;">
			
			<tr style="padding:5px;">
				<td style="padding:5px;">Kode Pelanggan</td>
				<td style="padding:5px;">:</td>
				<th style="padding:5px;"><?= $pelanggan->pelanggan_id ?></th>
			</tr>
			<tr style="padding:5px;">
				<td style="padding:5px;">Nama Pelanggan</td>
				<td style="padding:5px;">:</td>
				<th style="padding:5px;"><?= $pelanggan->pelanggan_nama ?></th>
			</tr>
			<tr style="padding:5px;">
				<td style="padding:5px;">Alamat</td>
				<td style="padding:5px;">:</td>
				<th style="padding:5px;"><?= $pelanggan->pelanggan_alamat ?></th>
			</tr>
			<tr style="padding:5px;">
				<td style="padding:5px;">RT/RW</td>
				<td style="padding:5px;">:</td>
				<th style="padding:5px;"><?= $pelanggan->pelanggan_rt.'/'.$pelanggan->pelanggan_rw ?></th>
			</tr>
			<tr style="padding:5px;">
				<td style="padding:5px;">Tahun</td>
				<td style="padding:5px;">:</td>
				<th style="padding:5px;"><?= $tahun ?></th>
			</tr>
		</table>
	</div>
	<br/>
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<table id="tbHasil" class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>Pembayaran(Bulan)</th>
							<th>Tgl Bayar</th>
							<th>Iuran TVKabel</th>
							<th>Iuran Sampah</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						
						$currentLangganan = date('Y-m', strtotime($pelanggan->pelanggan_tgl_mulai_berlangganan));
						foreach($bulan as $main=>$val) { 
						$tgl = $pembayaran['year'].'-'.$main.'-01';
						$currentBayar = $pembayaran['year'].'-'.$main;
						
						$mulaiBerlangganan = ($pelanggan->pelanggan_tgl_mulai_berlangganan < $tgl) || ($currentLangganan == $currentBayar) ? true : false;
						
						
					?>
						<tr>
							<td><?= $val ?></td>
							<td>
							<?php 
								if( isset($pembayaran['tanggal_bayar'][$pelanggan->pelanggan_id][$main]))
								{
									echo formatDate($pembayaran['tanggal_bayar'][$pelanggan->pelanggan_id][$main]);
								}else{
									echo '-';
								}
							
							?>
							</td>
							<td>
							<?php if($pelanggan->pelanggan_tvkabel == '1') {
								
								
								if( $mulaiBerlangganan )
								{
									if( isset($pembayaran['tvkabel'][$pelanggan->pelanggan_id][$main]))
									{
										echo formatCurrency($pembayaran['tvkabel'][$pelanggan->pelanggan_id][$main]);
									}else{
										echo '<span class="label label-danger">Blm bayar</span>';
									}
									if( isset($pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main] == '1') { echo '&nbsp;<span class="label label-success"><i class="fa fa-check"></i></span>'; }
								}else{
									echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
								}
								
							}else{
								echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
							}?>
							
							</td>
							<td>
								<?php if($pelanggan->pelanggan_sampah == '1') {
									
									if( $mulaiBerlangganan )
									{
										if( isset($pembayaran['sampah'][$pelanggan->pelanggan_id][$main]))
										{
											echo formatCurrency($pembayaran['sampah'][$pelanggan->pelanggan_id][$main]);
										}else{
											echo '<span class="label label-danger">Blm bayar</span>';
										}
										if( isset($pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main] == '1') { echo '&nbsp;<span class="label label-success"><i class="fa fa-check"></i></span>'; }
									}else{
										echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
									}
									
								}else{
									echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
								}?>
							</td>
							
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>