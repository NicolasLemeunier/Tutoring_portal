<?php

echo "<h2>Comptes</h2>
	<table>
		<thead>
			<tr>
				<th>Tutorats</th>
			</tr>
		</thead>

		<tbody>

	";

	foreach ($data as $key) {
		echo "<tr><td>Tutorat en {$key['category']}<button><a href={$this->router->getTutoringDeletionURL($key['category'], $key['tutor'])}>Supprimer</a></button><button><a href={$this->router->getTutoringModificationURL($key['category'], $key['tutor'])}>Modifer</a></button></td></tr>";
	}

echo "</tbody>
	  </table>";

?>
