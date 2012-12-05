<?php

class Admin_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function getBookList($off, $pp)
	{
		$this->db
		->select($this->commonStmt(),FALSE)
		->from('bc_books AS t1')
		->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
		->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
		->limit($pp, $off);
	
		return $this->commonRslt($this->db->get());
	}
	
	public function getBooksById($id)
	{	
		$this->db
		->select($this->commonStmt(),FALSE)
		->from('bc_books AS t1')
		->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
		->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
		->where('t1.id = '.$id);
		
		$query = $this->db->get('');
	
		return $query->row();
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
	
	
	private function commonStmt()
	{
		return 'SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.description,
				t1.id_author, t1.id_category, t1.rate, t1.img, t1.active, t1.date, t2.id AS author_id, t2.name AS author, t3.id AS cat_id, t3.name AS category';
	
	}
	
	private function commonRslt($query)
	{
		$found = $this->db->query('SELECT FOUND_ROWS() AS count');
		$rows = $found->row();
	
		$res = array(
				'count' => $rows->count,
				'result' => $query->result());
	
		return $res;
	}
	
}