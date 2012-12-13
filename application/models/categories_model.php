<?php

class Categories_model extends CI_Model {
	
	private  $categories = array(
					'items' => array(),
					'parents' => array()
					);
	
	public function __construct()
	{
		
		parent::__construct();
		
	}
	
	public function getCats()
	{
		
		$this->db
			->select('*')
			->from('bc_categories')
			->where('active = 1');

		$query = $this->db->get();
		$categories = array();
		foreach($query->result_array() as $cat)
		{
			$categories['items'][$cat['id']] = $cat;
			$categories['parents'][$cat['parent']][] = $cat['id'];
		}
		
		return $categories; 
			
	}
	
	public function __destruct(){
//		$this->categories = Null;
	}
	
}
