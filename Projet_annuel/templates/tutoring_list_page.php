<?php

echo "<h2>Tous vos tutorats</h2>
	<table>
		<thead>
			<tr>
				<th>Tutorats</th>
			</tr>
		</thead>

		<tbody>

	";
	foreach ($data as $key) {
		echo "<tr><td>Tutorat en {$key['category']}<button><a href={$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button><button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifer</a></button></td></tr>";
	}

echo "</tbody>
	  </table>";

?>
