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
var_dump($data);
	foreach ($data as $key) {
		echo "<tr><td>Tutorat en {$key['category']}<button><a href={$this->router->getTutoringDeletionURL($key['category'], $key['tutor'])}>Supprimer</a></button><button><a href={$this->router->getTutoringModificationURL($key['category'],$key['tutor'],$key['id'])}>Modifer</a></button></td></tr>";
	}

echo "</tbody>
	  </table>";

?>
