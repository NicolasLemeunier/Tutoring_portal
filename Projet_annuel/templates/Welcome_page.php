<?php

echo "<form method=\"post\" action = {$this->router->getResearchURL()}>
		<label>Rechercher un tutorat <input type=\"text\" name=\"Tutorat_research\"/></label>
		<button type=\"submit\">Rechercher</button>
	  </form>";
?>