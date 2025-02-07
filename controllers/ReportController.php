<?php
	
	namespace controllers;
	
	
	use controllers\ControllerInterface;
	use database\DB;
	
	class ReportController implements ControllerInterface
	{
		private DB $db;
		
		public function __construct()
		{
			$this->db = DB::getDBObject();
		}
		
		public function index()
		{
			
			$query = "select * from orders ";
			if ( isset($_GET["user_id"]) && !empty($_GET["user_id"]) ) {
				$user_id = $_GET["user_id"];
				$query .= " where buyer='$user_id' AND";
//				echo $query;
//				die();
			} else {
				$query .= " where ";
			}
			if ( isset($_GET["from_date"]) && !empty($_GET["from_date"]) ) {
				$from = $_GET["from_date"];
				$query .= " entry_at BETWEEN '$from' ";
			} else {
				$query .= " entry_at BETWEEN '1200-01-01' ";
			}
			if ( isset($_GET["to_date"]) && !empty($_GET["to_date"]) ) {
				$to = $_GET["to_date"];
				$query .= " AND '$to'";
			} else {
				$query .= " AND '3200-01-01'";
			}
//			echo $query;
//			die();
			$reports = $this->db->query($query);
			view("reports", [
				"title" => "Range Page",
				"reports" => $reports,
				"user_id" => isset($_GET["user_id"]) ? $_GET["user_id"] : "",
				"from_date" => isset($_GET["from_date"]) ? $_GET["from_date"] : "",
				"to_date" => isset($_GET["to_date"]) ? $_GET["to_date"] : "",
			]);
		}
		
		public function show()
		{
		
		}
		
		public function create()
		{
		
		}
		
		public function store()
		{
		
		}
	}