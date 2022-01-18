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

	public function welcomePage(Array $data){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Private_welcome_page.php");
		$this->content = ob_get_clean() . "<br/>";

		$categories_list = array();

		$tables = "";

		foreach($data as $tu){
			if(array_key_exists($tu['category'], $categories_list))
				$categories_list[$tu['category']] .= "<tbody></tr><td>Tutorat de {$tu['tutor']}</td></tr></tbody>";
			else{
				array_merge($categories_list, array($tu['category'] => "<table><thead><tr><th>{$tu['category']}</th><tr></thead><tbody></tr><td>Tutorat de {$tu['tutor']}</td></tr></tbody>"));
			}
		}

		foreach($categories_list as $key => $value){
			$categories_list['key'] .= "</table>";
			$this->content .= $categories_list['key'];
		}

		$this->render();
	}
}

?>