<?php 

	define ('ROOT',dirname(dirname(__FILE__)).'/');
	//	echo __DIR__;
	define('DEBUG', true);

	require(ROOT.'include/db.class.php');
	require(ROOT.'include/conf.class.php');
	require(ROOT.'include/log.class.php');
	require(ROOT.'include/lib_base.php');
	require(ROOT.'include/mysql.class.php');

	$_GET = _addslashes($_GET);
	$_POST = _addslashes($_POST);
	$_COOKIE = _addslashes($_COOKIE);

	if(defined('DEBUG')){
		error_reporting(E_ALL);
	}else{
		error_reporting(0);
	}
 ?>