<?php
class Admin extends CI_Controller {
	
	public function __construct() {

		parent::__construct();
		
		 if(!$this->session->userdata('loggedIn')){
			$this->logout();
			} 
		
		$this->load->model('admin_model','model');
	}
	
	public function index(){
		$this->books();	
	}
	
	public function books()
	{
		switch (@$_GET['act']){
			case 'add':
				$this->_addStuff();
				break;
			case 'edit':
				$this->_editStuff();
				break;
			case 'remove':
				$this->removeStuff();
				break;
			default:
				$offset = (int)$this->uri->segment(3, 0);
				$list = $this->model->getBookList($offset, PER_PAGE);			
					
					/** TPL DATA LOAD **/
				$data['user'] = $this->session->userdata;
				$data['books'] = $list['result'];
				$data['paginator'] = $this->_paginator('admin/books', $list['count'], PER_PAGE);
				$this->load->view('admin_view', $data);
		}
		
	}
	
	public function authors()
	{
	
		switch (@$_GET['act']){
			case 'add':
				$this->_addStuff();
				break;
			case 'edit':
				$this->_editStuff();
				break;
			case 'remove':
				$this->removeStuff();
				break;
			default:
				$offset = (int)$this->uri->segment(3, 0);
				$list = $this->model->getAuthorList($offset, PER_PAGE);
					
				/** TPL DATA LOAD **/
				$data['user'] = $this->session->userdata;
				$data['authors'] = $list['result'];
				$data['paginator'] = $this->_paginator('admin/authors', $list['count'], PER_PAGE);
				$this->load->view('admin_view', $data);
				
		}
	}
	
	public function cats()
	{
		
		switch (@$_GET['act']){
			case 'add':
				$this->_addStuff();
				break;
			case 'edit':
				$this->_editStuff();
				break;
			case 'remove':
				$this->removeStuff();
				break;
			default:
				$list = $this->model->getCatList();
					
				/** TPL DATA LOAD **/
				$data['user'] = $this->session->userdata;
				$data['cats'] = $list['result'];
				$data['paginator'] = $this->_paginator('admin/authors', $list['count'], PER_PAGE);
				$this->load->view('admin_view', $data);
		}
	}
	
	public function logout()
	{
		
		$this->session->sess_destroy();
		redirect('catalogue');
		exit;
		
	}
	
	private function _addStuff($stuff){
		
		echo 'add';
		
	}
	
	private function _editStuff($stuff){
		
		echo 'edit';
	
	}
	
	private function removeStuff($stuff){

		echo 'remove';
	}
	
	private function _paginator($uri, $total, $pp, $nlinks=2)
	{	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url($uri);
		$config['total_rows'] = $total;
		$config['per_page'] = $pp;
		$config['num_links'] = $nlinks;
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<div class="next">';
		$config['next_tag_close'] = '</div>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<div class="previous">';
		$config['prev_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		return $this->pagination->create_links();
	}
	
}