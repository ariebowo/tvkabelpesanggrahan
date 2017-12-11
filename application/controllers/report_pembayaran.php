<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_pembayaran extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		
    }
	
	public function index()
	{
		$row['rt'] = $this->RT;
		$row['rw'] = $this->RW;
		$row['bulan'] = $this->bulan;
		$row['pelanggan'] = $this->db->get('pelanggan')->result_array();
		$pelanggan = $this->db->select('*')->from('pelanggan');
		if( isset($_POST['rt']) && $_POST['rt'] != '-')
		{
			$pelanggan->where('pelanggan_rt', $_POST['rt']);
		}
		if( isset($_POST['rw']) && $_POST['rw'] != '-')
		{
			$pelanggan->where('pelanggan_rw', $_POST['rw']);
		}
		if( isset($_POST['nama_pelanggan']) && $_POST['nama_pelanggan'] != '-')
		{
			$pelanggan->where('pelanggan_id', $_POST['nama_pelanggan']);
		}
		$pelanggan = $pelanggan->get()->result_array();
		
		$row['dt_pelanggan'] = $pelanggan;
		$year = date('Y');
		if(isset($_POST['tahun']))
		{
			$year = $_POST['tahun'];
		}
		$row['pembayaran'] = $this->_getRows( $year);
		
		#echoPre($row['pembayaran']);exit;
		
		$cnf = array(
					'content' => $this->load->view('content/report_pembayaran', $row, true),
					'custom_js' => 'report-pembayaran.js'
				);
		
		$this->render($cnf);
	}
	
	function listData()
	{
		
		$search = array('pelanggan_nama', 'pelanggan_alamat');
		$query = "SELECT * FROM pelanggan WHERE pelanggan_is_deleted = '0' ";
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
		
		if( isset($_GET['rt']) && $_GET['rt'] != '-')
		{
			$query .= " AND pelanggan_rt = ".$_GET['rt']." ";
		}
		if( isset($_GET['rw']) && $_GET['rw'] != '-')
		{
			$query .= " AND pelanggan_rw = ".$_GET['rw']." ";
		}
		if( isset($_GET['pelanggan']) && $_GET['pelanggan'] != '-')
		{
			$query .= " AND pelanggan_id = ".$_GET['pelanggan']." ";
		}
		
		$year = date('Y');
		if(isset($_GET['tahun']))
		{
			$year = $_GET['tahun'];
		}
		
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
		$queryLimit = " ORDER BY pelanggan_id ASC LIMIT ".$limit." OFFSET ".$offset."";
		$data = $this->db->query($queryRow.$queryLimit)->result_array();
		
		$dataTable = array(
                        "draw" => isset($_POST['draw']) ? $_POST['draw'] : '1',
                        "recordsTotal" => $recordsTotal,
                        "recordsFiltered" => $recordsFiltered,
                        "data" => $data,
                );
		
		$dtBulan = $this->bulan;	
		$dt['pembayaran'] = $this->_getRows( $year);
		$dataTable['pembayaran'] = $dt['pembayaran'];
		
		if(!empty($dataTable))
		{
			foreach($dataTable['data'] as $k=>$v)
			{
				$dataTable['data'][$k]['pelanggan_nama'] = '<a href="'.base_url('report-pembayaran/detail/'.$v['pelanggan_id']).'">'.$v['pelanggan_nama'].'</a>';
				$dataTable['data'][$k]['pelanggan_rt_rw'] = $v['pelanggan_rt'].'/'.$v['pelanggan_rw'];
				$dataTable['data'][$k]['pelanggan_hutang'] = '';
				
				foreach($dtBulan as $K=>$m)
				{
					$dt['pl'] = $v;
					$dt['bulan'] = $K;
					
					$dataTable['data'][$k]['pelanggan_tvkabel_'.strtolower($m)] = $this->load->view('box/report-pembayaran/list-bayar-tvkabel', $dt, true);
					$dataTable['data'][$k]['pelanggan_sampah_'.strtolower($m)] = $this->load->view('box/report-pembayaran/list-bayar-sampah', $dt, true);
				}
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($dataTable);
		#echoPre($dataTable['data']);
	}
	
	function detail($id)
	{
		if(!$id) show_404();
		$row['pelanggan'] = $this->db->get_where('pelanggan', array('pelanggan_id' => $id))->row();
		if(!$row) show_404();
		
		$year = date('Y');
		if(isset($_POST['tahun']))
		{
			$year = $_POST['tahun'];
		}
		$row['bulan'] = $this->bulan;
		$row['pembayaran'] = $this->_getRows( $year);
		$row['tahun'] = $year;
		$row['harga'] = $this->db->select('*')->from('harga')->order_by('harga_id', 'DESC')->get()->result_array();
		
		$cnf = array(
					'content' => $this->load->view('content/pembayaran_detail', $row, true),
					'custom_js' => 'report-pembayaran.js'
				);
		
		$this->render($cnf);
	}
	
	function detailBayar($id)
	{
		if(!$id) show_404();
		$row['pelanggan'] = $this->db->get_where('pelanggan', array('pelanggan_id' => $id))->row();
		if(!$row) show_404();
		
		$year = date('Y');
		if(isset($_POST['tahun']))
		{
			$year = $_POST['tahun'];
		}
		$row['bulan'] = $this->bulan;
		$row['pembayaran'] = $this->_getRows( $year);
		$row['tahun'] = $year;
		$data['view'] = $this->load->view('box/report-pembayaran/detail-bayar', $row, true);
		
		header('Content-Type: application/json');
		
		echo json_encode($data);
	}
	
	function cetak( $idUser )
	{
		if(!$idUser) show_404();
		$row['pelanggan'] = $this->db->get_where('pelanggan', array('pelanggan_id' => $idUser))->row();
		if(!$row['pelanggan']) show_404();
		
		$row['bulan'] = $this->bulan;
		$year = date('Y');
		if(isset($_GET['tahun']))
		{
			$year = $_GET['tahun'];
		}
		
		$row['pembayaran'] = $this->_getRows( $year );
		$row['tahun'] = $year;
		
		$cnf = array(
					'content' => $this->load->view('content/print', $row, true),
					#'custom_js' => 'report-pembayaran.js'
				);
		
		$this->render($cnf, 'print');
	}
	
	
	private function _getRows( $tahun = '' )
	{
		
		if( $tahun )
		{
			$year = $tahun;
		}else{
			$year = date('Y');
		}
		
		$transaksi = $this->db->select('*')->from('transaksi')->like('transaksi_tgl_bayar', $year, 'both')->get()->result_array();
		$trans = array();
		$trans['year'] = $year;
		
		$totalIuranTvKabel = 0;
		$totalIuranSampah = 0;
		/*$trans['iuran_tvkabel']['01'] = 0;
		$trans['iuran_tvkabel']['02'] = 0;
		$trans['iuran_tvkabel']['03'] = 0;
		$trans['iuran_tvkabel']['04'] = 0;
		$trans['iuran_tvkabel']['05'] = 0;
		$trans['iuran_tvkabel']['06'] = 0;
		$trans['iuran_tvkabel']['07'] = 0;
		$trans['iuran_tvkabel']['08'] = 0;
		$trans['iuran_tvkabel']['09'] = 0;
		$trans['iuran_tvkabel']['10'] = 0;
		$trans['iuran_tvkabel']['11'] = 0;
		$trans['iuran_tvkabel']['12'] = 0;
		
		$trans['iuran_sampah']['01'] = 0;
		$trans['iuran_sampah']['02'] = 0;
		$trans['iuran_sampah']['03'] = 0;
		$trans['iuran_sampah']['04'] = 0;
		$trans['iuran_sampah']['05'] = 0;
		$trans['iuran_sampah']['06'] = 0;
		$trans['iuran_sampah']['07'] = 0;
		$trans['iuran_sampah']['08'] = 0;
		$trans['iuran_sampah']['09'] = 0;
		$trans['iuran_sampah']['10'] = 0;
		$trans['iuran_sampah']['11'] = 0;
		$trans['iuran_sampah']['12'] = 0;*/
		$trans['iuran_tvkabel']['januari'] = 0;
		$trans['iuran_tvkabel']['februari'] = 0;
		$trans['iuran_tvkabel']['maret'] = 0;
		$trans['iuran_tvkabel']['april'] = 0;
		$trans['iuran_tvkabel']['mei'] = 0;
		$trans['iuran_tvkabel']['juni'] = 0;
		$trans['iuran_tvkabel']['juli'] = 0;
		$trans['iuran_tvkabel']['agustus'] = 0;
		$trans['iuran_tvkabel']['september'] = 0;
		$trans['iuran_tvkabel']['oktober'] = 0;
		$trans['iuran_tvkabel']['november'] = 0;
		$trans['iuran_tvkabel']['desember'] = 0;
		
		$trans['iuran_sampah']['januari'] = 0;
		$trans['iuran_sampah']['februari'] = 0;
		$trans['iuran_sampah']['maret'] = 0;
		$trans['iuran_sampah']['april'] = 0;
		$trans['iuran_sampah']['mei'] = 0;
		$trans['iuran_sampah']['juni'] = 0;
		$trans['iuran_sampah']['juli'] = 0;
		$trans['iuran_sampah']['agustus'] = 0;
		$trans['iuran_sampah']['september'] = 0;
		$trans['iuran_sampah']['oktober'] = 0;
		$trans['iuran_sampah']['november'] = 0;
		$trans['iuran_sampah']['desember'] = 0;
		
		$dtBulan = $this->bulan;
		
		if(!empty($transaksi))
		{
			foreach($transaksi as $k=>$v)
			{
				$bulan = date('m', strtotime($v['transaksi_tgl_bayar']));
				
				$trans[$v['transaksi_pelanggan_id']][$bulan] = $v;
				$trans['tvkabel'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_bayar_tvkabel'];
				$trans['lunas_tvkabel'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_tvkabel_lunas'];
				$trans['sampah'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_bayar_iuran_sampah'];
				$trans['lunas_sampah'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_sampah_lunas'];
				$trans['tanggal'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_tgl_bayar'];
				$trans['tanggal_bayar'][$v['transaksi_pelanggan_id']][$bulan] = $v['transaksi_date'];
				
				$titleBulan = strtolower($dtBulan[$bulan]);
				$trans['iuran_tvkabel'][$titleBulan] = isset($trans['iuran_tvkabel'][$titleBulan]) ? $trans['iuran_tvkabel'][$titleBulan] + $v['transaksi_bayar_tvkabel'] : $v['transaksi_bayar_tvkabel'];
				$trans['iuran_sampah'][$titleBulan] = isset($trans['iuran_sampah'][$titleBulan]) ? $trans['iuran_sampah'][$titleBulan] + $v['transaksi_bayar_iuran_sampah'] : $v['transaksi_bayar_iuran_sampah'];
				
				#$trans['iuran_tvkabel'][$bulan] = isset($trans['iuran_tvkabel'][$bulan]) ? $trans['iuran_tvkabel'][$bulan] + $v['transaksi_bayar_tvkabel'] : $v['transaksi_bayar_tvkabel'];
				#$trans['iuran_sampah'][$bulan] = isset($trans['iuran_sampah'][$bulan]) ? $trans['iuran_sampah'][$bulan] + $v['transaksi_bayar_iuran_sampah'] : $v['transaksi_bayar_iuran_sampah'];
				
				
				$totalIuranTvKabel += $v['transaksi_bayar_tvkabel'];
				$totalIuranSampah += $v['transaksi_bayar_iuran_sampah'];
				
			}
		}
		
		$trans['total_iuran_tvkabel'] = $totalIuranTvKabel;
		$trans['total_iuran_sampah'] = $totalIuranSampah;
		
		$trans['iuran_tvkabel']['januari'] = formatCurrency($trans['iuran_tvkabel']['januari']);
		$trans['iuran_tvkabel']['februari'] = formatCurrency($trans['iuran_tvkabel']['februari']);
		$trans['iuran_tvkabel']['maret'] = formatCurrency($trans['iuran_tvkabel']['maret']);
		$trans['iuran_tvkabel']['april'] = formatCurrency($trans['iuran_tvkabel']['april']);
		$trans['iuran_tvkabel']['mei'] = formatCurrency($trans['iuran_tvkabel']['mei']);
		$trans['iuran_tvkabel']['juni'] = formatCurrency($trans['iuran_tvkabel']['juni']);
		$trans['iuran_tvkabel']['juli'] = formatCurrency($trans['iuran_tvkabel']['juli']);
		$trans['iuran_tvkabel']['agustus'] = formatCurrency($trans['iuran_tvkabel']['agustus']);
		$trans['iuran_tvkabel']['september'] = formatCurrency($trans['iuran_tvkabel']['september']);
		$trans['iuran_tvkabel']['oktober'] = formatCurrency($trans['iuran_tvkabel']['oktober']);
		$trans['iuran_tvkabel']['november'] = formatCurrency($trans['iuran_tvkabel']['november']);
		$trans['iuran_tvkabel']['desember'] = formatCurrency($trans['iuran_tvkabel']['desember']);
		
		$trans['iuran_sampah']['januari'] = formatCurrency($trans['iuran_sampah']['januari']);
		$trans['iuran_sampah']['februari'] = formatCurrency($trans['iuran_sampah']['februari']);
		$trans['iuran_sampah']['maret'] = formatCurrency($trans['iuran_sampah']['maret']);
		$trans['iuran_sampah']['april'] = formatCurrency($trans['iuran_sampah']['april']);
		$trans['iuran_sampah']['mei'] = formatCurrency($trans['iuran_sampah']['mei']);
		$trans['iuran_sampah']['juni'] = formatCurrency($trans['iuran_sampah']['juni']);
		$trans['iuran_sampah']['juli'] = formatCurrency($trans['iuran_sampah']['juli']);
		$trans['iuran_sampah']['agustus'] = formatCurrency($trans['iuran_sampah']['agustus']);
		$trans['iuran_sampah']['september'] = formatCurrency($trans['iuran_sampah']['september']);
		$trans['iuran_sampah']['oktober'] = formatCurrency($trans['iuran_sampah']['oktober']);
		$trans['iuran_sampah']['november'] = formatCurrency($trans['iuran_sampah']['november']);
		$trans['iuran_sampah']['desember'] = formatCurrency($trans['iuran_sampah']['desember']);
		
		return $trans;
		
		
	}
}
