<?php
	
	namespace controllers;
	
	
	use controllers\ControllerInterface;
	use database\DB;
	use utils\AuthManager;
	use utils\HashManager;
	use utils\SessionManager;
	
	class AuthController implements ControllerInterface
	{
		private DB $db;
		private HashManager $hashManager;
		private AuthManager $authManager;
		
		public function __construct()
		{
			$this->db = DB::getDBObject();
			$this->hashManager = new HashManager();
			$this->authManager = new AuthManager();
		}
		
		public function login()
		{
			view("auth/login", [
				"title" => "Login Page"
			]);
		}
		
		public function loginPost()
		{
			$email = $_POST["email"];
			$password = $_POST["password"];
			$result = $this->authManager->attempt($email, $password);
			
			
			if ($result) {
			
				redirect("/");
			} else {
				redirect("/login");
			}
		}
		
		public function register()
		{
			view("auth/register", [
				"title" => "Register Page"
			]);
		}
		
		public function registerPost()
		{
			$name = $_POST["name"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$repassword = $_POST["repassword"];
			
			
			$password = $this->hashManager->make($password);
			
			$query = "insert into users(name, email, password) values ('$name', '$email', '$password')";
			try {
				$this
					->db
					->execute($query);
			} catch (\Exception $exception) {
				redirect("/register");
			}
			
			redirect("/login");
		}
		
		
		public function logout()
		{
			logout();
			return redirect("/");
		}
		
		public function sumbitform()
		{
			return view("form-submit-greetings");
		}
		
		public function show()
		{
			view("show", [
				"title" => "Show User"
			]);
		}
		
		public function create()
		{
			view("show", [
				"title" => "Create User"
			]);
		}
		
		public function store()
		{
		
		}
	}