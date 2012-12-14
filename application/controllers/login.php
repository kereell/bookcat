<?php

class Login extends CI_Controller {
	
	public function __construct() 
	{	
		parent::__construct();
		
		$this->load->library('Hash');
		$this->load->library('form_validation');
		$this->load->model('login_model','model');
	}
	
	public function index()
	{	
	if ($this->form_validation->run('login') == FALSE)
		{
			redirect('catalogue');
		} else {
				redirect('admin');
			}
		
	}
	
	public function _hash_create($passwd)
	{
		return Hash::create($passwd);
	}
	
	public function _check_auth($passwd, $login)
	{
		$user = $this->model->checkUser($_POST[$login], $passwd);
		
		if(!empty($user)){
			$this->session->set_userdata(array(
					'loggedIn' => TRUE,
					'name' => $user->name,
					'email' => $user->email,
					'role' => $user->role
					));
			
			return TRUE;
		}
		return FALSE;
	}
	
}
