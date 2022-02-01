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

	public function insertTutoring($category, $description, $nbMax, $tutor){
		$sql = "INSERT INTO tutoring_website_tutorList(category, description, nbMaxStudents, tutor) VALUES(:category, :description, :nbMaxStudents, :tutor)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":description" => $description, ":nbMaxStudents" => $nbMax, ":tutor" => $tutor);

		$stmt->execute($data);
	}

	public function readTutoring($tutor){
		$sql = "SELECT category, description, nbMaxStudents FROM tutoring_website_tutorList WHERE tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":tutor" => $tutor);

		$stmt->execute($data);

		$line = $stmt->fetch();

		return $line;
	}

	public function readAllAccounts(){
		$stmt = $this->PDO->query("SELECT login, password, status FROM tutoring_website_accounts");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readAllTutoring(){
		$stmt = $this->PDO->query("SELECT category, description, nbMaxStudents, tutor FROM tutoring_website_tutorList");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readAllTutoringFromAPerson($tutor){
		$sql = "SELECT category, tutor FROM tutoring_website_tutorList WHERE tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":tutor" => $tutor);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	} 

	public function research(string $word){
		$stmt = $this->PDO->query("SELECT category, tutor FROM tutoring_website_tutorList WHERE category LIKE \"$word%\"");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function deleteAccount($login){
		$sql = "DELETE FROM tutoring_website_accounts WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login);

		$stmt->execute($data);
	}

	public function deleteTutoring($category, $tutor){
		$sql = "DELETE FROM tutoring_website_tutorList WHERE category=:category AND tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":tutor" => $tutor);

		$stmt->execute($data);
	}

	public function modifyingAccount($login, $status){
		$sql = "UPDATE tutoring_website_accounts SET status=:status WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login, ":status" => $status);

		$stmt->execute($data);
	}

	public function register($category, $login, $tutor){
		$sql = "INSERT INTO tutoring_website_registered (category, student, tutoring) VALUES (:category, :login, :tutor)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":login" => $login, ":tutor" => $tutor);

		$stmt->execute($data);
	}

	public function readRegistered($tutor){
		$sql = "SELECT student FROM tutoring_website_registered WHERE tutoring=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":tutor" => $tutor);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readStudentTutoring($login){
		$sql = "SELECT category, tutor FROM tutoring_website_registered WHERE student=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":student" => $login);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}
}

?>