<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class Router {
		private $module;
		private $control;
		private $action;
		private $param;
		private $loader;
		private $config;
		private $uri;

		public function __construct()
		{
			$this->uri = new URI;
			var_dump($this->uri->url);
			$this->config = Init::config('application');
		}

		public function loader()
		{
			$this->normalization();

			var_dump(array('Module' => $this->module, 'Control' => $this->control, 'Action' => $this->action, 'Param' => $this->param));

			$this->loader = Init::loader('module', $this->module . '/' . $this->control);

			if(!is_callable(array($this->loader, $this->action)))
			{
				$this->loader = Init::loader('module', $this->config['error_module']);
				$this->action = 'index';
			}

			$this->loader->{$this->action}($this->param);
		}

		private function normalization()
		{
			$this->module = $this->control = $this->config['default_module'];
			$this->action = 'index';

			switch (count($this->uri->url))
			{
				case 0:
					break;

				case 1:
					if($this->is_module($this->uri->url[0]))
					{
						$this->module = $this->control = $this->uri->url[0];
					}
					else if($this->is_controller($this->uri->url[0]))
					{
						$this->control = $this->uri->url[0];
					}
					else
					{
						$this->action = $this->uri->url[0];
					}
					break;

				case 2:
					if($this->is_module($this->uri->url[0]))
					{
						$this->module = $this->control = $this->uri->url[0];

						if($this->is_controller($this->uri->url[1]))
						{
							$this->control = $this->uri->url[1];
						}
						else
						{
							$this->action = $this->uri->url[1];
						}							
					}
					else if($this->is_controller($this->uri->url[0]))
					{
						$this->control = $this->uri->url[0];
						$this->action = $this->uri->url[1];
					}
					else
					{
						$this->module = $this->control = $this->config['error_module'];
					}
					break;
				
				case 3:
					if($this->is_module($this->uri->url[0]) AND $this->is_controller($this->uri->url[1]))
					{
						$this->module = $this->uri->url[0];
						$this->control = $this->uri->url[1];
						$this->action = $this->uri->url[2];
					}
					else
					{
						$this->module = $this->control = $this->config['error_module'];
					}
					break;

				default:

			}
		}

		private function is_action($index)
		{
			return Init::loader('is_action', $index);
		}

		private function is_module($index)
		{
			return Init::loader('is_module', $index);
		}

		private function is_controller($index)
		{
			return Init::loader('is_controller', $this->module . '/' . $index);
		}

	}
?>