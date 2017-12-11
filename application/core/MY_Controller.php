<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();
	public $RT = array();
	public $RW = array();
    public $bulan = array();
	
    public function __construct() {
        parent::__construct();
        
		if ($this->uri->uri_string != 'login')
		{
			$login = $this->session->userdata('is_admin');
			if(!($login)) redirect('login');
		};
		
		$this->RT = array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
						'7' => 7,
					);
					
		$this->RW = array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
						'7' => 7,
					);
		
		$this->bulan = array(
						'01' => 'Januari',
						'02' => 'Februari',
						'03' => 'Maret',
						'04' => 'April',
						'05' => 'Mei',
						'06' => 'Juni',
						'07' => 'Juli',
						'08' => 'Agustus',
						'09' => 'September',
						'10' => 'Oktober',
						'11' => 'November',
						'12' => 'Desember',
					
					);
    }
	
	public function render($cnf, $template='index')
	{
		$config = array(
						'title' => isset($cnf['title']) ? $cnf['title'] : 'Aplikasi Pembayaran TV Kabel & Iuran Sampah',
						'content' => isset($cnf['content']) ? $cnf['content'] : '',
						'custom_js' => isset($cnf['custom_js']) ? $cnf['custom_js'] : ''
					);
		
		$this->load->view($template, $config);
	}
	
	/**
	* @param $user is Object
	*/
	protected function setLogin($user)
	{
		$this->session->set_userdata('is_admin', 1);
		$this->session->set_userdata('user_id', $user->user_id);
		$this->session->set_userdata('user_realname', $user->user_realname);
		$this->session->set_userdata('user_username', $user->user_username);
		$this->session->set_userdata('user_password', $user->user_password);
		$this->session->set_userdata('user_access', $user->user_access);
		
		//update last login
		$this->db->where('user_id', $user->user_id);
		$this->db->update('users', array('user_last_login' => date('Y-m-d H:i:s')));
	}
	
	public function buildDatatable( $table, $columnSearch )
	{
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
        
		$row = $table;
        
        foreach ($columnSearch as $k => $item) // loop column 
        {
            if( isset($_POST['search']['value'])) // if datatable send POST for search
            {
                 
                if($k == 0) // first loop
                {
                    $row->like($item, $_POST['search']['value']);
                }
                else
                {
                    $row->or_like($item, $_POST['search']['value']);
                }
            }
        }
		
		#$row = $row->limit( $limit, $offset);
		
		$copyRow = clone $row;
		$RowFiltered = clone $row;
		$data = $row->limit( $limit, $offset)->get()->result_array();
		
		$recordsTotal = $copyRow->get()->num_rows();
		$recordsFiltered = $RowFiltered->get()->num_rows();
		
		
		$output = array(
                        "draw" => isset($_POST['draw']) ? $_POST['draw'] : '1',
                        "recordsTotal" => $recordsTotal,
                        "recordsFiltered" => $recordsFiltered,
                        "data" => $data,
                );
		return $output;
	}
	
	public function buildDatatableQuery( $query, $columnSearch )
	{
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
        
		$where = '';

		if( isset($_POST['search']['value'])) // if datatable send POST for search
        {
			foreach ($search as $k => $item) // loop column 
			{
				
				if($k == 0) // first loop
				{
					$where .= " AND (".$item." LIKE '%".$_POST['search']['value']."%'";
					
				}
				else
				{
					$where .= " OR ".$item." LIKE '%".$_POST['search']['value']."%'";
					
				}
					
			}
			$where.=")";
		}
		
		$queryRow = $queryFiltered = $query.$where;
		
		$recordsTotal = $recordsFiltered = $this->db->query($queryFiltered)->num_rows();
		$queryLimit = " LIMIT ".$limit." OFFSET ".$offset."";
		$data = $this->db->query($queryRow.$queryLimit)->result_array();
		
		$output = array(
                        "draw" => isset($_POST['draw']) ? $_POST['draw'] : '1',
                        "recordsTotal" => $recordsTotal,
                        "recordsFiltered" => $recordsFiltered,
                        "data" => $data,
                );
		
		return $output;
	}
	
	public function ObjectToArray( $data, $key )
	{
		if( !is_array($data))
		{
			$data = json_decode(json_encode($data), TRUE);
		}
		
		if(!empty($data))
		{
			foreach( $data as $k=>$v)
			{
				$return[$v[$key]] = $v;
			}
		}
		
		return $return;
		
	}
	
	public function _directPrint( $idTransaksi )
	{
		$row = $this->db->select('*')->from('transaksi')
					->where('transaksi_id', $idTransaksi)
					->join('pelanggan', 'pelanggan_id = transaksi_pelanggan_id')
					->get()->row();
		if(!$row) show_404();
		//Form Printing
		//LEN 40 charc
		$content = str_repeat(' ',10).'Aplikasi Pembayaran'."\n";
		$content .= str_repeat(' ',3).' IURAN TV KABEL & IURAN SAMPAH'."\n";
		$content .= '--------------------------------------'."\n";
		$content .= 'Pelanggan Kode :'.$row->pelanggan_id."\n";
		$content .= 'Pelanggan Nama :'.$row->pelanggan_nama."\n";
		$content .= 'Tgl Bayar      :'.formatDate($row->transaksi_date, 'd-m-Y')."\n";
		$content .= '--------------------------------------'."\n\n";
		$content .= 'Bulan Bayar'.str_repeat(' ', 4).'TV Kabel | Iuran Sampah'."\n\n"; //000.000.000
		
		$bulan = $this->bulan;
		$title = $bulan[formatDate($row->transaksi_tgl_bayar, 'm')].' '.formatDate($row->transaksi_tgl_bayar, 'Y');
		$title = substr($title,0,15);
		$SpaceTitle = (16 - (strlen($title)));
		$SpaceTitle = str_repeat(' ', $SpaceTitle);
		
		$hargaIuranTv = formatCurrency($row->transaksi_bayar_tvkabel);
		$spaceTvKabel = (9 - (strlen($hargaIuranTv)));
		$spaceTvKabel = str_repeat(' ', $spaceTvKabel);
		$hargaIuranSampah = formatCurrency($row->transaksi_bayar_iuran_sampah);
		$spaceSampah = (11 - (strlen($hargaIuranSampah)));
		$spaceSampah = str_repeat(' ', $spaceSampah);
		
		$content .= $title.$SpaceTitle.$spaceTvKabel.$hargaIuranTv.$spaceSampah.$hargaIuranSampah;
		
		#$content .= $title.str_repeat(' ', (2+$SpaceTitle)).formatCurrency($total).'   '.formatCurrency($totalSampah)."\n";
		
				
		$jmlBayar = $row->transaksi_bayar_tvkabel + $row->transaksi_bayar_iuran_sampah;
		
		$content .= "\n";
		$content .= '--------------------------------------'."\n";
		$spaceTotal = strlen(formatCurrency($jmlBayar));
		$content .= 'Total'.str_repeat(' ', 31-$spaceTotal).formatCurrency($jmlBayar)."\n";
		$content .= '--------------------------------------'."\n";
		$content .= '              TERIMA KASIH'."\n\n\n";
		/* tulis dan buka koneksi ke printer */    
		
		$printer = printer_open();  
		/* write the text to the print job */  
		printer_write($printer, $content);   
		/* close the connection */ 
		printer_close($printer);
	}
}
