<?php

class Storage{
	
	private $PDO;

	function __construct($PDO){
		$this->PDO = $PDO;
		$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function insertAccount($login, $password, $status){

		$sql = "INSERT INTO tutoring_website_accounts(login, password, status) VALUES(:login, :password, :status)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login, ":password" => $password, ":status" => $status);

		$stmt->execute($data);
	}

	public function readAllAccounts(){
		$stmt = $this->PDO->query("SELECT login, password, status FROM tutoring_website_accounts");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readAllTutoring(){
		$stmt = $this->PDO->query("SELECT category, tutor FROM tutoring_website_tutorList");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function research(string $word){
		$stmt = $this->PDO->query("SELECT category, tutor FROM tutoring_website_tutorList WHERE category LIKE \"$word%\"");

		$lines = $stmt->fetchAll();

		return $lines;
	}
}

?>