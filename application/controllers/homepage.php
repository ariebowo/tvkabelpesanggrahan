<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MY_Controller {
	
    public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		#$this->_directPrint(51);exit;
		$login = $this->session->userdata('is_admin');
		if(!($login)) redirect('login');
		
		$dt['tot_pelanggan'] = $this->db->get('pelanggan')->num_rows();
		$dt['pembayaran'] = $this->db->select("SUM(transaksi_bayar_tvkabel) as bayar_tvkabel, SUM(transaksi_bayar_iuran_sampah) as bayar_sampah ")->from('transaksi')->like('transaksi_tgl_bayar', date('Y-m'), 'both')->get()->row();
		$dt['tot_pengeluaran'] = $this->db->select('SUM(total) as total')->from('pengeluaran')->like('tanggal', date('Y-m'),'after')->get()->row();
		#echoPre($dt['tot_pengeluaran']);
		#exit;
		
		$cnf = array(
					'content' => $this->load->view('content/homepage', $dt, true)
				);
				
		$this->render($cnf);
		
	}
	
	public function checkLogin()
	{
		
		$user = $this->db->get_where('users', array('user_username' => $_POST['username']))->row();
		if( !empty($user))
		{
			
			if( $_POST['password'] == $user->user_password)
			{
				$this->session->set_userdata('is_admin',1);
				$this->session->set_userdata('user_id', $user->user_id);
				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('user_type', $user->user_type);
				
				redirect( base_url() );
			}else{
				$this->session->set_userdata('error_login', 1);
				$this->session->set_userdata('error_message', time());
			
				redirect('login');
			}
			
			
		}else{
			
			$this->session->set_userdata('error_login', 1);
			$this->session->set_userdata('error_message', time());
			
			redirect('login');
		}
		
	}
	
	public function login()
	{
		
		if( isset($_POST['login']))
		{
			$this->checkLogin();
		}
		
		if($this->session->userdata('error_login') && (time() - $this->session->userdata('error_message') > 5))
		{
			$this->session->unset_userdata('error_login');
			$this->session->unset_userdata('error_message');
		}
		
		$cnf = array(
					'title' => 'Login',
					'content' => $this->load->view('login', $dt = array(), true)
				);
		
		$this->load->view('login',$cnf);
	}
	
	public function test()
	{
		
		$row = $this->db->select('*')->from('pelanggan')->where('pelanggan_id', '1')
						#->join('harga', 'harga_id = pelanggan_harga_id')
						->get()->row();
						
		$harga = $this->db->get_where('harga', array('harga_is_deleted' =>'0'))->row();
		
		$inputan = 12500;
		//cari transaksi terakhir
		$trans = $this->db->select('*')->from('transaksi')->where('transaksi_pelanggan_id', $row->pelanggan_id)->order_by('transaksi_id', 'DESC')->limit(1,0)->get()->result();
		
		if(!empty($trans))
		{
			$trans = $trans[0];
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
							$dtUpdate['transaksi_status'] = 'lunas';
							
						}else{
							$dtUpdateIuran['transaksi_status'] = 'belum_lunas';
							echo 'Inputan Tidak Cukup';
							#break;
						}
						$this->db->where('transaksi_id', $trans->transaksi_id);
						$this->db->update('transaksi', $dtUpdate);
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
							$dtUpdateIuran['transaksi_status'] = 'lunas';
							
						}else{
							$dtUpdateIuran['transaksi_status'] = 'belum_lunas';
							echo 'Inputan tidak cukup';
							#break;
						}
						$this->db->where('transaksi_id', $trans->transaksi_id);
						$this->db->update('transaksi', $dtUpdateIuran);
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
							$dt['transaksi_status'] = 'lunas';
						}else{
							$dt['transaksi_bayar_tvkabel']  = $inputan;
							$dt['transaksi_status'] = 'belum_lunas';
							$inputan = 0;
						}
						
						
					}else{
						$dt['transaksi_bayar_tvkabel']  = $inputan;
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
							$dt['transaksi_status'] = 'lunas';
						}else{
							$dt['transaksi_bayar_iuran_sampah']  = $inputan;
							$dt['transaksi_status'] = 'belum_lunas';
							$inputan = 0;
						}
						
					}else{
						$dt['transaksi_bayar_iuran_sampah']  = $inputan;
						$dt['transaksi_status'] = 'belum_lunas';
					}
				}
				
				$dt['transaksi_date'] = date('Y-m-d H:i:s');
				$dt['transaksi_tgl_bayar'] = date('Y-m-01', $month);
				#echoPre($dt);
				$this->db->insert('transaksi', $dt);
				
				#echo date('01-m-Y', $month), PHP_EOL;
				#echo '<br>';
				$month = strtotime("+1 month", $month);
			}else{
				break;
			}
			
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
