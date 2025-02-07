<?php
	
	namespace database;
	
	use controllers\ControllerInterface;
	
	class Connection extends \PDO implements ControllerInterface
	{
		private \PDO $connection;
		private string $driver;
		private string $host;
		private string $dbname;
		
		private string $username;
		private string $password;
		
		public function __construct()
		{
		}
		
		function getConnection(): \PDO|null
		{
			$this->loadCredentials();
//			print_r($this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname.$this->username.$this->password);
			
			$this->connection = new \PDO($this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
			return $this->connection;
		}
		
		private function loadCredentials(): void
		{
			$credentials = include(__DIR__."/../config/db_config.php");
			$this->driver = $credentials["driver"];
			$this->host = $credentials["host"];
			$this->dbname = $credentials["dbname"];
			$this->username = $credentials["username"];
			$this->password = $credentials["password"];
//			$this->connection = new \PDO($this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);

//			print_r($this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname.$this->username.$this->password);
		}
	}