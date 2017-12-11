<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan extends MY_Controller {
	
	private $ctrl;
	
    public function __construct() {
        parent::__construct();
		$this->ctrl = base_url().'pelanggan/';
		
    }
	
	public function index()
	{
		$row['rt'] = $this->RT;
		$row['rw'] = $this->RW;
		$row['url'] = $this->ctrl;
		
		$cnf = array(
					'content' => $this->load->view('content/pelanggan', $row, true),
					'custom_js' => 'pelanggan.js'
				);
		
		$this->render($cnf);
	}
	
	function listData()
	{
		$search = array('pelanggan_nama', 'pelanggan_alamat', 'pelanggan_rt', 'pelanggan_rw');
		$query = "SELECT * FROM pelanggan WHERE pelanggan_is_deleted = '0' ";
		$limit = isset($_POST['length']) ? $_POST['length'] : 10;
		$offset = isset($_POST['start']) ? $_POST['start'] : 0;
        
		$where = '';
		
		if( isset($_GET['rt']) && $_GET['rt'] != '-')
		{
			$where .= " AND pelanggan_rt = '".$_GET['rt']."'";
		}
		if( isset($_GET['rw']) && $_GET['rw'] != '-')
		{
			$where .= " AND pelanggan_rw = '".$_GET['rw']."'";
		}
		
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
				$dataTable['data'][$k]['action'] = '<a href="'.base_url('pelanggan/edit/'.$v['pelanggan_id']).'" class="btn btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</a><a class="btn btn-flat btn-danger btn-del" data-url="'.base_url('pelanggan/delete/'.$v['pelanggan_id']).'"><i class="fa fa-close"></i> Hapus</a>';
			}
		}
		echo json_encode($dataTable);
	}
	
	public function add()
	{
		$this->buildInput();
	}
	
	public function edit( $id )
	{
		if(!$id) show_404();
		
		$row = $this->db->get_where('pelanggan', array('pelanggan_id' => $id))->row();
		$this->buildInput('update', $row);
	}
	
	function save()
	{
		$data['pelanggan_nama'] = $_POST['pelanggan_nama'];
		$data['pelanggan_alamat'] = $_POST['pelanggan_alamat'];
		$data['pelanggan_rt'] = $_POST['pelanggan_rt'];
		$data['pelanggan_rw'] = $_POST['pelanggan_rw'];
		$data['pelanggan_tgl_mulai_berlangganan'] = date('m/d/Y', strtotime($_POST['pelanggan_tgl_mulai_berlangganan']));
		$data['pelanggan_tvkabel'] = isset($_POST['pelanggan_tvkabel']) ? $_POST['pelanggan_tvkabel'] : '0';
		$data['pelanggan_sampah'] = isset($_POST['pelanggan_sampah']) ? $_POST['pelanggan_sampah'] : '0';
		
		if(!empty($_POST['id']) && $_POST['mode'] == 'update') 
		{
			$this->db->where('pelanggan_id', $_POST['id']);
			$this->db->update('pelanggan', $data);
		
		}else{
			$this->db->insert('pelanggan', $data);
			
		}
		
		redirect($this->ctrl);
	}
	
	function delete( $id )
	{
		$this->db->where('pelanggan_id', $id);
		$this->db->update('pelanggan', array('pelanggan_is_deleted' => '1'));
		redirect($this->ctrl);
	}
	
	private function buildInput( $mode = 'add', $val='')
	{
		$data['mode'] = $mode;
		$data['data'] = $val;
		$data['rt'] = $this->RT;
		$data['rw'] = $this->RW;
		$content = $this->load->view('box/input-pelanggan', $data, true);
		
		$cnf = array('content' => $content, 'custom_js' => 'pelanggan.js');
		
		$this->render($cnf);
	}
	
}
