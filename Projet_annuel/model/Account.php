<?php

/**
 * This class represents an account.
 */

class Account{
	private $login, $password, $status, $id;

	function __construct($login, $password, $status,$id = ""){
		$this->login = $login;
		$this->password = $password;
		$this->status = $status; // If admin, student or tutor
		$this->id = $id;
	}

	//Getters

	public function getLogin(){
		return $this->login;
	}

	public function getStatus(){
		return $this->status;
	}
	public function getID(){
		return $this->id;
	}
}

?>
