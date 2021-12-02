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
		if(array_key_exists($data['Login'], $this->storage->readAllAccounts()))
			$this->view->accountCreationPage();
		else{
			$hash = password_hash(htmlspecialchars($data['Password']), PASSWORD_BCRYPT);

			$this->storage->insertAccount(htmlspecialchars($data['Login']), $hash, $data['Status']);

			$array = array('Login' => htmlspecialchars($data['Login']), 'Password' => htmlspecialchars($data['Password']));

			$this->connection($array);
		}
	}

	public function disconnection(){
		unset($_SESSION['user']);

		$this->view->success();
	}
}

?>