<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		
    }
	
	public function AddBayar()
	{
		$row['pelanggan'] = $this->db->get_where('pelanggan', array('pelanggan_is_deleted' => '0'))->result_array();
		
		$cnf = array(
					'content' => $this->load->view('content/pembayaran', $row, true),
					'custom_js' => 'pembayaran.js'
				);
		
		$this->render($cnf);
	}
	
	function cari()
	{
		if( isset($_POST['pelanggan']) && $_POST['pelanggan'] != '-' && $_POST['pelanggan'] != '')
		{
			$rdr = base_url('report-pembayaran/detail/'.$_POST['pelanggan']);
			#redirect( base_url('report-pembayaran/detail/'.$_POST['pelanggan']));
		}else{
			$rdr = base_url('pembayaran/add');
			#redirect( base_url('pembayaran/add'));
		}
		
		echo $rdr;
	}
	
	function delete( $id )
	{
		if(!$id) show_404();
		
		$row = $this->db->get_where('transaksi', array('transaksi_id' => $id))->row();
		$pelangganId = $row->transaksi_pelanggan_id;
		
		$this->db->where('transaksi_id', $id);
		$this->db->delete('transaksi');
		
		redirect( base_url('report-pembayaran/detail/'.$pelangganId) );
	}
	
	function hitung()
	{
		$bulan = $this->bulan;
		$preview = false;
		$list = '';
		$inputan = str_replace(",","",$_POST['jml_bayar']);
		
		if(!empty($_POST) && $_POST['pelanggan'] != 0)
		{
			
			$inputan = str_replace(",","",$_POST['jml_bayar']);
			$preview = isset($_POST['preview']) && $_POST['preview'] == 1 ? true : false;
			
			$row = $this->db->select('*')->from('pelanggan')->where('pelanggan_id', $_POST['pelanggan'])->get()->row();
			$langgananTvKabel = $row->pelanggan_tvkabel != '1' ? '<span class="label label-success"><i class="fa fa-close"></i></span>':'';
			$langgananSampah = $row->pelanggan_sampah != '1' ? '<span class="label label-success"><i class="fa fa-close"></i></span>':'';
			
			//cari transaksi terakhir
			$trans = $this->db->select('*')->from('transaksi')->where('transaksi_pelanggan_id', $row->pelanggan_id)->order_by('transaksi_id', 'DESC')->limit(1,0)->get()->result();
			
			if(!empty($trans))
			{
				$trans = $trans[0];
				//cek harga yg berlaku saat itu
				$Sqlharga = "SELECT * FROM `harga` WHERE `harga_tgl_berlaku` <= '".$trans->transaksi_tgl_bayar."' AND IF(`harga_tgl_berakhir` !='0000-00-00', `harga_tgl_berakhir` >= '".$trans->transaksi_tgl_bayar."', `harga_tgl_berakhir` = '0000-00-00')";
				$harga = $this->db->query($Sqlharga)->row();
				
				//cek transaksi terakhir sudah lunas atau belum
				if( $row->pelanggan_tvkabel == '1')
				{
					if( $inputan > 0 )
					{
						if( $trans->transaksi_bayar_tvkabel < $harga->harga_tvkabel)
						{
							
							
							$pelunasanTVKabel = $harga->harga_tvkabel - $trans->transaksi_bayar_tvkabel;
							if( $inputan >= $pelunasanTVKabel)
							{
								$inputan = $inputan - $pelunasanTVKabel;
								$dtUpdate['transaksi_bayar_tvkabel'] = $pelunasanTVKabel + $trans->transaksi_bayar_tvkabel;
								$dtUpdate['transaksi_tvkabel_lunas'] = '1';
								$dtUpdate['transaksi_status'] = 'lunas';
								
							}else{
								$dtUpdate['transaksi_bayar_tvkabel'] = $trans->transaksi_bayar_tvkabel;
								$dtUpdate['transaksi_tvkabel_lunas'] = '0';
								$dtUpdateIuran['transaksi_status'] = 'belum_lunas';
								#echo 'Inputan Tidak Cukup';
								#break;
							}
							if(!$preview)
							{
								$this->db->where('transaksi_id', $trans->transaksi_id);
								$this->db->update('transaksi', $dtUpdate);
							}
							
						}
					}
					
				}
				
				if( $row->pelanggan_sampah == '1')
				{
					if( $inputan > 0 )
					{
						if( $trans->transaksi_bayar_iuran_sampah < $harga->harga_iuran_sampah)
						{
							$pelunasanIuranSampah = $harga->harga_iuran_sampah - $trans->transaksi_bayar_iuran_sampah;
							if( $inputan >= $pelunasanIuranSampah)
							{
								$inputan = $inputan - $pelunasanIuranSampah;
								$dtUpdateIuran['transaksi_bayar_iuran_sampah'] = $pelunasanIuranSampah + $trans->transaksi_bayar_iuran_sampah;
								$dtUpdateIuran['transaksi_sampah_lunas'] = '1';
								$dtUpdateIuran['transaksi_status'] = 'lunas';
								
							}else{
								$dtUpdateIuran['transaksi_bayar_iuran_sampah'] = $trans->transaksi_bayar_iuran_sampah;
								$dtUpdateIuran['transaksi_sampah_lunas'] = '0';
								$dtUpdateIuran['transaksi_status'] = 'belum_lunas';
								echo 'Inputan tidak cukup';
								#break;
							}
							if(!$preview)
							{
								$this->db->where('transaksi_id', $trans->transaksi_id);
								$this->db->update('transaksi', $dtUpdateIuran);
							}
							
						}
					}
					
				}
				
				
				
				$start = $month = strtotime("+1 month", strtotime($trans->transaksi_tgl_bayar));
			}else{
				$start = $month = strtotime($row->pelanggan_tgl_mulai_berlangganan);
			}
			
			
			$end = strtotime(date('Y-m-d'));
			while($month < $end)
			{
				//cek harga yg berlaku saat itu
				$tglHarga = date('Y-m-01', $month);
				$Sqlharga = "SELECT * FROM `harga` WHERE `harga_tgl_berlaku` <= '".$tglHarga."' AND IF(`harga_tgl_berakhir` !='0000-00-00', `harga_tgl_berakhir` >= '".$tglHarga."', `harga_tgl_berakhir` = '0000-00-00')";
				$harga = $this->db->query($Sqlharga)->row();
				
				$dt['transaksi_bayar_tvkabel'] = 0;
				$dt['transaksi_bayar_iuran_sampah'] = 0;
				
				if( $inputan > 0 )
				{
					$dt['transaksi_pelanggan_id'] = $row->pelanggan_id;
					if( $row->pelanggan_tvkabel == '1')
					{
						#echoPre($inputan);
						if( $inputan > 0 )
						{
							if( $inputan >= $harga->harga_tvkabel )
							{
								$inputan = $inputan - $harga->harga_tvkabel;
								
								$dt['transaksi_bayar_tvkabel']  = $harga->harga_tvkabel;
								$dt['transaksi_tvkabel_lunas'] = '1';
								$dt['transaksi_status'] = 'lunas';
							}else{
								$dt['transaksi_bayar_tvkabel']  = $inputan;
								$dt['transaksi_tvkabel_lunas'] = '0';
								$dt['transaksi_status'] = 'belum_lunas';
								$inputan = 0;
							}
							
							
						}else{
							$dt['transaksi_bayar_tvkabel']  = $inputan;
							$dt['transaksi_tvkabel_lunas'] = '0';
							$dt['transaksi_status'] = 'belum_lunas';
						}
						
						
					}
					if( $row->pelanggan_sampah == '1')
					{
						#echoPre($inputan);
						//bayar iuran sampah
						if( $inputan > 0 )
						{
							if( $inputan >= $harga->harga_iuran_sampah )
							{
								$inputan = $inputan - $harga->harga_iuran_sampah;
								
								$dt['transaksi_bayar_iuran_sampah']  = $harga->harga_iuran_sampah;
								$dt['transaksi_sampah_lunas'] = '1';
								$dt['transaksi_status'] = 'lunas';
							}else{
								$dt['transaksi_bayar_iuran_sampah']  = $inputan;
								$dt['transaksi_sampah_lunas'] = '1';
								$dt['transaksi_status'] = 'belum_lunas';
								$inputan = 0;
							}
							
						}else{
							$dt['transaksi_bayar_iuran_sampah']  = $inputan;
							$dt['transaksi_sampah_lunas'] = '1';
							$dt['transaksi_status'] = 'belum_lunas';
						}
					}
					
					$dt['transaksi_date'] = date('Y-m-d H:i:s');
					$dt['transaksi_tgl_bayar'] = date('Y-m-01', $month);
					
					if(!$preview)
					{
						$this->db->insert('transaksi', $dt);
					}
					$list .= '<tr>
									<td>'.$bulan[date('m', $month)].' '.date('Y', $month).'</td>
									<td>'.($row->pelanggan_tvkabel != '1' ? '' : formatCurrency($dt['transaksi_bayar_tvkabel'])).' '.$langgananTvKabel.'</td>
									<td>'.($row->pelanggan_sampah != '1' ? '' : formatCurrency($dt['transaksi_bayar_iuran_sampah'])).' '.$langgananSampah.'</td>
								</tr>';
								
					$month = strtotime("+1 month", $month);
				}else{
					break;
				}
				
			}
		}
		
		$output = array(
						'preview' => $preview,
						'content' => $list,
						'bayar' => $_POST['jml_bayar'],
						'sisa'=> number_format($inputan,0,'.',','),
					);
		
		header('Content-Type: application/json');		
		echo json_encode($output);
	}
	
	function save()
	{
		
		if( !empty($_POST))
		{
			//cek harga yg berlaku saat ini
			$Sqlharga = "SELECT * FROM `harga` WHERE `harga_tgl_berlaku` <= '".$_POST['bulan_bayar']."' AND IF(`harga_tgl_berakhir` !='0000-00-00', `harga_tgl_berakhir` >= '".$trans->transaksi_tgl_bayar."', `harga_tgl_berakhir` = '0000-00-00')";
			$harga = $this->db->query($Sqlharga)->row();
			$row = $this->db->select('*')->from('pelanggan')->where('pelanggan_id', $_POST['pelanggan_id'])->get()->row();
			
			if( isset($_POST['id']))
			{
				//update
				if( $row->pelanggan_tvkabel == '1')
				{
					
					$dt['transaksi_bayar_tvkabel']  = str_replace(",","",$_POST['iuran_tvkabel']);
					if( str_replace(",","",$_POST['iuran_tvkabel']) >= $harga->harga_tvkabel )
					{
						$dt['transaksi_tvkabel_lunas'] = '1';
						$dt['transaksi_status'] = 'lunas';
					}else{
						$dt['transaksi_tvkabel_lunas'] = '0';
						$dt['transaksi_status'] = 'belum_lunas';
					}	
					
				}
				if( $row->pelanggan_sampah == '1')
				{
					$dt['transaksi_bayar_iuran_sampah']  = str_replace(",","",$_POST['iuran_sampah']);
					//bayar iuran sampah
					if( str_replace(",","",$_POST['iuran_sampah']) >= $harga->harga_iuran_sampah )
					{
						
						$dt['transaksi_sampah_lunas'] = '1';
						$dt['transaksi_status'] = 'lunas';
					}else{

						$dt['transaksi_sampah_lunas'] = '0';
						$dt['transaksi_status'] = 'belum_lunas';
						
					}
										
				}
				
				#$dt['transaksi_petugas_id'] = $this->session->userdata('user_id');
				
				$this->db->where('transaksi_id', $_POST['id']);
				$this->db->update('transaksi', $dt);
				
			}else{
				//insert
				$dt['transaksi_pelanggan_id'] = $row->pelanggan_id;
				if( $row->pelanggan_tvkabel == '1')
				{
					
					$dt['transaksi_bayar_tvkabel']  = str_replace(",","",$_POST['iuran_tvkabel']);
					if( str_replace(",","",$_POST['iuran_tvkabel']) >= $harga->harga_tvkabel )
					{
						$dt['transaksi_tvkabel_lunas'] = '1';
						$dt['transaksi_status'] = 'lunas';
					}else{
						$dt['transaksi_tvkabel_lunas'] = '0';
						$dt['transaksi_status'] = 'belum_lunas';
					}	
					
				}
				if( $row->pelanggan_sampah == '1')
				{
					$dt['transaksi_bayar_iuran_sampah']  = str_replace(",","",$_POST['iuran_sampah']);
					//bayar iuran sampah
					if( str_replace(",","",$_POST['iuran_sampah']) >= $harga->harga_iuran_sampah )
					{
						
						$dt['transaksi_sampah_lunas'] = '1';
						$dt['transaksi_status'] = 'lunas';
					}else{

						$dt['transaksi_sampah_lunas'] = '0';
						$dt['transaksi_status'] = 'belum_lunas';
						
					}
										
				}	
				$dt['transaksi_date'] = date('Y-m-d H:i:s');
				$dt['transaksi_tgl_bayar'] = $_POST['bulan_bayar'];
				$dt['transaksi_petugas_id'] = $this->session->userdata('user_id');
				
				$this->db->insert('transaksi', $dt);
			}
			
			redirect( base_url('report-pembayaran/detail/'.$_POST['pelanggan_id']));
		}else{
			redirect( base_url('report-pembayaran'));
		}
		
	}
	
	public function DirectPrint( $idTransaksi )
	{
		$this->_directPrint( $idTransaksi );
	}
	
}
