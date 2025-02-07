<?php

	
	function view($pageName = null, $args = [])
	{
		$data = $args;
		require_once("./views/" . $pageName . ".php");
		exit(0);
	}