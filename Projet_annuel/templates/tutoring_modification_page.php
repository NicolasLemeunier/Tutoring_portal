<?php

echo "<form action={$this->router->getTutoringModifiedURL($tutor)} method=\"post\">
			<label>Catégorie<input value=".$tutoring->getData()['category']." type=\"text\" name=\"Category\"/><span>".$tutoring->getError()["category"]."</span></label>
			<label>Nombre maximum de participants<input value=".$tutoring->getData()['nbMaxStudents']." style='width: 5em' class=\"inputNum\" type=\"number\" min=\"0\" name=\"Max_number\"/><span>".$tutoring->getError()["nbMax"]."</span></label>
			</br>
			<label>Description <span>".$tutoring->getError()["category"]."</span></label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"Description\">".$tutoring->getData()['description']."</textarea>

		<button type=\"submit\">Sauvegarder</button>
	  </form>";
?>
