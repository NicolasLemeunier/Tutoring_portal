<?php

echo "<form action={$this->router->getTutoringModifiedURL($tutor)} method=\"post\">
			<label>Catégorie<input value=".$tutoring['category']." type=\"text\" name=\"Category\"/></label>
			<label>Nombre maximum de participants<input value=".$tutoring['nbMaxStudents']." style='width: 5em' class=\"inputNum\" type=\"number\" min=\"0\" name=\"Max_number\"/></label>
			</br>
			<label>Description</label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"Description\">".$tutoring['description']."</textarea>

		<button type=\"submit\">Sauvegarder</button>
	  </form>";
?>
