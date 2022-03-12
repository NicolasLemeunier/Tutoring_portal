<?php

class Router{

	private $view, $controller;

	function __construct(){
		$this->view = null;
		$this->controller = null;
	}

	public function main(Storage $storage){

		session_start();

		$id = key_exists('id', $_GET)? $_GET['id']: null;

		if(array_key_exists('user', $_SESSION) && $_SESSION['user'] != null)
			$this->view = new Private_view($this, $_SESSION['user']); //If the user is connected.
		else
			$this->view = new View($this); //If the user is not connected.

		$action = key_exists('action', $_GET)? $_GET['action']: null;
		if($action == null){
	     $action = "accueil";
	   }

		$this->controller = new Controller($this->view, $storage);


		try {
		 switch ($action) {

			 case "accueil":
				 $this->controller->welcomePage();
			 break;
			 case "connection":
				 $this->view->connectionPage();
			 break;
			 case "connection_A":
	 	 			$this->controller->connection($_POST);
				break;
				case "accountCreation":
 	 	 				$this->view->accountCreationPage();
 				break;
				case "accountCreation_A":
 	 	 			$this->controller->accountCreation($_POST);
 				break;
				case "disconnection":
 	 	 				$this->controller->disconnection();
 				break;
				case "admin":
 	 	 					$this->controller->adminPage();
 				break;
				case "search":
 	 	 					$this->controller->research($_POST['Tutorat_research']);
 				break;
				case "tutoringCreation":
 	 	 					$this->view->tutoringCreationPage();
 				break;
				case "tutoringCreation_A":
					$this->controller->tutoringCreation($_POST);
 				break;
				case "deletion":
					$this->controller->accountDeletion($_GET['login']);
 				break;
				case "modify":
					$this->controller->accountModifying($_GET['login'], $_GET['status']);
 				break;
				case "tutoringList":
					$this->controller->tutoringList($_SESSION['user']->getLogin());
 				break;
				case "information":
					$this->controller->information($id);
 				break;
				case "register_A":
					$this->controller->register($id);
 				break;
				case "tutoringDeletion":
					$this->controller->tutoringDeletion($id);
				break;
				case "tutoringModification":
					$this->controller->tutoringModification($id);
				break;
				case "tutoringModified":
					$this->controller->confirmTutoringModif($_POST,$id);
				break;
				case "adminTutoring":
					$this->controller->adminPageTutoring();
				break;
				case "leaveTutoring":
					$this->controller->leaveTutoring($id);
				break;
				case "start":
					$this->controller->startTutoring($id);
				break;
				case "end":
					$this->controller->endTutoring($id);
				break;
				case "profil":
					$this->controller->profil($id,"");
				break;
				case "profilViaLogin":
					$this->controller->profil("",$_GET['login']);
				break;
				case "chat":
					$this->controller->chat($id,$_POST);
				break;
				case "ended":
				//les élèves n'ont pas besoin de noté les tuteurs
					$this->controller->endedTutoring($id);//pour les élèves
				break;

			 default:
				// L'internaute a demandé une action non prévue.
  				$this->controller->welcomePage();
				break;
      }
    } catch (Exception $e) {
			// Si on arrive ici, il s'est passé quelque chose d'imprévu (par exemple un problème de base de données)
			echo $e;
			$this->view->bugPage();
		}
		$this->view->render();
	}


	public function getConnectionPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=connection";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=connection";
	}

	public function getConnectionURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=connection_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=connection_A";
	}

	public function getAccountCreationPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=accountCreation";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=accountCreation";
	}

	public function getAccountCreationURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=accountCreation_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=accountCreation_A";
	}

	public function getWelcomePageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php";
	}

	public function getDisconnectionURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=disconnection";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=disconnection";
	}

	public function getAdminPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=admin";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=admin";
	}

	public function getTutoringListPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringList";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringList";
	}

	public function getTutoringCreationPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringCreation";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringCreation";
	}

	public function getResearchURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=search";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=search";
	}

	public function getTutoringPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tu";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tu";
	}

	public function getDeletionAccountURL($login){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=deletion&login=$login";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=deletion&login=$login";
	}

	public function getModifyingAccountURL($login, $status){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=modify&login=$login&status=$status";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=modify&login=$login&status=$status";
	}

	public function getTutoringCreationURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringCreation_A";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringCreation_A";
	}

	public function getTutoringInformationPageURL($id){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=information&id=$id";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=information&id=$id";
	}

	public function getRegisterURL($id){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=register_A&id=&id";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=register_A&id=$id";
	}

	public function getTutoringDeletionURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringDeletion&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringDeletion&id=$id2";
	}
	public function getTutoringModificationURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringModification&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringModification&id=$id2";
	}
	public function getTutoringModifiedURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=tutoringModified&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=tutoringModified&id=$id2";
	}
	public function getAdminTutoringPageURL(){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=adminTutoring";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=adminTutoring";
	}
	public function getLeaveTutoringURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=leaveTutoring&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=leaveTutoring&id=$id2";
	}
	public function getEndTutoringURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=end&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=end&id=$id2";
	}
	public function getEndedTutoringURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=ended&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=ended&id=$id2";
	}
	public function getStartTutoringURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=start&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=start&id=$id2";
	}
	public function getProfilURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=profil&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=profil&id=$id2";
	}
	public function getChatURL($id2){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=chat&id=$id2";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=chat&id=$id2";
	}
	public function getProfilURLLogin($login){
		//return "https://dev-21914622.users.info.unicaen.fr/Projet_annuel/index.php?action=profilViaLogin&login=$login";
		return "https://dev-21904876.users.info.unicaen.fr/tutoratProjet/projet-annuel-camara-grimault-frapier-lemeunier/Projet_annuel/index.php?action=profilViaLogin&login=$login";
	}


	public function POSTredirect($url){
		header("Location: " . $url, true, 303);
	}
}

?>
