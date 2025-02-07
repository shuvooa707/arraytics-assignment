<?php
	namespace controllers;
	
	
	use controllers\ControllerInterface;
	
	class HomeController implements ControllerInterface
	{
		public function index()
		{
			view("index", [
				"title" => "Home Page"
			]);
		}
		
		/**
		 * @return void
		 */
		public function sumbitFormPost()
		{
			$amount = $_POST["amount"];
			$buyer = $_POST["buyer"];
			$receipt_id = $_POST["receipt_id"];
			$items = $_POST["items"];
			$buyer_email = $_POST["buyer_email"];
			$note = $_POST["note"];
			$city = $_POST["city"];
			$phone = $_POST["phone"];
			$city = $_POST["city"];
			validateRequest();
			
			
			return redirect("sumbitform");
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