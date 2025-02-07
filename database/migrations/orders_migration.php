<?php

	return $query = "
		DROP TABLE IF EXISTS `orders`;
		create table orders (
		    id BIGINT(255) AUTO_INCREMENT PRIMARY KEY,
		    amount int(255) NOT NULL,
		    buyer varchar(255) NOT NULL,
		    receipt_id varchar(20) NOT NULL,
		    items varchar(255) NOT NULL,
		    buyer_email varchar(50) NOT NULL,
		    buyer_ip varchar(20),
		    note TEXT NOT NULL,
		    city varchar(20) NOT NULL,
		    phone varchar(20) NOT NULL,
		    hash_key varchar(255),
		    entry_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		    entry_by int(10) NOT NULL
		);";