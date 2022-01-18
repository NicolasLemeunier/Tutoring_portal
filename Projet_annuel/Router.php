<?php

class Router{
	
	private $view, $controller;

	function __construct(){
		$this->view = null;
		$this->controller = null;
	}

	public function main(Storage $storage){

		session_start();

		if(array_key_exists('user', $_SESSION) && $_SESSION['user'] != null) 
			$this->view = new Private_view($this, $_SESSION['user']); //If the user is connected.
		else
			$this->view = new View($this); //If the user is not connected.


		$this->controller = new Controller($this->view, $storage);

		if(array_key_exists("connection", $_GET))
			$this->view->connectionPage();
		else if(array_key_exists("connection_A", $_GET))
			$this->controller->connection($_POST);
		else if(array_key_exists("accountCreation", $_GET))
			$this->view->accountCreationPage();
		else if(array_key_exists("accountCreation_A", $_GET))
			$this->controller->accountCreation($_POST);
		else if(array_key_exists("disconnection", $_GET))
			$this->controller->disconnection();
		else if(array_key_exists("admin", $_GET))
			$this->view->adminPage();
		else if(array_key_exists("search", $_GET))
			$this->controller->research($_POST['Tutorat_research']);
		else
			$this->controller->tutoringList();	
	}

	public function getConnectionPageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?connection";
	}

	public function getConnectionURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?connection_A";
	}

	public function getAccountCreationPageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?accountCreation";
	}

	public function getAccountCreationURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?accountCreation_A";
	}

	public function getWelcomePageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php";
	}

	public function getDisconnectionURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?disconnection";
	}

	public function getAdminPageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?admin";
	}

	public function getTutoringListPageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tutoringList";
	}

	public function getTutoringCreationPageURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tutoringCreation";
	}

	public function getResearchURL(){
		return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?search";
	}

	public function POSTredirect($url){
		header("Location: " . $url, true, 303);
	}
}

?>