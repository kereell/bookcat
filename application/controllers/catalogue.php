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
		redirect('catalogue/listing');
	}
	
	public function rate()
	{	
		$item = abs((int)$_POST['id']);
		$action = $_POST['act'];
		 
		switch ($action)
		{
			case 'rateUp':
				
				$rate = $this->model->rateUp($item);
				break;
			
			case 'rateDown':
				$rate = $this->model->rateDown($item);
				break;
			
			default:
				exit('unknown action');
				break;
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($rate));
	}

	public function test()
	{
		
		$this->load->view('user/layouts/test');
			
	} 
	
	public function listing()
	{
		$content = $this->getBooks();
		$cats = $this->cats();
		$userdata = $this->session->userdata;
			
			/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Каталог';
		$data['categories'] = $cats;
		$data['content'] = $content;
			
			/** TPL LOAD **/
		$this->load->view('user/catalogue_view', $data);
	}

	public function categories()
	{
		$content = $this->getBooksByCat();
		$cats = $this->cats();
		$userdata = $this->session->userdata;
			
		/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Каталог';
		$data['categories'] = $cats;
		$data['content'] = $content;
			
		/** TPL LOAD **/
		$this->load->view('user/catalogue_view', $data);
	}

	public function search()
	{
		$content = $this->searchBooks();		
		$cats = $this->cats();
		$userdata = $this->session->userdata;
			
		/** TPL DATA **/
		$data['user'] = $userdata;
		$data['title'] = 'Каталог';
		$data['categories'] = $cats;
		$data['content'] = $content;
			
		/** TPL LOAD **/
		$this->load->view('user/catalogue_view', $data);
	}
	
	private function getBooks()
	{
		$page = abs((int)$this->uri->segment(3, 1));
		$offset = ($page - 1) * PER_PAGE;
		$list = $this->model->getBooks($offset, PER_PAGE);
		$paginator = $this->paginator('/catalogue/listing/', $list['count'], 3);
			
			/** TPL DATA **/
		$data['cont'] = $list['result'];
		$data['paginator'] = $paginator; 
		
			/** TPL LOAD **/
		$content = $this->load->view('user/layouts/bookContent', $data, true);
		
		return $content;
	}
	
	private function getBooksByCat()
	{
		$cat = abs((int)$this->uri->segment(3, 0));
		$page = abs((int)$this->uri->segment(4, 1));
		$offset = ($page - 1) * PER_PAGE;
		
		$list = $this->model->getBooksByCat($offset, PER_PAGE, $cat);
		$paginator = $this->paginator('/catalogue/categories/'.$cat, $list['count'], 4);
		$breadcrumbs = $this->breadcrumbs($cat);
		
		if($list['count'] >0){
			$cont = $list['result'];
			$layout = 'bookContent';
		} else {
				$cont = $this->model->getCatsByParent($cat);
				$layout = 'catContent';
			}
		/** TPL DATA **/
		$data['crumbs'] = $breadcrumbs;
		$data['cont'] = $cont;
		$data['paginator'] = $paginator;
			
		/** TPL LOAD **/
		$content = $this->load->view('user/layouts/'.$layout, $data, true);
		
		return $content;	
	}
	
	private function searchBooks()
	{
		//TODO SANATIZE GET
		$search = $_GET['q'];
		$page = abs((int)$this->uri->segment(3, 1));
		$offset = ($page - 1) * PER_PAGE;
		
		$list = $this->model->getBooksBySearch($offset, 2, $search);
		$paginator = $this->paginator('/catalogue/search/', $list['count'], 3);
		$books = array();
		
		foreach($list['result'] as $val)
		{
			$books[$this->breadcrumbs($val->id_category)][] = $val;
		}

			/** TPL DATA **/
		$data['books'] = $books;
		$data['paginator'] = $paginator;
					
			/** TPL LOAD **/
		$cont = $this->load->view('user/layouts/searchContent', $data, true);
		
		return $cont;
	}
	
	private function cats()
	{	
		$cats = $this->cats_model->getCats();
		
		return Categories::buildCats(0, $cats);
	}
	
	private function breadcrumbs($key)
	{
		$cats = $this->cats_model->getCats();
	
		return Categories::buildBreadCrumbs($cats, $key, __CLASS__);
	}
	
	private function paginator($uri, $total, $uri_segment)
	{
		$this->load->library('pagination');
	
		$config['base_url'] = base_url($uri);
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total;
		$config['per_page'] = PER_PAGE;
		$config['num_links'] = 1;
		$config['use_page_numbers'] = TRUE;
	
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<span class="next">&nbsp;';
		$config['next_tag_close'] = '</span>';
	
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<span class="prev">&nbsp;';
		$config['prev_tag_close'] = '</span>';
	
		$this->pagination->initialize($config);
	
		return $this->pagination->create_links();
	}
	
	private function debugArr(array $data)
	{
		header('Content-type: text/html; charset=utf8');
	
		exit(__METHOD__.'<br /><pre>'.print_r($data,1).'</pre>');
	}
	
	private function debugStr($data)
	{
		header('Content-type: text/html; charset=utf8');
	
		exit(__METHOD__.'<br /><pre>'.$data.'</pre>');
	}
	
}