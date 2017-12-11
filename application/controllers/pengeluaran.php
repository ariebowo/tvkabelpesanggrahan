<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengeluaran extends MY_Controller {
	
	private $ctrl;
	var $dateRange;
	
    public function __construct() {
        parent::__construct();
		
		$this->dateRange = array(
								'date_start' => date('Y-m-01'),
								'date_end' => date('Y-m-d'),
							);
		
    }
	
	function index()
	{
		$start = date('m/d/Y', strtotime($this->dateRange['date_start']));
		$end = date('m/d/Y', strtotime($this->dateRange['date_end']));
		
		$row['dateRange'] = $start. ' - '. $end;
		
		$cnf = array(
					'content' => $this->load->view('content/pengeluaran', $row , true),
					'custom_js' => 'pengeluaran.js'
				);
		
		$this->render($cnf);
	}
	
	function listData()
	{
		$search = array('keterangan');
		$query = "SELECT * FROM pengeluaran ";
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
		
		$start = $this->dateRange['date_start'];
		$end = $this->dateRange['date_end'];
		
		#echoPre($_POST);
		
		if(isset($_POST['dateRange']))
		{
			
			$date = explode("-", trim($_POST['dateRange']));
			$start = date('Y-m-d', strtotime($date[0]));
			$end = date('Y-m-d', strtotime($date[1]));
			
			#echoPre($start);
			#echoPre($end);
		}
		
		$query .=" WHERE tanggal >= '$start' AND tanggal <= '$end' ";
		
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
		$queryLimit = " ORDER BY tanggal DESC LIMIT ".$limit." OFFSET ".$offset."";
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
				$v['tanggal'] = $this->load->view('box/pengeluaran/txt_name', $v, true);
				$v['total'] = 'Rp. '.formatCurrency($v['total']);
				$v['action'] = $this->load->view('box/pengeluaran/btn_action', $v, true);
				
				$dataTable['data'][$k] = $v;
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($dataTable);
	}
	
	function save()
	{
		$data = $_POST;
		
		if(!empty($_POST))
		{
			$dt = array(
						'tanggal' => date('Y-m-d', strtotime($data['tanggal'])),
						'keterangan' => $data['keterangan'],
						'total' => str_replace(",","",$data['total']),
						
						);
			
			if( isset($_POST['id']) && $_POST['id'] != '')
			{
				$this->db->where('id', $_POST['id']);
				$this->db->update('pengeluaran', $dt);
			}else{
				$this->db->insert('pengeluaran', $dt);
			}
			
			
			
		}
		
		redirect( base_url('pengeluaran'));
		
	}
	
	function delete($id)
	{
		
		$this->db->where('id', $id);
		$this->db->delete('pengeluaran');
		
		redirect( base_url('pengeluaran'));
	}
}
