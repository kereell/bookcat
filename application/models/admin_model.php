<?php

class Admin_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function getCatList()
	{
		$this->db->select('*');
		$this->db->from('bc_categories');
		
		$query = $this->db->get();
		
		$res = array(
				'count' => $query->num_rows(),
				'result' => $query->result());
		return $res;	
	}
	
	public function insertCat($data)
	{
	
	}
	
	public function EditCat($id)
	{
	
	}
	
	public function removeCat($id)
	{
	
	}
	
	public function getAuthorList()
	{
		$this->db->select('*');
		$this->db->from('bc_authors');
		
		$query = $this->db->get('');
		$res = array(
				'count' => $query->num_rows(),
				'result' => $query->result());
		return $res;
	}
	
	public function insertAuthor($data)
	{
	
	}
	
	public function EditAuthor($id)
	{
	
	}
	
	public function removeAuthor($id)
	{
	
	}
	
	public function getBookList($off,$pp)
	{
		$count = $this->db->get('bc_books');
		$query = $this->db->get('bc_books', $pp, $off);
		
		$res = array(
				'count' => $count->num_rows(),
				'result' => $query->result());
		return $res;	
	}
	
	public function insertBook($data)
	{
	
	}
	
	public function EditBook($id)
	{
	
	}
	
	public function removeBook($id)
	{
	
	}
	
}