<?php

echo "<header><h1>Portail de tutorats privés</h1><h2>Bienvenue {$_SESSION['user']->getLogin()}</h2></header>";

echo "<form method=\"post\">
		<label>Rechercher un tutorat <input type=\"text\" name=\"Tutorat_research\"/></label>
	  </form>";
?>