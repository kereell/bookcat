<?php

class Categories_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function getCats(){
		
		$this->db->select('*');
		$this->db->from('bc_categories');
		$this->db->where('active = 1');

		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
}
