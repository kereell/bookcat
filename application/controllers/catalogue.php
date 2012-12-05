<?php

class Catalogue extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('catalogue_model', 'model');
		$this->load->model('categories_model','cats_model');
		
		$this->load->library('categories');	
	}
	
	public function index()
	{		
		$cat = (int)$this->uri->segment(3, 0);
		$offset = (int)$this->uri->segment(4, 0);
		
		switch (TRUE){
			case $cat > 0:
				$cont = $this->booksCat($cat, $offset);
				break;
			
			case isset($_GET['search']):
				$cont = $this->searchBooks($offset, $_GET['search']);
				break;
			
			default:
				$cont = $this->booksAll($offset);
				break;
		}
		$cats = $this->cats();
		$userdata = $this->session->userdata;
		$paginator = $this->_paginator('/catalogue/index/'.$cat, $cont['total'], PER_PAGE);
		$breadcrumbs = $this->breadcrumbs($cat);
			
			/** TPL DATA **/
		$data['breadcrumbs'] = $breadcrumbs;
		$data['user'] = $userdata; 
		$data['title'] = 'Каталог';
		$data['categories'] = $cats;
		$data['cont'] = $cont['content'];
		$data['paginator'] = $paginator; 
			
			/** TPL LOAD **/
		$this->load->view('user/catalogue_view', $data);
	}
	
	
	private function booksAll($offset)
	{ 
		$list = $this->model->getBooks($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['books'] = $list['result'];
			
			/** TPL LOAD **/
		$cont = $this->load->view('user/layouts/content', $data, true);
		
		$res = array(
				'content' => $cont,
				'total' => $list['count']);
		
		return $res;
	}
	
	private function booksCat($cat, $offset)
	{
		$list = $this->model->getBooksByCat($offset, PER_PAGE, $cat);
		
			/** TPL DATA **/
		$data['books'] = $list['result'];
			
			/** TPL LOAD **/
		$cont = $this->load->view('user/layouts/content', $data, true);
		
		$res = array(
				'content' => $cont,
				'total' => $list['count']);
		
		return $res;	
	}
	
	private function searchBooks($offset, $search)
	{
		$list = $this->model->getBooksBySearch($offset, PER_PAGE, $search);
	
		/** TPL DATA **/
		$data['books'] = $list['result'];
			
		/** TPL LOAD **/
		$cont = $this->load->view('user/layouts/content', $data, true);
		
		$res = array(
				'content' => $cont,
				'total' => $list['count']);
		
		return $res;
	}
	
	private function cats()
	{	
		$cats = $this->cats_model->getCats();
		
		return Categories::buildCats(0, $cats);
	}
	
	private function breadcrumbs($key)
	{
		$menu = $this->cats_model->getCats();
	
		return Categories::buildBreadCrumbs($menu, $key, __CLASS__);
	}
	
	private function _paginator($uri, $total, $pp, $nlinks=2)
	{
		$this->load->library('pagination');
	
		$config['base_url'] = base_url($uri);
		$config['uri_segment'] = 4;
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

	public function test()
	{
	
		header('Content-type: text/html; charset=utf8');
		echo 'test';
	
	}
	
}