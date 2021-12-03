<?php

echo "<form action={$this->router->getAccountCreationURL()} method=\"post\">
			<label>Login<input type=\"text\" name=\"Login\"/></label>
			<label>Password<input type=\"password\" name=\"Password\"/></label>		

			<label>Etudiant<input type=\"radio\" name=\"Status\" value=\"Student\" checked=\"checked\"/></label>		
			<label>Tuteur<input type=\"radio\" name=\"Status\" value=\"Tutor\"/></label>		
 
		<button type=\"submit\">Créer un compte</button>
	  </form>";
?>