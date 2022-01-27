<?php

echo "<h2>Comptes</h2>
	<table>
		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Statut</th>
			</tr>
		</thead>

		<tbody>
			
	";
		

foreach ($data as $key) {
	echo "<tr><td>{$key['login']}</td><td>{$key['status']}</td><td><button><a href= 
			{$this->router->getModifyingAccountURL($key['login'], $key['status'])}>Modifier statut</a></button></td><td><button><a href= 
			{$this->router->getDeletionAccountURL($key['login'])}>Supprimer</a></button></td></tr>";
}

echo "</tbody>
	  </table>";

?>