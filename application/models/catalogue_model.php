<?php

class Catalogue_model extends CI_Model{
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	public function getBooks()
	{
		
		$this->db->select('t1.id, t1.title, t1.description, t1.id_author, t1.id_category, t1.rate, t1.img, t2.name AS author');
		$this->db->from('bc_books AS t1');
		$this->db->join('bc_authors AS t2', 't1.id_author = t2.id');
		$this->db->where('t1.active = 1');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	public function getBookByCat($id)
	{
		
		$esc_id = (int)$id;
	
		$this->db->select('t1.id, t1.title, t1.description, t1.id_author, t1.id_category, t1.rate, t1.img, t2.name AS author');
		$this->db->from('bc_books AS t1');
		$this->db->join('bc_authors AS t2', 't1.id_author = t2.id');
		$this->db->where('t1.id ='.$esc_id.' AND t1.active = 1');
		
		$query = $this->db->get();
		
		return $query->result(); 
	
	}

	public function getBookBySearch($str)
	{
	
		$esc_str = $this->db->escape_like_str($str);
		
		$this->db->select('t1.id, t1.title, t1.description, t1.id_author, t1.id_category, t1.rate, t1.img, t2.name AS author');
		$this->db->from('bc_books AS t1');
		$this->db->join('bc_authors AS t2', 't1.id_author = t2.id');
		$this->db->like('title', $esc_str);
		$this->db->or_like('description', $esc_str);
		
		$query = $this->db->get();
		
		return $query->result();
		
	
	}
	
}