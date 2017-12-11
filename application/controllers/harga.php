<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		$this->ctrl = base_url().'harga/';
		
    }
	
	public function index()
	{
		$row['url'] = $this->ctrl;
		$row['data'] = $this->db->get_where('harga', array('harga_is_deleted' => '0'))->row();
		
		$cnf = array(
					'content' => $this->load->view('content/harga', $row, true),
					'custom_js' => 'harga.js'
				);
		
		$this->render($cnf);
	}
	
	function listData()
	{
		$search = array('harga_tvkabel', 'harga_iuran_sampah');
		$query = "SELECT * FROM harga ";
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
		
		$where = '';
		if( isset($_POST['search']['value'])) // if datatable send POST for search
        {
			foreach ($search as $k => $item) // loop column 
			{
				
				if($k == 0) // first loop
				{
					$where .= " WHERE (".$item." LIKE '%".$_POST['search']['value']."%'";
					
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
		$queryLimit = " ORDER BY harga_id DESC LIMIT ".$limit." OFFSET ".$offset."";
		$data = $this->db->query($queryRow.$queryLimit)->result_array();
		
		$dataTable = array(
                        "draw" => isset($_POST['draw']) ? $_POST['draw'] : '1',
                        "recordsTotal" => $recordsTotal,
                        "recordsFiltered" => $recordsFiltered,
                        "data" => $data,
                );
				
		if(!empty($dataTable))
		{
			foreach($dataTable['data'] as $k=>$v)
			{
				$dataTable['data'][$k]['harga_tvkabel'] = formatCurrency($v['harga_tvkabel']);
				$dataTable['data'][$k]['harga_iuran_sampah'] = formatCurrency($v['harga_iuran_sampah']);
				$dataTable['data'][$k]['harga_tgl_berlaku'] = $v['harga_tgl_berlaku'] != '0000-00-00' ? formatDate($v['harga_tgl_berlaku'], 'd-m-Y') : '-';
				$dataTable['data'][$k]['harga_tgl_berakhir'] = $v['harga_tgl_berakhir'] != '0000-00-00' ? formatDate($v['harga_tgl_berakhir'], 'd-m-Y') : 's/d sekarang';
			}
		}
		echo json_encode($dataTable);
	}
	
	function save()
	{
		$data['harga_tvkabel'] = str_replace(",","",$_POST['harga_tvkabel']);
		$data['harga_iuran_sampah'] = str_replace(",","",$_POST['harga_iuran_sampah']);
		$data['harga_tgl_berlaku'] = formatDate($_POST['harga_tgl_berlaku'], 'Y-m-d');
		
		//get Last Harga
		$row = $this->db->get_where('harga', array('harga_is_deleted' => '0'))->row();
		if( ($row->harga_tgl_berlaku == $data['harga_tgl_berlaku']) && ($row->harga_tvkabel == $data['harga_tvkabel']) && ($row->harga_iuran_sampah == $data['harga_iuran_sampah']) )
		{
			//do nothing
		}else{
			//Update Yang Lama 
			//Tgl Berakhir yang lama adalah 1 bulan sebelum tgl yang baru
			$dtUpdate['harga_tgl_berakhir'] = date('Y-m-d', strtotime("-1 month", strtotime($data['harga_tgl_berlaku'])));
			$dtUpdate['harga_is_deleted'] = '1';
			
			$this->db->where('harga_id', $row->harga_id);
			$this->db->update('harga', $dtUpdate);
			
			//insert Baru
			$data['harga_tgl_berakhir'] = '0000-00-00';
			$this->db->insert('harga', $data);
		}
		
		
		redirect($this->ctrl);
	}
	
	
}
