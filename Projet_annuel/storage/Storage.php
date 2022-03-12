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

	public function insertTutoring($category, $description, $nbMaxStudents, $tutor){
		$sql = "INSERT INTO tutoring_website_tutoringList(category, description, nbMaxStudents, tutor) VALUES(:category, :description, :nbMaxStudents, :tutor)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":description" => $description, ":nbMaxStudents" => $nbMaxStudents, ":tutor" => $tutor);

		$stmt->execute($data);
	}

	public function readTutoring($tutor){
		$sql = "SELECT * FROM tutoring_website_tutoringList WHERE tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":tutor" => $tutor);

		$stmt->execute($data);

		$line = $stmt->fetch();

		return $line;
	}

	public function readTutoringByID($idTutoring){

		//si par exemple un tuteur à plusieurs tutorats
		$sql = "SELECT * FROM tutoring_website_tutoringList WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $idTutoring);

		$stmt->execute($data);

		$line = $stmt->fetch();

		return $line;
	}

	public function readIDTutoring($category,$description,$nbMaxStudents,$tutor){

		//avoir l'ID d'un tutorat précis
		$sql = "SELECT id FROM tutoring_website_tutoringList WHERE category=:category AND description=:description AND nbMaxStudents=:nbMaxStudents AND tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":tutor" => $tutor, ":description" => $description, ":nbMaxStudents" => $nbMaxStudents);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}




	public function readAllAccounts(){
		$stmt = $this->PDO->query("SELECT * FROM tutoring_website_accounts");

		$lines = $stmt->fetchAll();

		return $lines;
	}
	public function readAccountsById($id){

		$sql = "SELECT * FROM tutoring_website_accounts WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id);

		$stmt->execute($data);

		$line = $stmt->fetch();

		return $line;
	}
	public function readAccountsByLogin($login){

		$sql = "SELECT * FROM tutoring_website_accounts WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login);

		$stmt->execute($data);

		$line = $stmt->fetch();

		return $line;
	}

	public function readAllTutoring(){
		$stmt = $this->PDO->query("SELECT * FROM tutoring_website_tutoringList");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readAllTutoringFromAPerson($tutor){
		$sql = "SELECT * FROM tutoring_website_tutoringList WHERE tutor=:tutor";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":tutor" => $tutor);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}




	public function research(string $word){
		$stmt = $this->PDO->query("SELECT category, tutor FROM tutoring_website_tutoringList WHERE category LIKE \"$word%\"");

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function deleteAccount($login){
		$sql = "DELETE FROM tutoring_website_accounts WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login);

		$stmt->execute($data);
	}

	public function deleteTutoring($id){
		$sql = "DELETE FROM tutoring_website_tutoringList WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id);

		$stmt->execute($data);
	}

	public function deleteTutoringStudents($id_tutoring){
		$sql = "DELETE FROM tutoring_website_registered WHERE id_tutoring=:id_tutoring";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id_tutoring" => $id_tutoring);

		$stmt->execute($data);
	}


	public function modifyingAccount($login, $status){
		$sql = "UPDATE tutoring_website_accounts SET status=:status WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login, ":status" => $status);

		$stmt->execute($data);
	}

	public function modifyingTutoring($category,$description,$nbMaxStudents,$id){
		//OK
		$sql = "UPDATE tutoring_website_tutoringList SET category=:category, description=:description, nbMaxStudents=:nbMaxStudents WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category,":description" => $description,":nbMaxStudents" => $nbMaxStudents,":id" => $id);

		$stmt->execute($data);

		return true;
	}



	public function register($category, $login, $tutor,$id){
		$sql = "INSERT INTO tutoring_website_registered (category, student, tutor, id_tutoring) VALUES (:category, :login, :tutor, :id_tutoring)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":category" => $category, ":login" => $login, ":tutor" => $tutor, ":id_tutoring" => $id);

		$stmt->execute($data);
	}

	public function readRegistered($id){
		$sql = "SELECT * FROM tutoring_website_registered WHERE id_tutoring=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function readStudentTutoring($login){
		$sql = "SELECT * FROM tutoring_website_registered WHERE student=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function getTutoringStatus($id){
		$sql = "SELECT status FROM tutoring_website_tutoringList WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}

	public function deleteRegisteredStudent($id_tutoring,$login){
		$sql = "DELETE FROM tutoring_website_registered WHERE id_tutoring=:id_tutoring AND student=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id_tutoring" => $id_tutoring, ":login" => $login);

		$stmt->execute($data);
	}

	public function startTutoring($id){
		$sql = "UPDATE tutoring_website_tutoringList SET status=:status WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":status" => "started", ":id" => $id);

		$stmt->execute($data);

		return true;

	}
	public function endTutoring($id){
		$sql = "UPDATE tutoring_website_tutoringList SET status=:status WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":status" => "ended", ":id" => $id);

		$stmt->execute($data);

		return true;
	}
	public function insertMark($id,$login,$note){
		$sql = "INSERT INTO tutoring_website_marks (id, login, mark) VALUES (:id, :login, :mark)";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id, ":login" => $login, ":mark" => $note);

		$stmt->execute($data);
		return true;
	}
	public function readMarksByID($id){
		$sql = "SELECT * FROM tutoring_website_marks WHERE id=:id";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":id" => $id);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}
	public function readMarksByLogin($login){
		$sql = "SELECT * FROM tutoring_website_marks WHERE login=:login";

		$stmt = $this->PDO->prepare($sql);

		$data = array(":login" => $login);

		$stmt->execute($data);

		$lines = $stmt->fetchAll();

		return $lines;
	}

}

?>
