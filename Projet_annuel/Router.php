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

		$action = key_exists('action', $_GET)? $_GET['action']: null;
		if($action == null){
	     $action = "accueil";
	   }

		$this->controller = new Controller($this->view, $storage);

		/*
		try {
		 switch ($action) {

			 case "accueil":
				 $this->controller->welcomePage();
			 break;
			 default:
				// L'internaute a demandé une action non prévue.
  				$this->controller->welcomePage();
				break;
      }
    } catch (Exception $e) {
			// Si on arrive ici, il s'est passé quelque chose d'imprévu (par exemple un problème de base de données)

			$this->view->bugPage();
		}
		$this->view->render();
  }

	*/

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
			$this->controller->adminPage();
		else if(array_key_exists("search", $_GET))
			$this->controller->research($_POST['Tutorat_research']);
		else if(array_key_exists("tutoringCreation", $_GET))
			$this->view->tutoringCreationPage();
		else if(array_key_exists("deletion", $_GET))
			$this->controller->accountDeletion($_GET['login']);
		else if(array_key_exists("modify", $_GET))
			$this->controller->accountModifying($_GET['login'], $_GET['status']);
		else if(array_key_exists("tutoringList", $_GET))
			$this->controller->tutoringList($_SESSION['user']->getLogin());
		else if(array_key_exists("tutoringCreation_A", $_GET))
			$this->controller->tutoringCreation($_POST);
		else if(array_key_exists("information", $_GET))
			$this->controller->information($_GET['category'], $_GET['tutor']);
		else if(array_key_exists("register_A", $_GET))
			$this->controller->register($_GET['tutor']);
		else
			$this->controller->welcomePage();
	}


	public function getConnectionPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?connection";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?connection";
	}

	public function getConnectionURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?connection_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?connection_A";
	}

	public function getAccountCreationPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?accountCreation";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?accountCreation";
	}

	public function getAccountCreationURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?accountCreation_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?accountCreation_A";
	}

	public function getWelcomePageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php";
	}

	public function getDisconnectionURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?disconnection";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?disconnection";
	}

	public function getAdminPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?admin";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?admin";
	}

	public function getTutoringListPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tutoringList";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?tutoringList";
	}

	public function getTutoringCreationPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tutoringCreation";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?tutoringCreation";
	}

	public function getResearchURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?search";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?search";
	}

	public function getTutoringPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tu";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?tu";
	}

	public function getDeletionAccountURL($login){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?deletion&login=$login";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?deletion&login=$login";
	}

	public function getModifyingAccountURL($login, $status){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?modify&login=$login&status=$status";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?modify&login=$login&status=$status";
	}

	public function getTutoringCreationURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?tutoringCreation_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?tutoringCreation_A";
	}

	public function getTutoringInformationPageURL($category, $tutor){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?information&category=$category&tutor=$tutor";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?information&category=$category&tutor=$tutor";
	}

	public function getRegisterURL($tutor){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?register_A&tutor=$tutor";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?register_A&tutor=$tutor";
	}

	public function POSTredirect($url){
		header("Location: " . $url, true, 303);
	}
}

?>
