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

	public function welcomePage(Array $data){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Welcome_page.php");
		$this->content = ob_get_clean() . "<br/>";

		$categories_list = array();

		$tables = "";

		foreach($data as $tu){
			if(array_key_exists($tu['category'], $categories_list))
				$categories_list[$tu['category']] .= "<tbody></tr><td>Tutorat de {$tu['tutor']}</td></tr></tbody>";
			else{
				$categories_list = $categories_list + array($tu['category'] => "<table><thead><tr><th>{$tu['category']}</th><tr></thead><tbody></tr><td>Tutorat de {$tu['tutor']}</td></tr></tbody>");
			}
		}


		foreach($categories_list as $key => $value){
			$categories_list[$key] .= "</table>";
			$this->content .= $categories_list[$key];
		}


		$this->render();
	}

	public function connectionPage(){
		$this->title = "Page de connexion";
		ob_start();
		include("templates/Connection_page.php");
		$this->content = ob_get_clean();

		$this->render();
	}

	public function accountCreationPage(){
		$this->title = "Créer un compte";
		ob_start();
		include("templates/Account_creation_page.php");
		$this->content = ob_get_clean();

		$this->render();
	}

	public function adminPage(){
		$this->title = "Page administrateur";
		ob_start();
		include("templates/Admin_page.php");
		$this->content = ob_get_clean();

		$this->render();	
	}

	public function success(){
		$this->router->POSTredirect($this->router->getWelcomePageURL(), "Success");
	}
}

?>