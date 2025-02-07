<?php
	
	namespace database;
	
	interface DBInterface
	{
		function execute(string $query);
	}