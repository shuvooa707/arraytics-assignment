<?php
	session_start();
//	echo phpinfo();
	require_once "./helpers/view_helpers.php";
	require_once "./helpers/print_helpers.php";
	require_once "./helpers/generics_helpers.php";
	require_once "./helpers/validation_helpers.php";
	require_once "./helpers/auth_helpers.php";
	require_once "./helpers/session_helpers.php";
	
	spl_autoload_register(function ($className) {
		$file = __DIR__ . '\\' . $className . '.php';
		$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
		if (file_exists($file)) {
			include_once $file;
		}
	});
	
	use core\Application;
	use core\Router;
	use database\DB;
	
	
	/** Create Application **/
	$application = new Application();
	
	/** Create Router **/
	$router = new Router();
	
	/** Create Router **/
	$db = DB::getDBObject();
//	$db->migrate();
	
	/** Injecting Router to Application **/
	$application->setRouter($router);
	
	
	echo $application->returnResponse();
	exit(1);
