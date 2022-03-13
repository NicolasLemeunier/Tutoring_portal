<?php

echo "<h2>Comptes</h2>
	<table>
		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Statut</th>
				<th>E-mail</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	";

foreach ($data as $key) {
	if($key['email'] != null){
		echo "<tr><td>{$key['login']}</td><td>{$key['status']}</td><td>{$key['email']}</td>
							<td><button><a href={$this->router->getModifyingAccountURL($key['login'], $key['status'])}>Modifier statut</a></button>
							<button><a href= {$this->router->getDeletionAccountURL($key['login'])}>Supprimer</a></button></td></tr>";
	}else{
		echo "<tr><td>{$key['login']}</td><td>{$key['status']}</td><td>non-renseigné</td>
							<td><button><a href={$this->router->getModifyingAccountURL($key['login'], $key['status'])}>Modifier statut</a></button>
							<button><a href= {$this->router->getDeletionAccountURL($key['login'])}>Supprimer</a></button></td></tr>";

	}
}

echo "</tbody>
	  </table>";

?>
