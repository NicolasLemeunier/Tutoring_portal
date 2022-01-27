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

	/*
	"<div>
  			<button class=\"w3-bar-item w3-button\" onclick=\"tabs('Maths')\">London</button>
  <button class=\"w3-bar-item w3-button\" onclick=\"tabs('Anglais')\">Paris</button>
  <button class=\"w3-bar-item w3-button\" onclick=\"tabs('Info')\">Tokyo</button>
</div>

<div id=\"Maths\" class=\"Tab\">
  <h2>Maths</h2>
  <p>Hey</p>
</div>

<div id=\"Anglais\" class=\"Tab\" style=\"display:none\">
  <h2>Anglais</h2>
  <p>Hey</p> 
</div>

<div id=\"Info\" class=\"Tab\" style=\"display:none\">
  <h2>Info</h2>
  <p>Hey</p>
</div>
*/

	
		$tabs = "<div><button class=\"Tab\">Test</button>";
				
		$categories_list = array();

		foreach($data as $tu){
			if(array_key_exists($tu['category'], $categories_list))
				$categories_list[$tu['category']] .= "<div id={$tu['category']} class=\"Tab_content\" style=\"display:none\"><h2>{$tu['category']}</h2>
  				<p>Tutorat de {$tu['tutor']}</p>";
			else{

				$tabs .= "<button class=\"Tab\" onclick=\"tabs(\"{$tu['category']}\")\">{$tu['category']}</button>";

				$categories_list = $categories_list + array($tu['category'] => "<div id={$tu['category']} class=\"Tab_content\" style=\"display:none\"><h2>{$tu['category']}</h2>
  				<p>Tutorat de {$tu['tutor']}</p>");
			}
		}

		$tabs .= "</div>";

		$this->content .= $tabs;

		foreach($categories_list as $key => $value){
			$categories_list[$key] .= "</div>";
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

	public function adminPageView(Array $data){
		$this->title = "Page administrateur";
		ob_start();
		include("templates/Admin_page.php");
		$this->content = ob_get_clean();

		$this->render();	
	}

	public function tutoringCreationPage(){
		$this->title = "Créer un tutorat";
		ob_start();
		include("templates/tutoring_creation_page.php");
		$this->content = ob_get_clean();

		$this->render();
	}

	public function tutoringListPage($data){
		$this->title = "Liste de vos tutorats";
		ob_start();
		include("templates/tutoring_list_page.php");
		$this->content = ob_get_clean();
		
		$this->render();
	}

	public function success(){
		$this->router->POSTredirect($this->router->getWelcomePageURL(), "Success");
	}
}

?>