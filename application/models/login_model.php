<?php

class Login_model extends CI_Model{
	
	public function __construct() {

		parent::__construct();
	
	}
	
	public function checkUser($login, $passwd){
		
		$this->load->library('hash');
		
		$safe_login = $this->db->escape($login);
		
		$this->db->select('id, login, name, email, role');
		$this->db->from('bc_users');
		$this->db->where('login = '.$safe_login.' AND pass = "'.$passwd.'" AND active = 1');
		
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
}
