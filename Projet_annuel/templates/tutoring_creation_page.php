<?php

echo "<form action={$this->router->getTutoringCreationURL()} method=\"post\">
			<label>Catégorie <input type=\"text\" name=\"category\"/ value=".$tutoringBuilder->getData()['category']."><span style='color:red'>".$tutoringBuilder->getError()["category"]."</span></label>
			</br>
			<label>Nombre maximum de participants <input style='width: 5em' class=\"inputNum\" type=\"number\" min=\"0\" name=\"nbMax\"/ value=".$tutoringBuilder->getData()['nbMax']."><span style='color:red'>".$tutoringBuilder->getError()["nbMax"]."</span></label>
			</br>
			<label>Description <span>".$tutoringBuilder->getError()["description"]."</span> </label>
			</br>
			<textarea rows=\"8\" cols=\"30\"name=\"description\">".$tutoringBuilder->getData()['description']."</textarea>

		<button type=\"submit\">Créer un tutorat</button>
	  </form>";
?>
