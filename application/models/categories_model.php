<?php

class Categories_model extends CI_Model {
	
	private  $categories = array(
					'items' => array(),
					'parents' => array()
					);
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function getCats(){
		
		$this->db
			->select('*')
			->from('bc_categories')
			->where('active = 1');

		$query = $this->db->get();
		
		foreach($query->result_array() as $cat)
		{
			$this->categories['items'][$cat['id']] = $cat;
			$this->categories['parents'][$cat['parent']][] = $cat['id'];
		}
		
		return $this->categories; 
		
	}
	
}
