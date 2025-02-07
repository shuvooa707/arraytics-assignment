<?php
	
	namespace utils;
	
	class HashManager
	{
		private string $salt;
		public function __construct()
		{
			$app_configs = include "./config/app_config.php";
			$this->salt = $app_configs["hash_salt"];
		}
		
		public function make(string $input): string
		{
			return hash('sha512', $input . $this->salt);
		}
		public function check(string $password, string $storedPassword): bool
		{
			$calculated_hash = hash('sha512', $password . $this->salt);
			
			return hash_equals($calculated_hash, $storedPassword);
		}
	}