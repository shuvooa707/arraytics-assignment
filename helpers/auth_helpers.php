<?php

	
	function isLoggedIn(): bool
	{
		return isset($_SESSION["user_id"]);
	}
	function logout()
	{
		unset($_SESSION["user_id"]);
	}