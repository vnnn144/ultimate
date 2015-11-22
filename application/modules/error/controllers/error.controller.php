<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class error_Controller extends Controller {

		public function index()
		{
			echo 'Error 404';
		}
	}
?>