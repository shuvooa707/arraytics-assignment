<?php
	namespace controllers;
	
	
	use controllers\ControllerInterface;
	use database\DB;
	
	class MigrationController implements ControllerInterface
	{
		public function migrate()
		{
			$db = DB::getDBObject();
			$db->migrate();
			echo "Migrated";
			exit(0);
		}
	}