<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hutang extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		$this->ctrl = base_url().'data-hutang/';
		
    }
	
	public function index()
	{
		$row['rt'] = $this->RT;
		$row['rw'] = $this->RW;
		$row['url'] = $this->ctrl;
		$row['bulan'] = $this->bulan;
		
		$jenis_bayar = $rt = $rw = $bulan = $tahun = '-';
		if( isset($_POST['jenis_bayar']) && $_POST['jenis_bayar'] != '-')
		{
			$jenis_bayar = $_POST['jenis_bayar'];
		}
		if( isset($_POST['rt']) && $_POST['rt'] != '-')
		{
			$rt = $_POST['rt'];
		}
		if( isset($_POST['rw']) && $_POST['rw'] != '-')
		{
			$rw = $_POST['rw'];
		}
		if( isset($_POST['bulan']) && $_POST['bulan'] != '-')
		{
			$bulan = $_POST['bulan'];
		}
		if( isset($_POST['tahun']) && $_POST['tahun'] != '-')
		{
			$tahun = $_POST['tahun'];
		}
		
		$row['data'] = $this->listData( $tahun, $bulan, $jenis_bayar, $rt, $rw);
		$row['url_export'] = base_url('data-hutang/print?tahun='.$tahun.'&bulan='.$bulan.'&jenis='.$jenis_bayar.'&rt='.$rt.'&rw='.$rw);
		$cnf = array(
					'content' => $this->load->view('content/data-hutang', $row, true),
					#'custom_js' => 'pelanggan.js'
				);
		
		$this->render($cnf);
	}
	
	function Cetak()
	{
		if( isset($_GET['tahun']) && isset($_GET['bulan']) && isset($_GET['jenis']) && isset($_GET['rt']) && isset($_GET['rw']) )
		{
			$row['data'] = $this->listData( $_GET['tahun'], $_GET['bulan'], $_GET['jenis'], $_GET['rt'], $_GET['rw']);
			$row['bulan'] = $this->bulan;
			$row['jenis'] = $_GET['jenis'];
			$row['rt'] = $_GET['rt'];
			$row['rw'] = $_GET['rw'];
			
			
			$cnf = array(
					'content' => $this->load->view('content/print-pelanggan-hutang', $row, true),
					#'custom_js' => 'pelanggan.js'
				);
		
			$this->render($cnf, 'print');
		}
		
	}
	
	private function listData( $tahun = '-', $bulan = '', $jenisBayar = '-', $rt = '-', $rw = '-')
	{
		$rowPelanggan = array();
		if( ($tahun == '-' && $bulan == '-' && $rt == '-' && $rw == '-' ) )
		{
			$rowPelanggan = array();
			
		}else{
			
			$date = $tahun.'-'.$bulan;
			
			$row = $this->db->select('*')->from('transaksi')->like('transaksi_tgl_bayar', $date, 'after')->get()->result_array();
			$idPelanggan = array();
			$PelangganID['tvkabel'] = array();
			$PelangganID['sampah'] = array();
			if(!empty($row))
			{
				foreach($row as $k=>$v)
				{
					$idPelanggan[] = $v['transaksi_pelanggan_id'];
					if( $v['transaksi_tvkabel_lunas'] == 0)
					{
						$PelangganID['tvkabel'][] = $v['transaksi_pelanggan_id'];
					}
					if( $v['transaksi_sampah_lunas'] == 0)
					{
						$PelangganID['sampah'][] = $v['transaksi_pelanggan_id'];
					}
				}
			}
			
			#echoPre($PelangganID['tvkabel']);
			#echoPre($PelangganID['sampah']);
			#exit;
			
			if( !empty($idPelanggan))
			{
				
				if( $jenisBayar != '-')
				{
					//cari pelanggan yang belum melakukan transaksi
					$rowPelanggan = $this->db->select('*')->from('pelanggan')
										->where('pelanggan_status', '1')->where('pelanggan_is_deleted', '0')
										->where_not_in('pelanggan_id', $idPelanggan)
										->where('pelanggan_rt', $rt)
										->where('pelanggan_rw', $rw);
										
					if($jenisBayar == 'iuran_kabel')
					{
						$rowPelanggan = $rowPelanggan->where('pelanggan_tvkabel', '1')->get()->result_array();
						if(!empty($PelangganID['tvkabel'])) {
							$rowPelangganPlus = $this->db->select('*')->from('pelanggan')->where_in('pelanggan_id', $PelangganID['tvkabel'])->get()->result_array();
							#echoPre(count($rowPelanggan));
							$rowPelanggan = array_merge($rowPelanggan , $rowPelangganPlus);
							#echoPre(count($rowPelanggan));
						}
						
					}else if( $jenisBayar == 'iuran_sampah' )
					{
						$rowPelanggan = $rowPelanggan->where('pelanggan_sampah', '1')->get()->result_array();
						if(!empty($PelangganID['sampah'])) {
							$rowPelangganPlus = $this->db->select('*')->from('pelanggan')->where_in('pelanggan_id', $PelangganID['sampah'])->get()->result_array();
						
							$rowPelanggan = array_merge($rowPelanggan , $rowPelangganPlus);
						}
						
					}
				}else{
					$rowPelanggan = array();
				}
										
				
			}
			
		}
		
		#echoPre($rowPelanggan);
		#echoPre($rowPelangganPlus);
		#exit;
		return $rowPelanggan;
		
		
	}
	
}
