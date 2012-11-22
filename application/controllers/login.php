<?php

class Login extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('Hash');
		$this->load->model('login_model');
		
		if(!($_POST['login'] && $_POST['passwd']))
			redirect('catalogue');
		
	}
	
	public function Index(){
		
		//@TODO VALIDATE USER DATA
	
		$login = strtolower($_POST['login']);
		$passwd = Hash::create($_POST['passwd']);
		
		$user = $this->login_model->checkUser($login, $passwd);
		
		if(!empty($user))
		{
			$this->session->set_userdata(array(
					'loggedIn' => TRUE,
					'name' => $user->name,
					'email' => $user->email,
					'role' => $user->role
					));
			redirect('admin');
		} else {
			redirect('catalogue');
		}
		
	}
	
}
