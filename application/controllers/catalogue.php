<?php

class Catalogue extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		
		$this->load->model('categories_model','cat_mdl');
		$this->load->library('categories');
		
	}
	
	public function index()
	{		
		$data['user'] = $this->session->userdata;
		
		$data['categories'] = $this->cats();
		$data['cont'] = $this->books();	
			
		$this->load->view('catalogue_view', $data);
	}
		
	
	public function test(){

		header('Content-type: text/html; charset=utf8');
		
		$arr = $this->cat_mdl->getCats();
		
		
		$var = 5;
		
		echo '<pre>';
//		print_r($tmp);
		echo '</pre>';
//		die;

		//echo __METHOD__;
		
	}
	
	private function books()
	{
		$cat = (int)$this->uri->segment(3, 0);
		$offset = (int)$this->uri->segment(4, 0);
		
		$search = isset($_GET['search']) ? $_GET['search'] : NULL; 
	
		$list = $this->catalogue_model->getBooks($offset, PER_PAGE, $cat, $search);
	
		$data['breadcrumbs'] = $this->breadcrumbs($cat);
		
		$data['books'] = $list['result'];
		$data['paginator'] = $this->_paginator('/catalogue/index/'.$cat, $list['count'], PER_PAGE);
	
		return $this->load->view('content_view', $data, true);
	}
	
	private function cats()
	{	
		$cats = $this->cat_mdl->getCats();
		
		return Categories::buildCats(0, $cats);
	}
	
	private function breadcrumbs($key)
	{
		$menu = $this->cat_mdl->getCats();
	
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
		
}