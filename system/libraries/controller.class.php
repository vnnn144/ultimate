<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Abstract Class Controller {
		protected $view;
		protected $model;

		public function __construct()
		{
			$this->view = new View;
			//$this->model = new Model;
		}

		abstract public function index();
	}
?>