<?php 

/**
 * This class represents an account.
 */

class Account{
	private $login, $password, $status;

	function __construct($login, $password, $status){
		$this->login = $login;
		$this->password = $password;
		$this->status = $status; // If admin, student or tutor
	}

	//Getters

	public function getLogin(){
		return $this->login;
	}

	public function getStatus(){
		return $this->status;
	}
}

?>