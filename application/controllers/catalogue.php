<?php

class Catalogue extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
	}
	
	public function index()
	{
		
		$data['user'] = $this->session->userdata;
		$data['cats'] = $this->catalogue_model->getAllCats();
		
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
	
}