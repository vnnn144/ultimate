<?php
	if(!defined('__AUTH')) exit('Prohibited areas');

	Class Logger {
		private static $logger;

		public function __construct()
		{
			// do something
		}

		public static function __callStatic($index, $args)
		{
			if(!in_array($index, array('info', 'notice', 'error')))
			{
				throw new Exception('Method '.$index.' not exists');
			}

			if(!isset($args[0]))
			{
				throw new Exception('Can\'t call \''.$index.'\' method with 0 argument');
			}

			$time = time();
			$date = date("Y-m-d", $time);
			$hour = date("h:i:s", $time);
			
			if(isset($args[2]))
			{
				$append = '|' . $args[1] . '|'. $args[2]; 
			}
			else if(isset($args[1]))
			{
				$append = '|' . $args[1];	
			}
			else
			{
				$append = '';
			}

			self::$logger['path'] = SYS_PATH . DS . 'tmpfiles' . DS . $date .  '.log';
			self::$logger['contents'] = $hour . '|' . $index . '|' . $args[0] . $append . "\r\n";	

			self::write();

			if($index == 'error')
			{
				exit($args[0]);
			}
		}

		private static function write()
		{
			self::$logger['handle'] = fopen(self::$logger['path'], 'a');
			fwrite(self::$logger['handle'], self::$logger['contents']);
			fclose(self::$logger['handle']);
		}
	}
?>