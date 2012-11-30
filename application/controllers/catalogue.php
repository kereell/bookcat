<?php

class Catalogue extends CI_Controller {

	private  $menu = array(
				'items' => array(),
				'parents' => array()
				);
	
	public function __construct(){

		parent::__construct();
		$this->load->model('categories_model','cat_mdl');
		$this->load->library('categories');
		
	}
	
	public function index()
	{	
		$cats = $this->cat_mdl->getCats();
		foreach($cats as $cat){
			$this->menu['items'][$cat['id']] = $cat;
			$this->menu['parents'][$cat['parent']][] = $cat['id'];		
		}
			
			/** TPL DATA  **/
		$data['categories'] = Categories::build(0, $this->menu);
		$data['user'] = $this->session->userdata;
			
			/** TPL LOAD  **/
		$this->load->view('catalogue_view', $data);
		
	}
	
	public function books(){
		
		if(isset($_GET['cat']))
			$data['books'] = $this->catalogue_model->getBookByCat($_GET['cat']);
		else {
			$offset = (int)$this->uri->segment(3, 0);
			$list = $this->catalogue_model->getBooks($offset, PER_PAGE);
			$data['books'] = $list['result'];
			$data['paginator'] = $this->_paginator('/catalogue/books', $list['count'], PER_PAGE);
		}
		
		$this->load->view('content_view', $data);
		
	}
	
	
	public function search(){
		
		
		$trimmed = trim($_GET['q']);
			
			/** TPL DATA  **/
		$data['cats'] = $this->cat_mdl->getAllCats();
		$data['books'] = $this->catalogue_model->getBookBySearch($trimmed);
			
			/** TPL LOAD  **/
		$this->load->view('catalogue_view', $data);
	
	}
	
	public function test(){

		header('Content-type: text/html; charset=utf8');
		echo __METHOD__;
		
	}
	
	private function _paginator($uri, $total, $pp, $nlinks=2)
	{
		$this->load->library('pagination');
	
		$config['base_url'] = base_url($uri);
		$config['total_rows'] = $total;
		$config['per_page'] = $pp;
		$config['num_links'] = $nlinks;
	
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<span class="next">&nbsp;';
		$config['next_tag_close'] = '</span>';
	
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<span class="prev">&nbsp;';
		$config['prev_tag_close'] = '</span>';
	
		$this->pagination->initialize($config);
	
		return $this->pagination->create_links();
	}
	
}