<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_keuangan extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		
    }
	
	public function index()
	{
		$row['bulan'] = $this->bulan;
		$bulan = $tahun = '-';
		if( isset($_POST['bulan']) && $_POST['bulan'] != '-')
		{
			$bulan = $_POST['bulan'];
		}
		if( isset($_POST['tahun']) && $_POST['tahun'] != '-')
		{
			$tahun = $_POST['tahun'];
		}
		
		$row['data'] = $this->getRows( $bulan, $tahun);
		
		$cnf = array(
					'content' => $this->load->view('content/report-keuangan', $row, true),
					'custom_js' => 'report-pembayaran.js'
				);
		
		$this->render($cnf);
	}
	
	function cetak()
	{
		if( (isset($_GET['bulan']) && $_GET['bulan'] != '-') && (isset($_GET['tahun']) && $_GET['tahun'] != '-'))
		{
			if( $data = $this->getRows( $_GET['bulan'], $_GET['tahun'] ) )
			{
				$row['bulan'] = $this->bulan;
		
				$row['data'] = $data;
				#echoPre($row);exit;
				$cnf = array(
							'content' => $this->load->view('content/print-keuangan', $row, true),
							//'custom_js' => 'report-pembayaran.js'
						);
				
				$this->render($cnf, 'print');
			}else{
				echo 'Maaf data tidak kosong';
			}
			
		}
	}
	
	function getRows( $bulan = '-', $tahun = '-')
	{
		$row = array();
		$data['iuran_tvkabel'] = 0;
		$data['iuran_sampah'] = 0;
		$data['bulan'] = '-';
		$data['tahun'] = '-';
		$data['pengeluaran'] = '-';
		if( ($bulan && $bulan != '-') && ($tahun && $tahun != '-') )
		{
			$like = $tahun.'-'.$bulan;
			$row = $this->db->select('*')->from('transaksi')->like('transaksi_tgl_bayar', $like, 'after' )->get()->result_array();
			if(!empty($row))
			{
				foreach($row as $k=>$v)
				{
					#$data['iuran_tvkabel'] = isset($data['iuran_tvkabel']) ? $data['iuran_tvkabel'] : 0;
					#$data['iuran_sampah'] = isset($data['iuran_sampah']) ? $data['iuran_sampah'] : 0;
					
					$data['iuran_tvkabel'] += $v['transaksi_bayar_tvkabel'];
					$data['iuran_sampah'] += $v['transaksi_bayar_iuran_sampah'];
					
				}
			}
			
			$data['pengeluaran'] = $this->db->select('*')->from('pengeluaran')->like('tanggal', $like, 'after' )->get()->result_array();
			
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			
		}
		
		return $data;
		
	}

}
