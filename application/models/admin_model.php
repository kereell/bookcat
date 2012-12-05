<?php

class Admin_model extends CI_Model {
	
	public function __construct()
	{	
		
		parent::__construct();
			
	}
	
	
	public function getBookList($off, $pp)
	{
		$this->db
			->select($this->commonGetStmt(),FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
			->limit($pp, $off);
	
		return $this->commonGetRslt($this->db->get());
	}
	
	public function getBooksById($id)
	{	
		$item = (int)$id;
		$this->db
			->select($this->commonGetStmt(),FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
			->where('t1.id = '.$item);
		
		$query = $this->db->get('');
	
		return $query->row();
	}
	
	public function insertBook($data)
	{
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db->insert('bc_books');
		
		return $this->db->insert_id();
		
	}
	
	public function editBook($id, array $data)
	{
		$item = (int)$id;
		
		foreach ($data as $key => $val){	
			$this->db->set($key, $this->db->escape_str($val));
		}	
		$this->db
			->where('id', $item)
			->update('bc_books');
			
		return $this->db->affected_rows();
	}
	
	public function removeBook($id)
	{
		$item = (int)$id;
		
		$this->db
			->where('id', $item)
			->delete('bc_books');
		
		return $this->db->affected_rows();
		
	}
	
	public function getCatList()
	{
		$this->db
			->select('*')
			->from('bc_categories');
	
		$query = $this->db->get();
	
		$res = array(
				'count' => $query->num_rows(),
				'result' => $query->result());
		return $res;
	}
	
	public function insertCat($data)
	{	
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}	
		$this->db->insert('bc_categories');
		
		return $this->db->insert_id();	
	}
	
	public function editCat($id, array $data)
	{
		$item = (int)$id;
		
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db
			->update('bc_categories')
			->where('id', $item);
		
		
		return $this->db->affected_rows();	
	}
	
	public function removeCat($id)
	{		
		$item = (int)$id;
		
		$this->db
			->where('id', $item)
			->delete('bc_categories');
		
		return $this->db->affected_rows();
		
	}
	
	public function getAuthorList()
	{
		$this->db
			->select('*')
			->from('bc_authors');
	
		$query = $this->db->get('');
		$res = array(
				'count' => $query->num_rows(),
				'result' => $query->result());
		return $res;
	}
	
	public function insertAuthor($data)
	{
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db->insert('bc_authors');
		
		return $this->db->insert_id();
		
	}
	
	public function editAuthor($id)
	{
		$item = (int)$id;
		
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db
			->where('id', $item)
			->update('bc_authors');
		
		return $this->db->affected_rows();
		
	}
	
	public function removeAuthor($id)
	{
		$item = (int)$id;
		$this->db
			->where('id', $item)
			->delete('bc_authors');
		
		return $this->db->affected_rows();
	}
	
	
	private function commonGetStmt()
	{
		return 'SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.description,
				t1.id_author, t1.id_category, t1.rate, t1.img, t1.active, t1.date, t2.id AS author_id, t2.name AS author, t3.id AS cat_id, t3.name AS category';
	
	}
	
	private function commonGetRslt($query)
	{
		$found = $this->db->query('SELECT FOUND_ROWS() AS count');
		$rows = $found->row();
	
		$res = array(
				'count' => $rows->count,
				'result' => $query->result());
	
		return $res;
	}
	
	private function debug(array $data)
	{
		return __METHOD__.'<br /><pre>'.print_r($data,1).'</pre>';
	}
	
}