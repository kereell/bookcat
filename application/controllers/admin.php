<?php
class Admin extends CI_Controller {
	
	public function __construct() {

		parent::__construct();
		
		 if(!$this->session->userdata('loggedIn'))
		{
			$this->logout();
		} 
	
	}
	
	public function index()
	{

		$data['user'] = $this->session->userdata;
		$this->load->view('catalogue_admin', $data);
		
	}
	
	public function logout(){
		
		$this->session->sess_destroy();
		redirect('catalogue');
		exit;
		
	}
	
}