<?php

class Catalogue_model extends CI_Model{
	
	public function __construct()
	{
		
		parent::__construct();
		
	}
	
	public function getBooks($off, $pp)
	{
		$this->db
			->select($this->commonStmt(),FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->where('t1.active = 1')
			->limit($pp, $off);
		
		return $this->commonRslt($this->db->get());
	}
	
	public function getBooksByCat($off, $pp, $cat)
	{	
		$this->db
			->select($this->commonStmt(),FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->where('t1.id_category = '.$cat.' AND t1.active = 1')
			->limit($pp, $off);
		
		return $this->commonRslt($this->db->get());	
	}

	public function getBooksBySearch($off, $pp, $search)
	{	
		$str = $this->db->escape_like_str($search);
		
		$this->db
			->select('SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.description, 
					t1.rate, t1.img, t1.id_category, t2.name AS author, t3.name AS category',FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->join('bc_categories AS t3', 't1.id_category = t3.id', 'LEFT')
			->like('t1.title', $str)
			->or_like('t1.description', $str)
			->or_like('t2.name', $str)
			->limit($pp, $off)
			->order_by('id_category','ASC');
		
		return $this->commonRslt($this->db->get());
	}

	public function getCatsByParent($cat)
	{
		$this->db
			->select('id, name')
			->from('bc_categories')
			->where('parent = '.$cat);
		
		$query = $this->db->get();
		
		$result = $query->result();
		
		return $result;
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
	
	private function commonStmt()
	{	
		return 'SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.description, 
				t1.id_category, t1.rate, t1.img, t2.name AS author';
		
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
	
	public function test(){
		
		$this->db
			->select('SQL_CALC_FOUND_ROWS *', FALSE)
			->where('id < 8')
			->limit(5,5);
		
		$query = $this->db->get('bc_books');
		$found_rows = $this->db->query('SELECT FOUND_ROWS() AS count');
				$calc = $found_rows->row();
				$count = $calc->count;
		
		return $count;
		
	}
	
	private function debug($data)
	{
		header('Content-type: text/html; charset=utf8');
	
		exit(__METHOD__.'<br /><pre>'.print_r($data,1).'</pre>');
	}
}
