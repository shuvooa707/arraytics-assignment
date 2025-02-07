<?php

	
	function redirect(string $newURL): void
	{
		header('Location: ' . $newURL);
		die(1);
	}