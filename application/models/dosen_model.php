<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    function __construct() 
    {
        parent::__construct();
    }
  
	function get_all_dosen() 
	{
		return $this->db->select('*')->from('nt_dosen')
					->join('nt_bidang_ilmu','bidang_ilmu_id = id')->order_by('id','ASC')->get()->result_array();
	}
	
	function get_dosen_byCat($where) 
	{
		return $this->db->select('*')->from('nt_dosen')->where('bidang_ilmu_id', $where)
					->join('nt_bidang_ilmu','bidang_ilmu_id = id')
					->get()->result_array();
	}
	
	function get_dosen($where)
	{
		return $this->db->select('*')->from('nt_dosen')->where('id_dosen', $where)
					->join('nt_bidang_ilmu','bidang_ilmu_id = id')
					->get()->row();
	}
	
	function get_bdang_ilmu() 
	{
		return $this->db->select('*')->from('nt_bidang_ilmu')->order_by('id','ASC')->get()->result_array();
	}
	
}
