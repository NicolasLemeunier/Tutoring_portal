<?php

class View{
	protected $title, $content, $router;

	function __construct(Router $router){
		$this->title = "";
		$this->content = "";
		$this->router = $router;
	}

	public function render(){
		include("templates/Skeleton.php");
	}

	public function welcomePage(array $data){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Welcome_page.php");
		$this->content = ob_get_clean() . "<br/>";

		$categories_list = array();

		$tables = "";

		foreach($data as $tu){
			if(array_key_exists($tu['category'], $categories_list))
				$categories_list[$tu['category']] .= "<tbody></tr><td><button><a href={$this->router->getTutoringInformationPageURL($tu['category'], $tu['tutor'])}>Tutorat de {$tu['tutor']}</a></button></td></tr></tbody>";
			else{
				$categories_list = $categories_list + array($tu['category'] => "<table><thead><tr><th>{$tu['category']}</th><tr></thead><tbody></tr><td><button><a href={$this->router->getTutoringInformationPageURL($tu['category'], $tu['tutor'])}>Tutorat de {$tu['tutor']}</a></button></td></tr></tbody>");
			}
		}


		foreach($categories_list as $key => $value){
			$categories_list[$key] .= "</table>";
			$this->content .= $categories_list[$key];
		}
	}

	public function bugPage(){
		$this->title = "Oups";
		$this->content = "<h2>Une erreur est survenue, veuillez retournez à la page d'acceuil</h2>";
	}


	public function connectionPage(){
		$this->title = "Page de connexion";
		ob_start();
		include("templates/Connection_page.php");
		$this->content = ob_get_clean();
	}

	public function accountCreationPage(){
		$this->title = "Créer un compte";
		ob_start();
		include("templates/Account_creation_page.php");
		$this->content = ob_get_clean();
	}

	public function adminPageView(Array $data){
		$this->title = "Page administrateur";
		ob_start();
		include("templates/Admin_page.php");
		$this->content = ob_get_clean();
	}

	public function tutoringCreationPage(){
		$this->title = "Créer un tutorat";
		ob_start();
		include("templates/tutoring_creation_page.php");
		$this->content = ob_get_clean();
	}

	public function tutoringListPage($data){
		$this->title = "Liste de vos tutorats";
		ob_start();
		include("templates/tutoring_list_page.php");
		$this->content = ob_get_clean();
	}

	public function information($category, $tutor, $data, $registered){
		$this->title = "Page d'informations";
		ob_start();
		include("templates/tutoring_information_page.php");
		$this->content = ob_get_clean();
	}

	public function success(){
		$this->router->POSTredirect($this->router->getWelcomePageURL(), "Success");
	}


	public function getMenu(){
		return array(
      			"Accueil" => $this->routeur->getWelcomePageURLage(),
      			"Liste Tutorat" => $this->routeur->getTutoringListPageURL(),
      			"Nouveau tutorat" => $this->routeur->getTutoringCreationPageURL(),
            "Connexion/Déconnexion" => $this->routeur->getConnectionPageURL(),
            "Partie Admin" => $this->routeur->getAdminPageURL(),
      		);
	      }
			}

?>
