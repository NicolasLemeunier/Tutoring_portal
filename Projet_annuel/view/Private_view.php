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

	public function welcomePage(){
		$this->title = "Page d'accueil";
		ob_start();
		include("templates/Private_welcome_page.php");
		$this->content = ob_get_clean();

		$this->render();
	}
}

?>