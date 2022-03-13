<?php

echo "<h2>Tutorats</h2>
	<table>
		<thead>
			<tr>
				<th>Categorie</th>
				<th>Tuteur</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

	";

foreach ($data as $key) {
  	echo "<tr><td>{$key['category']}</td><td>{$key['tutor']}</td>
              <td><button><a href={$this->router->getTutoringInformationPageURL($key['id'])}>Infos</a></button>
							<button><a href={$this->router->getParticipantsManagementURL($key['id'])}>Gérer les participants</a></button>
  						<button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifier</a></button>
  						<button><a href= {$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button></td></tr>";
}

echo "</tbody>
	  </table>";

?>
