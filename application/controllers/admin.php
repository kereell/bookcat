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
		$action = isset($_GET['act']) ? $_GET['act'] : 'all';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$userdata = $this->session->userdata;
		
		switch($action)
		{
			case 'edit':
				$content = $this->editBook($id);
				break;
			case 'add':
				$content = $this->addBook();
				break;
			case 'remove':
				$content = $this->removeBook($id);
				break;
			case 'all':
				$content = $this->getBooks($offset);
				break;
			case 'single':
				$content = $this->getBookById($id);
				break;
			default:
				$content = 'No such action';
				break;
		}
			
			/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Admin Area';
		$data['method'] = __FUNCTION__;
		$data['content'] = $content;
			
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
	}
	
	public function authors()
	{
		$offset = (int)$this->uri->segment(3, 0);
		$action = isset($_GET['act']) ? $_GET['act'] : 'all';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$userdata = $this->session->userdata;
		
		switch($action)
		{
			case 'edit':
				$content = $this->editAuthor($id);
				break;
			case 'add':
				$content = $this->addAuthor();
				break;
			case 'remove':
				$content = $this->removeAuthor($id);
				break;
			case 'all':
				$content = $this->getAuthors($offset);
				break;
			case 'single':
				$content = $this->getAuthorById($id);
				break;
			default:
				$content = 'No such action';
				break;
		}	
			/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Admin Area';
		$data['method'] = __FUNCTION__;
		$data['content'] = $content;
			
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
	}
	
	public function cats()
	{
		$offset = (int)$this->uri->segment(3, 0);
		$action = isset($_GET['act']) ? $_GET['act'] : 'all';
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$userdata = $this->session->userdata;
		
		switch($action)
		{
			case 'edit':
				$content = $this->editCat($id);
				break;
			case 'add':
				$content = $this->addCat();
				break;
			case 'remove':
				$content = $this->removeCat($id);
				break;
			case 'all':
				$content = $this->getCats($offset);
				break;
			case 'single':
				$content = $this->getCatById($id);
				break;
			default:
				$content = 'No such action';
				break;
		}

			/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Admin Area';
		$data['method'] = __FUNCTION__;
		$data['content'] = $content;
			
			/** TPL LOAD **/
		$this->load->view('admin/admin_view', $data);
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
	
	private function getBooks($offset)
	{
		$list = $this->model->getBookList($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['addTitle'] = ' :: Книги';
		$data['books'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/books', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/booksContent', $data, TRUE);

		return $content;		
	}
	
	private function getBookById($id)
	{
		$book[0] = $this->model->getBookById($id);
			
		/** TPL DATA **/
		$data['addTitle'] = ' :: Книга :: '.$book[0]->title;
		$data['books'] = $book;
			
		/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/booksContent', $data, TRUE);
	
		return $content;
	}
	
	private function addBook()
	{
		if(isset($_POST['sBtn']))
		{
			$data = array_slice($_POST, 1,6);
				
			$ins = $this->model->insertBook($data);
			if($ins){
				redirect('admin/books?act=single&id='.$ins);
			} else {
				$content = 'Возникли проблеммы с добавлением книги: '.$data['name'];
			}
		} else {
			$authors = $this->model->getAllAuthors();
			$cats = $this->model->getAllCats();
				
			/** TPL DATA **/
			$data['addTitle'] = ' :: Книги :: Добавление';
			$data['action'] = 'add';
			$data['authors'] = $authors;
			$data['cats'] = $cats;
				
			/** TPL LOAD **/
			$content = $this->load->view('admin/layouts/booksAddEdit', $data, TRUE);
		}
	
		return $content;
	}
	
	private function editBook($id)
	{
		if(isset($_POST['sBtn']))
		{
			$data = $_POST;
			$id = (int)array_shift($data);
			array_pop($data);
			$upd = $this->model->updateBook($id, $data);
			
			if($upd){
				redirect('admin/books?act=single&id='.$id);
			} else {
					$content = 'Изменения для книги <strong>"'.$data['name'].'"</strong> не произведены.';
				}
		} else {
				$book = $this->model->getBookById($id);
				$authors = $this->model->getAllAuthors();
				$cats = $this->model->getAllCats();

					/** TPL DATA **/
				$data['addTitle'] = ' :: Книги :: Редактирование';
				$data['action'] = 'edit';
				$data['book'] = $book;
				$data['authors'] = $authors; 
				$data['cats'] = $cats;			
					
					/** TPL LOAD **/
				$content = $this->load->view('admin/layouts/booksAddEdit', $data, TRUE);
			}
			
		return $content;
	}
	
	private function removeBook()
	{
		$id = (int)$_GET['id'];
		if($id){
			$content = $this->model->deleteBook($id);
		}
		if($content){
			redirect('admin/books');
		} else {
				$content = 'Возникли проблеммы с удалением книги id: '.$id;
			}
		return $content;
	}
	
	private function getAuthors($offset)
	{
		$list = $this->model->getAuthorList($offset, PER_PAGE);

			/** TPL DATA **/
		$data['addTitle'] = ' :: Авторы';
		$data['authors'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/authors', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/authorsContent', $data, TRUE);
		
		return $content;
	}
		
	private function getAuthorById($id)
	{
		$author[0] = $this->model->getAuthorById($id);
	
		/** TPL DATA **/
		$data['addTitle'] = ' :: Автор :: '.$author[0]->name;
		$data['authors'] = $author;
					
		/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/authorsContent', $data, TRUE);
	
		return $content;
	}
	
	private function addAuthor()
	{
		if(isset($_POST['sBtn']))
		{
			$data = array_slice($_POST, 1, 2);				
			$ins = $this->model->insertAuthor($data);
			
			if($ins){
				redirect('admin/authors?act=single&id='.$ins);
			} else {
				$content = 'Возникли проблеммы с добавлением автора: '.$data['name'];
			}
		} else {				
				/** TPL DATA **/
			$data['addTitle'] = ' :: Авторы :: Добавление';
			$data['action'] = 'add';
				
				/** TPL LOAD **/
			$content = $this->load->view('admin/layouts/authorsAddEdit', $data, TRUE);
		}
		
		return $content;
	}
		
	private function editAuthor($id)
	{
		if(isset($_POST['sBtn']))
		{
			$data = $_POST;
			$id = (int)array_shift($data);
			array_pop($data);
			
			$upd = $this->model->updateAuthor($id, $data);
				
			if($upd){
				redirect('admin/authors?act=single&id='.$id);
			} else {
				$content = 'Изменения для автора <strong>"'.$data['name'].'"</strong> не произведены.';
			}
		} else {
			$author = $this->model->getAuthorById($id);
		
				/** TPL DATA **/
			$data['addTitle'] = ' :: Авторы :: Редактирование :: '.$author->name;
			$data['action'] = 'edit';
			$data['author'] = $author;
				
				/** TPL LOAD **/
			$content = $this->load->view('admin/layouts/authorsAddEdit', $data, TRUE);
		}
			
		return $content;
	}
	
	private function removeAuthor($id)
	{
		$id = (int)$_GET['id'];
		if($id){
			$content = $this->model->deleteAuthor($id);
		}
		if($content){
			redirect('admin/authors');
		} else {
			$content = 'Возникли проблеммы с удалением автора id: '.$id;
		}
		return $content;
	}
	
	private function getCats($offset)
	{			
		$list = $this->model->getCatList($offset, PER_PAGE);
			
			/** TPL DATA **/
		$data['addTitle'] = ' :: Категории';
		$data['cats'] = $list['result'];
		$data['paginator'] = $this->_paginator('admin/cats', $list['count'], PER_PAGE);
			
			/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/catsContent', $data, TRUE);
		
		return $content;
	}
	
	private function getCatById($id)
	{
		$cats[0] = $this->model->getCatById($id);
			
		/** TPL DATA **/
		$data['addTitle'] = ' :: Категория :: '.$cats[0]->name;
		$data['cats'] = $cats;
			
		/** TPL LOAD **/
		$content = $this->load->view('admin/layouts/catsContent', $data, TRUE);
		
		return $content;
	} 
	
	private function addCat()
	{
		if(isset($_POST['sBtn']))
		{
			$data = array_slice($_POST, 1, 3);
			$ins = $this->model->insertCat($data);
				
			if($ins){
				redirect('admin/cats?act=single&id='.$ins);
			} else {
				$content = 'Возникли проблеммы с добавлением категории: '.$data['name'];
			}
		} else {
			$categories = $this->model->getParentCats();
				
				/** TPL DATA **/
			$data['categories'] = $categories;
			$data['addTitle'] = ' :: Категории :: Добавление';
			$data['action'] = 'add';
	
				/** TPL LOAD **/
			$content = $this->load->view('admin/layouts/catsAddEdit', $data, TRUE);
		}
	
		return $content;
	}
	
	private function editCat($id)
	{
		if(isset($_POST['sBtn']))
		{
			$data = $_POST;
			$id = (int)array_shift($data);
			array_pop($data);
			$upd = $this->model->updateCat($id, $data);
				
			if($upd){
				redirect('admin/cats?act=single&id='.$id);
			} else {
				$content = 'Изменения для категории <strong>"'.$data['name'].'"</strong> не произведены.';
			}
		} else {
			$cat = $this->model->getCatById($id);
			$categories = $this->model->getParentCats();
			
				/** TPL DATA **/
			$data['addTitle'] = ' :: Категории :: Редактирование :: '.$cat->name;
			$data['action'] = 'edit';
			$data['cat'] = $cat;
			$data['categories'] = $categories;
				
				/** TPL LOAD **/
			$content = $this->load->view('admin/layouts/catsAddEdit', $data, TRUE);
			}
		
		return $content;
	}
	
	private function removeCat($id)
	{
		$id = (int)$_GET['id'];
		if($id){
			$content = $this->model->deleteCat($id);
		}
		if($content){
			redirect('admin/cats');
		} else {
			$content = 'Возникли проблеммы с удалением категории id: '.$id;
		}
		return $content;
	}
	
	private function _paginator($uri, $total, $pp, $nlinks=1)
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

	private function debug(array $data)
	{
		return __METHOD__.'<br /><pre>'.print_r($data,1).'</pre>';
	}
	
}