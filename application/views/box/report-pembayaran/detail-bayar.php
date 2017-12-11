<table id="tbHasil" class="table table-striped table-bordered dt-responsive nowrap" >
	<thead>
		<tr>
			<th>Pembayaran(Bulan)</th>
			<th>Tgl Bayar</th>
			<th>Iuran TVKabel</th>
			<th>Iuran Sampah</th>
			<th>Action</th>
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
			<td>
				<?= $val ?>
			
				<?php if( ($mulaiBerlangganan && $pelanggan->pelanggan_sampah == '1' && (isset($pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main] != 0)) 
						|| ($mulaiBerlangganan && $pelanggan->pelanggan_tvkabel == '1' && (isset($pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main] != 0)) )  
						{
					
				?>
				<!-- Modal Edit -->
				<div class="modal-detail modal fade" id="modalEdit-<?= $pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-sm">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">+ Update Pembayaran</h4>
					  </div>
					  <div class="modal-body">
						<form action="<?= base_url('pembayaran/save')?>" method="POST" class="modalBayar">
						<div class="modal-body">
						
							<div class="form-group">
								<label>Bulan Bayar:</label>
								<input type="hidden" name="id" value="<?= $pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_id'] ?>"/>
								<input type="hidden" name="pelanggan_id" value="<?= $pelanggan->pelanggan_id ?>"/>
								<input type="hidden" name="bulan_bayar" value="<?= $tahun.'-'.$main.'-01' ?>"/>
								<input type="text" id="bulan_bayar" class="form-control" value="<?= $val ?>" readonly />
								
							</div>
							<?php if($pelanggan->pelanggan_tvkabel == '1') { ?>
							<div class="form-group">
								<label>Iuran TV Kabel:</label>
								<input type="text" class="form-control tNumb" name="iuran_tvkabel" value="<?= number_format($pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_bayar_tvkabel'],0,'.',',')?>" />
								
							</div>
							<?php } ?>
							<?php if($pelanggan->pelanggan_sampah == '1') { ?>
							<div class="form-group">
								<label>Iuran Sampah:</label>
								<input type="text" class="form-control tNumb" name="iuran_sampah" value="<?= number_format($pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_bayar_iuran_sampah'],0,'.',',')?>" />
								
							</div>
							<?php } ?>
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
				
				<?php }else{ ?>
				<!-- Modal Bayar -->
				<div class="modal-detail modal fade" id="modalBayar-<?= $main ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">+ Pembayaran</h4>
						</div>
						<form action="<?= base_url('pembayaran/save')?>" method="POST" class="modalBayar">
						<div class="modal-body">
						
							<div class="form-group">
								<label>Bulan Bayar:</label>
								<input type="hidden" name="pelanggan_id" value="<?= $pelanggan->pelanggan_id ?>"/>
								<input type="hidden" name="bulan_bayar" value="<?= $tahun.'-'.$main.'-01' ?>"/>
								<input type="text" id="bulan_bayar" class="form-control" value="<?= $val ?>" readonly />
								
							</div>
							<?php if($pelanggan->pelanggan_tvkabel == '1') { ?>
							<div class="form-group">
								<label>Iuran TV Kabel:</label>
								<input type="text" class="form-control tNumb" name="iuran_tvkabel" value="0" />
								
							</div>
							<?php } ?>
							<?php if($pelanggan->pelanggan_sampah == '1') { ?>
							<div class="form-group">
								<label>Iuran Sampah:</label>
								<input type="text" class="form-control tNumb" name="iuran_sampah" value="0" />
								
							</div>
							<?php } ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
							<button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-save"></i> Simpan</button>
						</div>
						</form>
					</div>
				  </div>
				</div>
				<?php }  ?>
				
			</td>
			<td>
			<?php 
				if( isset($pembayaran['tanggal'][$pelanggan->pelanggan_id][$main]))
				{
					echo formatDate($pembayaran['tanggal'][$pelanggan->pelanggan_id][$main]);
				}else{
					echo '-';
				}
			
			?>
			</td>
			<td>
			<?php if($pelanggan->pelanggan_tvkabel == '1') {
				
				#if( ($pelanggan->pelanggan_tgl_mulai_berlangganan < $tgl) || ($currentLangganan == $currentBayar) )
				if( $mulaiBerlangganan )
				{
					if( isset($pembayaran['tvkabel'][$pelanggan->pelanggan_id][$main]) && $pembayaran['tvkabel'][$pelanggan->pelanggan_id][$main] != 0)
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
					#if( ($pelanggan->pelanggan_tgl_mulai_berlangganan < $tgl) || ($currentLangganan == $currentBayar) )
					if( $mulaiBerlangganan )
					{
						if( isset($pembayaran['sampah'][$pelanggan->pelanggan_id][$main]) && $pembayaran['sampah'][$pelanggan->pelanggan_id][$main] != 0)
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
			<td>
				<?php if( ($mulaiBerlangganan && $pelanggan->pelanggan_sampah == '1' && (isset($pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_sampah'][$pelanggan->pelanggan_id][$main] != 0)) 
						|| ($mulaiBerlangganan && $pelanggan->pelanggan_tvkabel == '1' && (isset($pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main]) && $pembayaran['lunas_tvkabel'][$pelanggan->pelanggan_id][$main] != 0)) )  
						{
					
				?>
				<a class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#modalEdit-<?= $pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
				
				
				<?php }else{ ?>
				<a class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#modalBayar-<?= $main ?>"><i class="fa fa-plus"></i> Input Pembayaran</a>
				
				<?php }  ?>
				
				<?php if (isset($pembayaran[$pelanggan->pelanggan_id][$main])) { ?>
				<button class="btn btn-flat btn-danger btn-sm btn-del" data-url="<?= base_url('pembayaran/delete/'.$pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_id'])?>"><i class="fa fa-close"></i> Hapus</button><br/>
				<a href="<?= base_url('pembayaran/direct-print/'.$pembayaran[$pelanggan->pelanggan_id][$main]['transaksi_id']) ?>" class="btn btn-flat btn-warning btn-sm btn-direct-print" ><i class="fa fa-print"></i> Cetak Struk</a>
				
				<?php } ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>