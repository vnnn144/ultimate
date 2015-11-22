<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class Model {
		protected $dbh;
		private static $instance;

		public function __construct()
		{
			if(is_object(self::$instance))
			{
				$this->dbh = self::$instance->dbh;
				return null;
			}

			$config = Init::config('database');
			$dsn = $config['driver'].':host='.$config['hostname'].';dbname='.$config['database'].';charset='.$config['charset'];

			try
			{
				$this->dbh = new PDO($dsn, $config['username'], $config['password']);
				$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				//$this->dbh->query('SET NAMES utf8');
			}
			catch(PDOException $exc)
			{
				echo $exc->getMessage();
			}

			self::$instance = $this;
		}

		public function __destruct()
		{
			$this->dbh = null;
		}

	}
?>