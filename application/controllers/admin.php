<?php
class Admin extends CI_Controller {
	
	public function __construct() {

		parent::__construct();
		
		 if(!$this->session->userdata('loggedIn'))
		{
			$this->logout();
		} 
		
		$this->load->model('admin_model','model');
	
	}
	
	public function index()
	{

		$data['books'] = $this->model->getBookList();
			
			/** TPL DATA LOAD **/
		$data['user'] = $this->session->userdata;
		$this->load->view('catalogue_admin', $data);
		
	}
	
	public function authors()
	{
	
		$data['authors'] = $this->model->getAuthorList();
			
		/** TPL DATA LOAD **/
		$data['user'] = $this->session->userdata;
		$this->load->view('catalogue_admin', $data);
	
	}
	
	public function cats()
	{
	
		$data['cats'] = $this->model->getCatList();
			
		/** TPL DATA LOAD **/
		$data['user'] = $this->session->userdata;
		$this->load->view('catalogue_admin', $data);
	
	}
	
	public function logout()
	{
		
		$this->session->sess_destroy();
		redirect('catalogue');
		exit;
		
	}
	
}