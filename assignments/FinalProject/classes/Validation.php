<?php

class Validation{

	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;

	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "email": return $this->email($value); break;
			case "address": return $this->address($value); break;
			case "date": return $this->date($value); break;
			case "pass": return $this->pass($value); break;
			
		}
	}
		
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[A-Za-z-\'\s]+$/', $value);
		return $this->setError($match);
	}

	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}

	private function email($value) {
		$match = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value);
		return $this->setError($match);
	}

	private function address($value) {
		$match = preg_match('/^\d+\s+[a-zA-Z]+(\s+[a-zA-Z]+)*$/', $value);
		return $this->setError($match);
	}

	private function date($value) {
		$match = preg_match('/^\s*\d{2}\/\d{2}\/\d{4}$/', $value);
		return $this->setError($match);
	}

	//Password can be anything but null or blank
	private function pass($value){
		if ($value != "" && $value !== null){
			return "";
		} else {
			return "error";
		}
	}

	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}

		else {
			return "";
		}
	}


	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}