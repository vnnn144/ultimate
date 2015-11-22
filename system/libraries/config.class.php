<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class Config {
		private $config;
		private $path;

		public function __construct()
		{
			$this->path = SYS_PATH . DS . 'config';
		}

		public function __call($index, $args)
		{
			if(!file_exists($this->configFile($index)) OR !is_readable($this->configFile($index)))
			{
				throw new Exception('Can\'t load config file \''. $index .'.ini.php\'');
			}

			if(!isset($this->config[$index]))
			{
				$this->config[$index] = parse_ini_file($this->configFile($index));
			}

			if(isset($args[0]) AND array_key_exists($args[0], $this->config[$index]))
			{
				return $this->config[$index][$args[0]];
			}

			return $this->config[$index];
		}

		private function configFile($index)
		{
			return $this->path . DS . $index . '.ini.php';
		}
	}
?>