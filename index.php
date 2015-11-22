<?php
	$start = microtime(true);

	error_reporting(E_ALL);

	define('__AUTH', 'Until Die');

	if(defined('DIRECTORY_SEPARATOR'))
	{
		define('DS', DIRECTORY_SEPARATOR);
	}
	else
	{
		define('DS', '/');
	}

	if(is_callable('realpath'))
	{
		define('BASE_PATH', realpath(dirname(__FILE__)));
	}
	else
	{
		define('BASE_PATH', dirname(__FILE__));
	}

	define('SYS_PATH', BASE_PATH . DS . 'system');
	define('APP_PATH', BASE_PATH . DS . 'application');
	
	require(SYS_PATH . DS . 'initialize.php');
	
	try
	{
		Init::getInstance();
		Init::Router('loader');
	}
	catch(Exception $exc)
	{
		include(SYS_PATH . DS . 'error.php');
	}

	$end = microtime(true);
	echo  '<p sytle="margin: auto 20px;">'. round($end - $start, 4) . ' Sec</p>';
?>