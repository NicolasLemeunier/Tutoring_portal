<?php

$text2 = "";

if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
	if($data != null){
		$text = "Tous les tutorats auquel vous vous êtes inscrit, ".$_SESSION['user']->getLogin();
	}else{
		$text = "Vous n'êtes inscrits à aucun tutorat, ".$_SESSION['user']->getLogin();
		$text2 = "Voir tous les tutorats => <button><a href={$this->router->getWelcomePageURL()}>acceuil</a></button></h5>";
	}

}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor"){
	$text = "Tous les tutorats que vous avez créer, ".$_SESSION['user']->getLogin();
}
echo "<h2>".$text."</h2>
			<p>".$text2."</p>
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

//var_dump($data);
//var_dump($allTutoring);
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
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$status}</td><td><button><a href={$this->router->getEndTutoringURL($key['id'])}>Terminer le tutorat</a></button><button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifer</a></button><button><a href={$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button></td></tr>";
			}else if($status == "not_started" || $status == "ended"){
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$status}</td><td><button><a href={$this->router->getStartTutoringURL($key['id'])}>Démarrer le tutorat</a></button><button><a href={$this->router->getTutoringModificationURL($key['id'])}>Modifer</a></button><button><a href={$this->router->getTutoringDeletionURL($key['id'])}>Supprimer</a></button></td></tr>";
			}
		}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student"){
			if($status == "started"){
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$key['tutor']}</td><td>{$status}</td><td><button><a href={$this->router->getLeaveTutoringURL($key['id_tutoring'])}>Rejoindre le chat</a></button><button><a href={$this->router->getTutoringInformationPageURL($key['id_tutoring'])}>Infos</a></button><button><a href={$this->router->getLeaveTutoringURL($key['id_tutoring'])}>Quitter</a></button></td></tr>";
			}else if ($status == "not_started" || $status == "ended"){
				echo "<tr><td>Tutorat en {$key['category']}</td><td>{$key['tutor']}</td><td>{$status}</td><td><button><a href={$this->router->getTutoringInformationPageURL($key['id_tutoring'])}>Infos</a></button><button><a href={$this->router->getLeaveTutoringURL($key['id_tutoring'])}>Quitter</a></button></td></tr>";
			}
		}
	}


echo "</tbody>
	  </table>";

?>
