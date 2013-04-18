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
						'rules' => 'required|callback__hash_create|callback__auth[login]'
				)
		),
		'addEditBook' => array(
				array(
						'field' => 'title',
						'label' => 'Название',
						'rules' => 'required|trim|xss_clean|htmlspecialchars'
				),
				array(
						'field' => 'description',
						'label' => 'Описание',
						'rules' => 'required|trim|xss_clean|htmlspecialchars'
				),
				array(
						'field' => 'rate',
						'label' => 'Рейтинг',
						'rules' => 'required|numeric'
				),
				array(
						'field' => 'id_author',
						'label' => 'Автор',
						'rules' => 'required|numeric'
				),
				array(
						'field' => 'id_category',
						'label' => 'Категория',
						'rules' => 'required|numeric'
				),
				array(
						'field' => 'active',
						'label' => 'Отображение на сайте',
						'rules' => 'required|numeric'
				)
		)
);