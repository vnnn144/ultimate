<?php
	if(!defined('__AUTH')) exit('You don\'t have permission to access here');

	Class Init {
		private static $instance;
		private static $init;

		public function __construct()
		{
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			spl_autoload_register(array($this, '__autoload'));

			self::$init['config'] = new Config;
			self::$init['loader'] = new Loader;
			self::$init['router'] = new Router;
		}

		public static function getInstance()
		{
			if(!is_object(self::$instance))
			{
				self::$instance = new Init();
			}

			return self::$instance;
		}

		public static function __autoload($classname)
		{
			if(!file_exists(SYS_PATH . DS . 'libraries' . DS . strtolower($classname) . '.class.php'))
			{
				throw new Exception('\''. $classname .'.class.php\' file does not exist');
			}

			require_once(SYS_PATH . DS . 'libraries' . DS . strtolower($classname) . '.class.php');
		}

		public static function __callStatic($class, $args)
		{
			$class = strtolower($class);

			if(!array_key_exists($class, self::$init))
			{
				throw new Exception('\''.$class.'\' object does not exist');
			}

			if(empty($args[0]))
			{
				return self::$init[$class];
			}	
			else if(is_callable(array(self::$init[$class], $args[0])))
			{
				switch(count($args))
				{
					case 1:
						return self::$init[$class]->$args[0]();
					case 2:
						return self::$init[$class]->$args[0]($args[1]);
					case 3:
						return self::$init[$class]->$args[0]($args[1], $args[2]);
					case 4:
						return self::$init[$class]->$args[0]($args[1], $args[2], $args[3]);
					case 5:
						return self::$init[$class]->$args[0]($args[1], $args[2], $args[3], $args[4]);
					default:
						throw new Exception('Can\'t call \''.$args[0].'\' method with arguments');
				}
			}
			else
			{
				throw new Exception('Can\'t call \''.$args[0].'\' method in object');
			}
		}

		public function __destruct()
		{
			self::$instance = null;			
		}
	}
?>