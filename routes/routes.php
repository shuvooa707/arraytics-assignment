<?php
	
	use controllers\AuthController;
	use controllers\HomeController;
	use controllers\MigrationController;
	use controllers\ReportController;
	use controllers\UserController;
	
	return [
		["/login", "get", new AuthController(), "login"],
		["/login", "post", new AuthController(), "loginPost"],
		["/register", "get", new AuthController(), "register"],
		["/register", "post", new AuthController(), "registerPost"],
		["/logout", "get", new AuthController(), "logout"],
		
		["/", "get", new HomeController(), "index"],
		
		["/users/", "get", new UserController(), "index"],
		["/users/{id}", "get", new UserController(), "show"],
		["/users/create", "get", new UserController(), "create"],
		["/users/store", "post", new UserController(), "store"],
		["/users/form/submit", "post", new UserController(), "submitForm"],
		
		["/reports/", "get", new ReportController(), "index"],
		
		["/migrate", "get", new MigrationController(), "migrate"],
	];