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
	
	public function getBookById($id)
	{	
		$item = (int)$id;
		$this->db
			->select($this->commonGetStmt(),FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
			->where('t1.id = '.$item);
		
		$query = $this->db->get();
	
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
	
	public function updateBook($id, array $data)
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
	
	public function deleteBook($id)
	{
		$item = (int)$id;
		
		$this->db
			->where('id', $item)
			->delete('bc_books');
		
		return $this->db->affected_rows();
	}


	public function rateUp($id)
	{
		$item = (int)$id;
		$this->db
		->set('rate', 'rate+1', FALSE)
		->where('id', $item)
		->update('bc_books');
	
		if($this->db->affected_rows()){
			$this->db->select('id, rate');
			$query = $this->db->get_where('bc_books', array('id' => $item));
			$result = $query->row();
		} else {
			$result = FALSE;
		}
	
		return $result;
	}
	
	public function rateDown($id)
	{
		$item = (int)$id;
		$this->db
		->set('rate', 'rate-1', FALSE)
		->where('id', $item)
		->update('bc_books');
	
		if($this->db->affected_rows()){
			$this->db->select('id, rate');
			$query = $this->db->get_where('bc_books', array('id' => $item));
			$result = $query->row();
		} else {
			$result = FALSE;
		}
	
		return $result;
	}
	
	public function getAuthorList($off, $pp)
	{
		$this->db
			->select('SQL_CALC_FOUND_ROWS *', FALSE)
			->from('bc_authors')
			->limit($pp, $off);
	
		return $this->commonGetRslt($this->db->get());
	}
	
	public function getAllAuthors()
	{
		$this->db
			->select('*')
			->from('bc_authors');
		
		$query = $this->db->get();
		
		$res = $query->result();
		
		return $res;
	}
	
	public function getAuthorById($id)
	{
		$item = (int)$id;
		$this->db
			->select('*')
			->from('bc_authors')
			->where('id = '.$item);
	
		$query = $this->db->get();
	
		return $query->row();
	}
	
	public function insertAuthor($data)
	{
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db->insert('bc_authors');
	
		return $this->db->insert_id();
	}
	
	public function updateAuthor($id, array $data)
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
	
	public function deleteAuthor($id)
	{
		$item = (int)$id;
		$this->db
			->where('id', $item)
			->delete('bc_authors');
	
		return $this->db->affected_rows();
	}
	
	public function getCatList($off, $pp)
	{
		$this->db
			->select('SQL_CALC_FOUND_ROWS t1.id, t1.name, t1.active, t2.name AS parent', FALSE)
			->from('bc_categories AS t1')
			->join('bc_categories AS t2','t1.parent = t2.id','LEFT')
			->limit($pp, $off);
		
		return $this->commonGetRslt($this->db->get());
	}
	
	public function getAllCats()
	{//TODO optimize the query
		$this->db
			->select('*')
			->from('bc_categories')
			->where('id NOT IN (SELECT parent FROM bc_categories GROUP BY parent)');
		
		$query = $this->db->get();
		
		$res = $query->result();

		return $res;
	} 
	
	public function getParentCats()
	{ 
		$this->db
			->select('*')
			->from('bc_categories')
			->where('id NOT IN (SELECT id_category FROM bc_books GROUP BY id_category) AND parent = 0');

		$query = $this->db->get();
		
		$res = $query->result();

		return $res;
	} 
	
	public function getCatById($id)
	{
		$item = (int)$id;
		$this->db
			->select('*')
			->from('bc_categories')
			->where('id = '.$item);
	
		$query = $this->db->get();
	
		return $query->row();
	}
	
 	public function insertCat($data)
	{	
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}	
		$this->db->insert('bc_categories');
		
		return $this->db->insert_id();	
	}
	
	public function updateCat($id, array $data)
	{
		$item = (int)$id;
		
		foreach ($data as $key => $val){
			$this->db->set($key, $this->db->escape_str($val));
		}
		$this->db
			->where('id', $item)
			->update('bc_categories');
		
		return $this->db->affected_rows();	
	}
	
	public function deleteCat($id)
	{		
		$item = (int)$id;
		
		$this->db
			->where('id', $item)
			->delete('bc_categories');
		
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
		header('Content-type: text/html; charset=utf8');
		
		exit(__METHOD__.'<br /><pre>'.print_r($data,1).'</pre>');
	}
	
}