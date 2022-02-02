<?php

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

	public function tutoringList($tutor){

			$data = $this->storage->readAllTutoringFromAPerson($tutor);
			$this->view->tutoringListPage($data);


	}

	public function tutoringCreation(array $data){
		if(array_key_exists('user', $_SESSION)){
			$this->storage->insertTutoring($data['Category'], $data['Description'], $data['Max_number'], $_SESSION['user']->getLogin());
			$this->tutoringList($_SESSION['user']->getLogin());
		}
		else
			$this->welcomePage();
	}

	public function information($catagory, $tutor){
		$data = $this->storage->readTutoring($tutor);

		$registered = $this->storage->readRegistered($tutor);

		$this->view->information($catagory, $tutor, $data, $registered);
	}

	public function register($category, $tutor){
		$this->storage->register($category, $_SESSION['user']->getLogin(), $tutor);
		$this->tutoringList($tutor);
	}

	public function tutoringDeletion($category, $tutor){
		$this->storage->deleteTutoring($category, $tutor);
		$this->welcomePage();
	}
	public function tutoringModification($category, $tutor){
		$this->view->tutoringModification($category, $tutor);
		//$this->storage->deleteTutoring($category, $tutor);
		//$this->welcomePage();
	}
}

?>
