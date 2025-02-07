<?php
	
	namespace database;
	
	class DB implements DBInterface
	{
		private \PDO $connection;
		
		public function __construct(\PDO $connection)
		{
			$this->connection = $connection;
		}
		
		public static function getDBObject(): ?DB
		{
			$conn = new Connection();
			$connection = $conn->getConnection();
			$db = new DB($connection);
			
			return $db;
		}
		
		/**
		 * @param string $query
		 * @return mixed
		 */
		function execute(string $query): mixed
		{
			try {
				$this->connection->exec($query);
			} catch (\Exception $exception) {
			
			}
			return null;
		}
		function query(string $query): mixed
		{
			try {
				return $this->connection->query($query);
			} catch (\Exception $exception) {
			
			}
			return null;
		}
		
		public function migrate()
		{
			$queries = $this->loadMigrationQueries();
			foreach ($queries as $query) {
//				print_r($query);
				try {
					$this
						->connection
						->exec($query);
				} catch (\Exception $exception) {
					print_r($exception->getMessage());
				}
			}
		}
		
		public function loadMigrationQueries(): array
		{
			$queries = [];
			$files = array_diff(scandir(__DIR__ . "/migrations"), array('..', '.'));
			foreach ($files as $file) {
				$queries[] = include( __DIR__ ."/migrations/".$file);
			}
			
			return $queries;
		}
		
		public function getConn(): \PDO
		{
			return $this->connection;
		}
	}