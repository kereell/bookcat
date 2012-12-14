<?php

$config = array(
		'login' => array(
				array(
						'field' => 'login',
						'label' => 'Login',
						'rules' => 'required|strtolower|trim|xss_clean|htmlspecialchars'
				),
				array(
						'field' => 'passwd',
						'label' => 'Password',
						'rules' => 'required|callback__hash_create|callback__check_auth[login]'
				)
		),
		'addEditBook' => array(
				array(
						'field' => 'emailaddress',
						'label' => 'EmailAddress',
						'rules' => 'required|valid_email'
				),
				array(
						'field' => 'name',
						'label' => 'Name',
						'rules' => 'required|alpha'
				),
				array(
						'field' => 'title',
						'label' => 'Title',
						'rules' => 'required'
				),
				array(
						'field' => 'message',
						'label' => 'MessageBody',
						'rules' => 'required'
				)
		)
);