<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class Loader {
		private $loader;
		private $vars;
		private $path;

		public function __construct()
		{
			$this->path['helper'] = SYS_PATH . DS . 'helpers' . DS;
			$this->path['model'] = SYS_PATH . DS . 'modules' . DS;
			$this->path['module'] = SYS_PATH . DS . 'modules' . DS;
			$this->path['controller'] = $this->path['module'] . DS . 'controllers' . DS;
		}

		private function path($index, $name)
		{
			switch ($index)
			{
				case 'helper':
					$this->path['helper'] = SYS_PATH . DS . 'helpers' . DS . $name . '.model.php';
					break;

				case 'model':

					break;

				default:
					throw new Exception('Not find path \''.$index.'\' in system');
			}

			return $this->path[$index];
		}

		public function helper($name)
		{
			$path = SYS_PATH . DS . 'helpers' . DS . $name . '.helper.php';

			if(!file_exists($path))
			{
				if(!file_exists($path))
				{
					return Logger::notice('Can\'t load helper '. $name .'.helper.php');
				}

				$path = APP_PATH . DS . 'helpers' . DS . $name. '.helper.php';
			}

			include($path);
		}

		public function model($index)
		{
			$path = Init::loader('getPath') . DS . 'models' . DS . $index .'.model.php';

			if(!file_exists($path))
			{
				throw new Exception('Model '.$index.' not exists');
			}

			require_once($path);

			return new $index();
		}

		public function module($route)
		{	
			$module = $controller = $route;

			if(strstr($route, '/'))
			{
				list($module, $controller) = explode('/', $route);
			}

			if(!is_dir(APP_PATH . DS . 'modules' . DS . $module))
			{
				throw new Exception('Module '.$module.' does not exist');
			}

			if(!file_exists(APP_PATH . DS . 'modules' . DS . $module . DS . 'controllers' . DS . $controller .'.controller.php'))
			{
				throw new Exception('Controller '.$controller.' does not exist');
			}

			require_once(APP_PATH . DS . 'modules' . DS . $module . DS . 'controllers' . DS . $controller .'.controller.php');

			$classname = $controller.'_Controller';

			$this->loader = new $classname();

			return $this->loader;
		}
	}
?>