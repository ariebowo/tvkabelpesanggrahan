<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skripsi_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    function __construct() 
    {
        parent::__construct();
    }
  
	function get_all_skripsi() 
	{
		return $this->db->select('*')->from('nt_skripsi')
					->join('nt_dosen', 'nt_dosen.id_dosen = nt_skripsi.dosen_pembimbing_id', 'left')
					->order_by('id_skripsi','ASC')->get()->result_array();
	}
	
	function get_bdang_ilmu() 
	{
		return $this->db->select('*')->from('nt_bidang_ilmu')->order_by('id','ASC')->get()->result_array();
	}
	
	function get_skripsi($where)
	{
		return $this->db->select('*')->from('nt_skripsi')
					->join('nt_dosen', 'nt_dosen.id_dosen = nt_skripsi.dosen_pembimbing_id', 'left')
					->where('id_skripsi', $where)
					->get()->row();
	}
}
