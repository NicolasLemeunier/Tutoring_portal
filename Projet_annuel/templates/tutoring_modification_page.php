<?php

echo "<form action={$this->router->getTutoringModifiedURL($id)} method=\"post\">
			<label>Catégorie<input value=".$data['category']." type=\"text\" name=\"Category\"/></label>
			<label>Nombre maximum de participants<input value=".$data['nbMaxStudents']." style='width: 5em' class=\"inputNum\" type=\"number\" min=\"0\" name=\"Max_number\"/></label>
			</br>
			<label>Description</label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"Description\">".$data['description']."</textarea>

		<button type=\"submit\">Sauvegarder</button>
	  </form>";
?>
