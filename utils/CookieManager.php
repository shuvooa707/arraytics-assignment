<?php
	
	namespace utils;
	
	class CookieManager
	{
		public static function set(string $key, string $value, int $expires = 3600): void
		{
			setcookie($key, $value, $expires , "/");
		}
		public static function remove(string $key): void
		{
			setcookie($key, "", time() - 3600);
		}
		public static function removeAll()
		{
			$cookies = $_COOKIE;
			foreach ($cookies as $cookie) {
				CookieManager::remove($cookie);
			}
		}
	}