<?php
class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		 if(!$this->session->userdata('loggedIn')){
			$this->logout();
			} 
		
		$this->load->model('admin_model','model');
	}
	
	public function index()
	{

		redirect('admin/books');
		
	}
	
	public function books()
	{
		$offset = (int)$this->uri->segment(3, 0);
		$action = isset($_GET['act']) ? $_GET['act'] : '';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		switch($action)
		{
			case 'edit':
				$content = $this->editBooks($id);
				break;
			case 'remove':
				$content = $this->removeBooks($id);
				break;
			default:
				$content = $this->getBooks($offset);
				break;
		}	
			/** TPL DATA **/
		$data['content'] = $content;
		$data['user'] = $this->session->userdata;
			
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
	}
	
	public function authors()
	{
		$offset = (int)$this->uri->segment(3, 0);
		$action = isset($_GET['act']) ? $_GET['act'] : '';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		switch($action)
		{
			case 'edit':
				$content = $this->editAuthors($id);
				break;
			case 'remove':
				$content = $this->removeAuthors($id);
				break;
			default:
				$content = $this->getAuthors($offset);
				break;
		}	
			/** TPL DATA **/
		$data['content'] = $content;
		$data['user'] = $this->session->userdata;
			
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
	}
	
	public function cats()
	{
		$offset = (int)$this->uri->segment(3, 0);
		$action = isset($_GET['act']) ? $_GET['act'] : '';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		
		switch($action)
		{
			case 'edit':
				$content = $this->editCats($id);
				break;
			case 'remove':
				$content = $this->removeCats($id);
				break;
			default:
				$content = $this->getCats($offset);
				break;
		}
			/** TPL DATA **/
		$data['content'] = $content;
		$data['user'] = $this->session->userdata;
						
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
	}
	
	private function getBooks($offset)
	{
		$list = $this->model->getBookList($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['books'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/books', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/booksContent', $data, TRUE);

		return $content;		
	}
	
	private function editBooks($id)
	{
		if(isset($_POST['sBtn']))
		{
		
			$content =	print_r($_POST,1);
		
		} else {

			
			$book = $this->model->getBooksById($id);
			$authors = $this->model->getAuthorList();
			$cats = $this->model->getCatList();
			
				/** TPL DATA **/
			$data['book'] = $book;
			$data['authors'] = $authors['result']; 
			$data['cats'] = $cats['result'];
			/* header('Content-type: text/html; charset=utf8');
			$content =	print_r($data['authors'],1); */
			
				
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/booksAddEdit', $data, TRUE);
		
		}
		
		return $content;
		
	}
	
	private function removeBooks($id)
	{
	
	}
	
	private function getAuthors($offset)
	{
		$list = $this->model->getAuthorList($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['authors'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/authors', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/authorsContent', $data, TRUE);
		
		return $content;
	}
	
	private function editAuthors($id)
	{
	
	}
	
	private function removeAuthors($id)
	{
	
	}
	
	private  function getCats($offset)
	{			
		$list = $this->model->getCatList($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['cats'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/cats', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/catsContent', $data, TRUE);
		
		return $content;
	}
	
	private function editCats($id)
	{
	
	}
	
	private function removeCats($id)
	{
	
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
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('catalogue');
		exit;
	}
	
	public function test()
	{
	
		header('Content-type: text/html; charset=utf8');
		echo 'test';
	
	}
	
}