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

	public function welcomePage(){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Welcome_page.php");
		$this->content = ob_get_clean();

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

	public function success(){
		$this->router->POSTredirect($this->router->getWelcomePageURL(), "Success");
	}
}

?>