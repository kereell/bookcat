<?php

class Catalogue_model extends CI_Model{
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	public function getBooks($off, $pp, $cat=0, $search=NULL)
	{
		$this->db
			->select('SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.description, 
					t1.id_author, t1.id_category, t1.rate, t1.img, t2.name AS author',FALSE)
			->from('bc_books AS t1')
			->join('bc_authors AS t2', 't1.id_author = t2.id', 'LEFT')
			->limit($pp, $off);
		
		switch (TRUE)
		{
			case $cat:
				$this->db->where('t1.id_category = '.$cat.' AND t1.active = 1');
				break;
			case $search:
				$str = $this->db->escape_like_str($search);
				$this->db
					->like('t1.title', $str)
					->or_like('t1.description', $str)
					->or_like('t2.name', $str);
				break;
			default:
				$this->db->where('t1.active = 1');
				break;
		}
		
		$query = $this->db->get();
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
	
}
