<?php
	
	namespace utils;
	
	use database\DB;
	
	class AuthManager
	{
		private DB $db;
		private HashManager $hashManager;
		
		public function __construct()
		{
			$this->db = DB::getDBObject();
			$this->hashManager = new HashManager();
		}
		
		public function attempt(string $email, string $password): bool
		{
			$query = "select * from users where email='$email'";
			$result = $this
				->db
				->query($query);
			
			
			if ($result->rowCount() > 0) {
				// output data of each row
				$row = $result->fetch();
				
//				echo $row["id"];
//				echo $this->hashManager->check($password, $row["password"]);
//				die();
				
				$r = $this->hashManager->check($password, $row["password"]);
				
				if ( $r ) {
					SessionManager::set("user_id", $row["id"]);
					return $r;
				}
			}
			return false;
		}
	}