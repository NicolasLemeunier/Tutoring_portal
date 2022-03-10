<?php

echo "<form action={$this->router->getTutoringModifiedURL($id)} method=\"post\">
			<label>Catégorie<input type=\"text\" name=\"category\"/ value=".$tutoringBuilder->getData()['category']." ><span style='color:red'>".$tutoringBuilder->getError()["category"]."</span></label>
			<br>
			<label>Nombre maximum de participants <input style='width: 5em' class=\"inputNum\" type=\"number\" min=\"0\" name=\"nbMaxStudents\"/ value=".$tutoringBuilder->getData()['nbMaxStudents']."><span style='color:red'>".$tutoringBuilder->getError()["nbMaxStudents"]."</span></label>
			</br>
			<label>Description <span style='color:red'>".$tutoringBuilder->getError()["description"]."</span></label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"description\">".$tutoringBuilder->getData()['description']."</textarea>

		<button type=\"submit\">Sauvegarder</button>
	  </form>";
?>
