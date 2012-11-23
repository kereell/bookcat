<?php

class Catalogue extends CI_Controller {

	public $menu = array(
			'items' => array(),
			'parents' => array()
			);
	
	public function __construct(){

		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->model('categories_model');
		$this->load->library('categories');
		
		$cats = $this->categories_model->getCats();
		
		
		foreach($cats as $cat){
				
			$this->menu['items'][$cat['id']] = $cat;
			$this->menu['parents'][$cat['parent']][] = $cat['id'];
				
		}
		
		$data['categories'] = Categories::build(0, $this->menu);
		$data['user'] = $this->session->userdata;
		
		if(isset($_GET['cat']))
		{
			$data['books'] = $this->catalogue_model->getBookByCat($_GET['cat']);
		} else {
				$data['books'] = $this->catalogue_model->getBooks();
				}
		
			/** TPL LOAD  **/
		$this->load->view('catalogue_user', $data);
		
	}
	
	public function search(){
		
		
		$trimmed = trim($_GET['q']);
		
		$data['cats'] = $this->catalogue_model->getAllCats();
		$data['books'] = $this->catalogue_model->getBookBySearch($trimmed);
		
		/** TPL LOAD  **/
		$this->load->view('catalogue_user', $data);
	
	}
	
	public function test(){

	//	header('Content-type: text/html; charset=utf8');
		
		
		
	}
	
}