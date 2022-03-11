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
					echo "<th>Tuteur</th><th>Status</th>";
				}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
					echo "<th>Status</th>";
				}
echo"
		<th>Actions</th>
			</tr>
		</thead>

		<tbody>

	";
//

var_dump($data);
var_dump($allTutoring);
	foreach ($data as $key) {
		$status = "started";
		//$status = "unknown_ID";
		if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
			if(isset($key['id_tutoring'])){
				foreach ($allTutoring as $key2) {
					if($key2['id'] == $key['id_tutoring']){
						$status = $key2['status'];
					}
				}
			}
		}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
			$status = $key['status'];
		}

		if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
			if($status == "started"){

			}else if($status == "not_started"){

			}
			echo "<tr><td>Tutorat en {$key['category']}</td><td>{$status}</td><td><button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifer</a></button><button><a href={$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button></td></tr>";
		}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
			if($status == "started"){
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$key['tutor']}</td><td>{$status}</td><td><button><a href={$this->router->getLeaveTutoringURL($key['category'])}>Rejoindre le chat</a></button><button><a href={$this->router->getTutoringPageURL()}>Voir</a></button><button><a href={$this->router->getLeaveTutoringURL($key['category'])}>Quitter</a></button></td></tr>";
			}else if ($status == "not_started" || $status == "ended"){
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$key['tutor']}</td><td>{$status}</td><td><button><a href={$this->router->getTutoringPageURL()}>Voir</a></button><button><a href={$this->router->getLeaveTutoringURL($key['category'])}>Quitter</a></button></td></tr>";
			}
		}
	}


echo "</tbody>
	  </table>";

?>
