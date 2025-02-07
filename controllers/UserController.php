<?php
	
	namespace controllers;
	
	
	use controllers\ControllerInterface;
	use database\DB;
	use http\Cookie;
	use utils\HashManager;
	
	class UserController implements ControllerInterface
	{
		private DB $db;
		private HashManager $hashManager;
		
		public function __construct()
		{
			$this->db = DB::getDBObject();
			$this->hashManager = new HashManager();
		}
		
		public function index()
		{
			view("index", [
				"title" => "Home Page"
			]);
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
		
		/**
		 * @return false|string
		 * @methos POST
		 * @desc
		 */
		public function submitForm()
		{
			$amount = $_POST["amount"];
			$buyer = $_POST["buyer"];
			$note = $_POST["note"];
			$receipt_id = $_POST["receipt_id"];
			$items = implode(", ", $_POST["items"]);
			$buyer_email = $_POST["buyer_email"];
			$city = $_POST["city"];
			$phone = $_POST["phone"];
			$entry_by = $_POST["entry_by"];
			
			$errors = validateFormRequestData([
				"amount" => $amount,
				"buyer" => $buyer,
				"note" => $note,
				"receipt_id" => $receipt_id,
				"items" => $items,
				"buyer_email" => $buyer_email,
				"city" => $city,
				"phone" => $phone,
				"entry_by" => $entry_by
			]);
			
			if (!empty($errors)) {
				return json_encode([
					"message" => "failed",
					"errors" => $errors
				]);
			}
			
			$hash_key = $this->hashManager->make($receipt_id);
			$buyer_ip = $_SERVER["REMOTE_ADDR"];
			$phone = "880" . $phone;
			$statement = $this
				->db
				->getConn()
				->prepare("INSERT INTO orders (amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, hash_key, entry_by) VALUES (:amount, :buyer, :receipt_id, :items, :buyer_email, :buyer_ip, :note, :city, :phone, :hash_key, :entry_by)");
			
			$statement->bindParam("amount", $amount);
			$statement->bindParam("buyer", $buyer);
			$statement->bindParam("receipt_id", $receipt_id);
			$statement->bindParam("items", $items);
			$statement->bindParam("buyer_email", $buyer_email);
			$statement->bindParam("buyer_ip", $buyer_ip);
			$statement->bindParam("note", $note);
			$statement->bindParam("city", $city);
			$statement->bindParam("phone", $phone);
			$statement->bindParam("hash_key", $hash_key);
			$statement->bindParam("entry_by", $entry_by);
			
			try {
				$statement->execute();
			} catch (\Exception $exception) {
				
				$response_data = [
					"message" => "failed",
					"error" => $exception->getMessage(),
					"data" => [
						"amount" => $amount,
						"buyer" => $buyer,
						"note" => $note,
						"receipt_id" => $receipt_id,
						"items" => implode(", ", $items),
						"buyer_email" => $buyer_email,
						"city" => $city,
						"phone" => $phone,
						"entry_by" => $entry_by,
						"hash_key" => $hash_key
					]
				];
			}
			
			
			setcookie(
				"form_submitted_in_24_hours",
				time(),
				time() + 86400,
				"/",
				"",
				false,
				true
			);
			
			$response_data = [
				"message" => "success",
				"data" => [
				
				]
			];
			return json_encode($response_data);
		}
	}