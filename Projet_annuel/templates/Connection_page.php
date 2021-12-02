<?php

echo "<form action={$this->router->getConnectionURL()} method=\"post\">
		<label>Login<input type=\"text\" name=\"Login\"/></label>
		<label>Password<input type=\"password\" name=\"Password\"/></label>
		<button type=\"submit\">Connexion</button>
	  </form>";

echo "<a href={$this->router->getAccountCreationPageURL()}>Créer un compte</a>"
?>