<?php
	
	namespace utils;
	
	class SessionManager
	{
		public static function set(string $key, string $value, int $expires = 3600): void
		{
			$_SESSION[$key] = $value;
		}
		public static function remove(string $key): void
		{
			unset($_SESSION[$key]);
		}
		public static function removeAll()
		{
			$cookies = $_COOKIE;
			foreach ($cookies as $cookie) {
				SessionManager::remove($cookie);
			}
		}
	}