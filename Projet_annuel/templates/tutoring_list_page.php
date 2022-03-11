<?php

if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
	$text = "Tous les tutorats auquel vous vous êtes inscrit, ".$_SESSION['user']->getLogin();
}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
	$text = "Tous les tutorats que vous avez créer, ".$_SESSION['user']->getLogin();
}
echo "<h2>".$text."</h2>
	<table>
		<thead>
			<tr>
				<th>Tutorats</th>";
				if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
					echo "<th>Tuteur</th><th>A débuter ?</th>";
				}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
					//echo "<th>Actions</th>";
				}
echo"
		<th>Actions</th>
			</tr>
		</thead>

		<tbody>

	";
//
var_dump($data);
	foreach ($data as $key) {
		if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
			echo "<tr><td>Tutorat en {$key['category']}</td><td><button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifer</a></button><button><a href={$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button></td></tr>";
		}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
			echo "<tr><td>Tutorat en {$key['category']}</td><td>{$key['tutor']}</td><td>Non (besoin d'un attribut start)</td><td><button><a href={$this->router->getTutoringPageURL()}>Voir</a></button><button><a href={$this->router->getLeaveTutoringURL($key['category'])}>Quitter</a></button></td></tr>";
		}
	}


echo "</tbody>
	  </table>";

?>
