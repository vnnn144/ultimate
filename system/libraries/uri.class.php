<?php
	if(!defined('__AUTH')) exit('Prohibited areas');

	Class URI {
		public $uri;
		public $url;
		public $ext;
		public $query;

		public function __construct()
		{
			$this->uri = $_SERVER['REQUEST_URI'];
		
			if(!isset($_SERVER['PATH_INFO']))
			{
				$this->url = array();
			}
			else
			{
				$this->url = trim(strtolower($_SERVER['PATH_INFO']), '/');
				preg_match("#msg=(.*?);#", $this->url, $matches);
				var_dump($matches);
				/*$this->url = explode('/', trim(strtolower($_SERVER['PATH_INFO']), '/'));

				$array = explode('.', end($this->url));
				
				if(isset($array[1]))
				{
					$this->url[count($this->url) - 1] = $array[0];
					$this->ext = $array[1];
				}*/
			}

			if(!isset($_SERVER['QUERY_STRING']) || $_SERVER['QUERY_STRING'] == '')
			{
				$this->query = array();
			}
			else
			{
				foreach(explode('&', $_SERVER['QUERY_STRING']) as $val)
				{
					$array = explode('=', $val);
					$this->query[$array[0]] = $array[1]; 
				}
			}
		}

		public function url()
		{
			return $this->url;
		}

		public function query()
		{
			return $this->query;
		}
	}
?>