<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidangilmu_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    function __construct() 
    {
        parent::__construct();
    }
  
	function get_all_bdilmu() 
	{
		return $this->db->select('*')->from('nt_bidang_ilmu')->order_by('id','ASC')->get()->result_array();
	}
	
	function save() 
	{
		
	}
	
}
