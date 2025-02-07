<?php

	
	function checkSession(string $key): bool
	{
		return !!$_SESSION[$key];
	}
	function getSessionValue(string $key): bool
	{
		return $_SESSION[$key];
	}