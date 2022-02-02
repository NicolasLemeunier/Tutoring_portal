<?php

echo "<form action={$this->router->getTutoringModificationURL($category,$tutor)} method=\"post\">
			<label>Catégorie<input type=\"text\" name=\"Category\"/></label>
			<label>Nombre maximum de participants<input class=\"inputNum\" type=\"number\" min=\"0\" name=\"Max_number\"/></label>
			</br>
			<label>Description</label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"Description\"></textarea>

		<button type=\"submit\">Sauvegarder</button>
	  </form>";
?>
