<?php
	if(!defined('__AUTH')) exit('Prohibited areas');

	if(!function_exists('logger'))
	{
		function logger($message, $file, $line)
		{
			$logfile = SYS_PATH . DS . 'tmpfiles' . DS . date("Y-m-d", time()) . '.log';
			$contents = date("h:i:s", time()) . '|' . $message . '|' . $file . '|' . $line;

			$fp = fopen($logfile, 'a');
			fwrite($fp, $contents . "\r\n");
			fclose($fp);
		}
	}
?>