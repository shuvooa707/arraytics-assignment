<?php
	
	function validateRequest($array): array
	{
		$errors = [];
		
		
		return $errors;
	}
	
	function validateFormRequestData(array $data): array
	{
		$errors = [];
		
		// Amount
		if (!preg_match('/^\d+$/', $data['amount'])) {
			$errors['amount'] = "Amount must contain only numbers.";
		}
		
		// Buyer
		if (!preg_match('/^[a-zA-Z0-9 ]{1,20}$/', $data['buyer'])) {
			$errors['buyer'] = "Buyer must contain only letters, numbers, and spaces (max 20 characters).";
		}
		
		// Receipt ID
		if (!preg_match('/^[a-zA-Z0-9]+$/', $data['receipt_id'])) {
			$errors['receipt_id'] = "Receipt ID must contain only letters and numbers.";
		}
		
		// Items
		if (!preg_match('/^[a-zA-Z0-9, ]+$/', $data['items'])) {
			$errors['items'] = "Items must contain only letters, numbers, spaces, and commas.";
		}
		
		// Buyer Email
		if (!filter_var($data['buyer_email'], FILTER_VALIDATE_EMAIL)) {
			$errors['buyer_email'] = "Invalid email format.";
		}
		
		// Note
		if (!preg_match('/^(?:\S+\s*){1,30}$/u', $data['note'])) {
			$errors['note'] = "Note must be a maximum of 30 words.";
		}
		
		// City
		if (!preg_match('/^[a-zA-Z ]+$/', $data['city'])) {
			$errors['city'] = "City must contain only letters and spaces.";
		}
		
		// Phone
		if (!preg_match('/^\d{10,11}$/', $data['phone'])) {
			$errors['phone'] = "Phone must contain only numbers and 11 digits.";
		}
		
		// Entry By
		if (!preg_match('/^\d+$/', $data['entry_by'])) {
			$errors['entry_by'] = "Entry By must contain only numbers.";
		}
		
		
		
		return $errors;
	}
	
	function checkIfValue(string $filed, $rule): bool
	{
		return true;
	}