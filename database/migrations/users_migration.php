<?php

	return $query = "
		DROP TABLE IF EXISTS `users`;
		create table users (
		    id BIGINT(255) AUTO_INCREMENT PRIMARY KEY,
		    name varchar(255) NOT NULL,
		    email varchar(100) UNIQUE NOT NULL,
		    password varchar(255) NOT NULL,
		    created_at DATE
		);";