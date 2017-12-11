<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    function __construct() 
    {
        parent::__construct();
    }
  
	function get_all_users() 
	{
		return $this->db->select('*')->from('nt_users')
					->order_by('id_user','ASC')->get()->result_array();
	}
	
	
	function save()
	{
		$post = $_POST;
		if(!empty($post['id']) && $post['status_'] == 'update') 
		{
			//update
			$data = array(
						'nama' => $post['nama'],
						'email' => $post['email'],
						'username' => $post['username'],
						'password' => $this->encrypt->encode($post['password']),
						'tgl_create' => date("Y-m-d H:i:s"),
						'is_admin' => $post['is_admin'],
						'status' => $post['status'],
					);
			
			$this->db->where('id_user', $post['id']);
			$this->db->update('nt_users', $data);
			
			return 1;
			
		}else{
			//ceck availibility user_error
			$row = $this->db->get_where('nt_users', array('email' => $post['email']))->num_rows();
			$row_ = $this->db->get_where('nt_users', array('username' => $post['username']))->num_rows();
			if($row > 0 || $row_ > 0 )
			{
				return 0;
			}else
			{
				//add
				$data = array(
							'nama' => $post['nama'],
							'email' => $post['email'],
							'username' => $post['username'],
							'password' => $this->encrypt->encode($post['password']),
							'tgl_create' => date("Y-m-d H:i:s"),
							'is_admin' => $post['is_admin'],
							'status' => $post['status'],
						);
				
				$this->db->insert('nt_users', $data);
				
				return 1;
			}
			
		}
	}
	
}
