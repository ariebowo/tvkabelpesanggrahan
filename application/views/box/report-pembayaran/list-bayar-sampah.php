<?php
	$currentLangganan = date('Y-m', strtotime($pl['pelanggan_tgl_mulai_berlangganan']));
	$currentBayar = $pembayaran['year'].'-'.$bulan;
	$tgl = $pembayaran['year'].'-'.$bulan.'-01';
	
	if($pl['pelanggan_sampah'] == '1') {
		if( ($pl['pelanggan_tgl_mulai_berlangganan'] < $tgl)  || ($currentLangganan == $currentBayar) )
		{
			if( isset($pembayaran['sampah'][$pl['pelanggan_id']][$bulan]) && $pembayaran['sampah'][$pl['pelanggan_id']][$bulan] != 0)
			{
				echo formatCurrency($pembayaran['sampah'][$pl['pelanggan_id']][$bulan]);
			}else{
				echo '<span class="label label-danger">Blm bayar</span>';
			}
			if( isset($pembayaran['lunas_sampah'][$pl['pelanggan_id']][$bulan]) && $pembayaran['lunas_sampah'][$pl['pelanggan_id']][$bulan] == '1') { echo '&nbsp;<span class="label label-success"><i class="fa fa-check"></i></span>'; }
		}else{
			echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
		}
		
	}else{
		echo '<span class="label label-success"><i class="fa fa-close"></i></span>';
	}
?>