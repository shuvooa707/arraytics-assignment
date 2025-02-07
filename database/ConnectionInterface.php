<?php
	
	namespace database;
	
	interface ConnectionInterface
	{
		function connect();
		function getConnection(): \PDO;
	}