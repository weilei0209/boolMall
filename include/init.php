<?php 

	define ('ROOT',dirname(dirname(__FILE__)).'/');
	//	echo __DIR__;
	define('DEBUG', true);

	require(ROOT.'include/db.class.php');
	require(ROOT.'include/conf.class.php');
	require(ROOT.'include/log.class.php');

	if(defined('DEBUG')){
		error_reporting(E_ALL);
	}else{
		error_reporting(0);
	}
 ?>