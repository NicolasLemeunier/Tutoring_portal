<?php

/**
 * This class is the different view of a connected user.
 */

class Private_view extends View{
	private $account;

	function __construct(Router $router, Account $account){
		parent::__construct($router);

		$this->account = $account;
	}

	/**
	 * This methods builds the welcome page.
	 */

	public function welcomePage($data){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Welcome_page.php");
		$this->content = ob_get_clean() . "<br/>";

		$categories_list = array();

		$tables = "";

		foreach($data as $tu){
			if(isset($tu['status']) && $tu['status'] != "ended"){
				//POur ne pas avoir des tutorats terminés
				if(array_key_exists($tu['category'], $categories_list)){
					$categories_list[$tu['category']] .= "<tbody></tr><td><button><a href={$this->router->getTutoringInformationPageURL($tu['id'])}>Tutorat de {$tu['tutor']}</a></button></td></tr></tbody>";
				}else{
					$categories_list = $categories_list + array($tu['category'] => "<table><thead><tr><th>{$tu['category']}</th><tr></thead><tbody></tr><td><button><a href={$this->router->getTutoringInformationPageURL($tu['id'])}>Tutorat de {$tu['tutor']}</a></button></td></tr></tbody>");
				}
			}
		}


		foreach($categories_list as $key => $value){
			$categories_list[$key] .= "</table>";
			$this->content .= $categories_list[$key];
		}

	}

}

?>
