<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Semester_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    function __construct() 
    {
        parent::__construct();
    }
  
	function get_all_semester() 
	{
		return $this->db->select('*')->from('nt_semester')
					->order_by('id_semester','ASC')->get()->result_array();
	}

}
