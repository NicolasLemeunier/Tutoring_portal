<?php

require_once("model/TutoringBuilder.php"); //OK
//


class Controller{
	private $view, $storage;

	function __construct(View $view, Storage $storage){
		$this->view = $view;
		$this->storage = $storage;
	}

	public function connection(array $data){
		foreach($this->storage->readAllAccounts() as $key){
			if($key['login'] == $data['Login']){
				if(password_verify($data['Password'], $key['password'])){
					$_SESSION['user'] = new Account($data['Login'], $key['password'], $key['status']);
				 	$this->view->success();

				 	return true;
 				}
			}
		}

		$this->view->connectionPage();

		return false;
	}

	public function accountCreation(array $data){

		if(empty(trim(htmlspecialchars($data['Login']))) || empty(trim(htmlspecialchars($data['Password'])))){
			$this->view->accountCreationPage();
			return false;
		}

		if(array_key_exists($data['Login'], $this->storage->readAllAccounts()))
			$this->view->accountCreationPage();
		else{
			$hash = password_hash(htmlspecialchars($data['Password']), PASSWORD_BCRYPT);

			$this->storage->insertAccount(htmlspecialchars($data['Login']), $hash, $data['Status']);

			$array = array('Login' => htmlspecialchars($data['Login']), 'Password' => htmlspecialchars($data['Password']));

			$this->connection($array);
			return true;
		}
	}

	public function disconnection(){
		unset($_SESSION['user']);

		$this->view->success();
	}

	public function welcomePage(){
		$data = $this->storage->readAllTutoring();

		$this->view->welcomePage($data);
	}

	public function research(string $word){
		$tutoringList = $this->storage->readAllTutoring();

		$this->view->welcomePage($this->storage->research($word));
	}

	public function adminPage(){
		$this->view->adminPageView($this->storage->readAllAccounts());
	}

	public function accountDeletion(String $login){
		$this->storage->deleteAccount($login);

		$this->adminPage();
	}

	public function accountModifying($login, $status){

		switch($status){
			case "Student":
				$status = "Tutor";
				break;
			case "Tutor":
				$status = "Admin";
				break;
			case "Admin":
				$status = "Student";
				break;
		}

		$this->storage->modifyingAccount($login, $status);

		$this->adminPage();
	}

	public function tutoringList($login){
			$data = array();

			if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
				$data = $this->storage->readAllTutoringFromAPerson($login);
			}

			if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student")
				$data = $this->storage->readStudentTutoring($login);

			$this->view->tutoringListPage($data);
	}


	public function tutoringCreation(array $data){

		$tutoringBuilder = new TutoringBuilder($data);
		if(!$tutoringBuilder->isValid()){
		 $this->view->tutoringCreationPage($tutoringBuilder);
	 	}else{
			if(array_key_exists('user', $_SESSION)){
			 	$finalTutoring = $tutoringBuilder->createTutoring();
	 			$this->storage->insertTutoring($finalTutoring->getCategory(), $finalTutoring->getDescription(), $finalTutoring->getNbMax(), $finalTutoring->getTutor());
	 			$this->tutoringList($_SESSION['user']->getLogin());
 			}else{
	 			$this->welcomePage();
	 			}
	 	}
	}

	public function information($id){
		//faire un truc avec l'id
		$data = $this->storage->readTutoringByID($id);

		$registered = $this->storage->readRegistered($_SESSION['user']->getLogin());

		$this->view->information($data, $registered);
	}

	public function register($category, $tutor){
		$this->storage->register($category, $_SESSION['user']->getLogin(), $tutor);
		$this->tutoringList($_SESSION['user']->getLogin());
	}

	public function tutoringDeletion($tutoringID){
		$this->storage->deleteTutoring($tutoringID);
		//La fonction n'est plus dans le storage ????
		//$this->storage->deleteRegistered($tutoringID);
		$this->welcomePage();
	}

	public function tutoringModification($id){
		//OK
		 $data = $this->storage->readTutoringByID($id);
		 if($data == null){
			 $this->view->bugPage();
		 }else{
			 $tutoringBuilder = new TutoringBuilder($data);
			 $this->view->tutoringModification($id,$tutoringBuilder);
		 }
  }

	public function confirmTutoringModif($post,$id) {
		$tutoringBuilder = new TutoringBuilder($post);
		 if(!$tutoringBuilder->isValid()){
			$this->view->tutoringModification($id,$tutoringBuilder);
		 }else{
 			if(array_key_exists('user', $_SESSION)){
 			 	$finalTutoring = $tutoringBuilder->createTutoring();
				$this->storage->modifyingTutoring($finalTutoring->getCategory(), $finalTutoring->getDescription(), $finalTutoring->getNbMax(),$id);
				$this->tutoringList($_SESSION['user']->getLogin());
  		}else{
 	 				$this->welcomePage();
 	 		}
 	 	}
	}
}

?>
