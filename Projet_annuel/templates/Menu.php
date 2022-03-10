<?php

$res = isset($_SESSION['user']) ? $_SESSION['user']->getStatus() : "Non connecté";

echo "<header><h1>Portail de tutorats privés</h1><h2>Statut : $res </h2></header>";

echo "<nav class='menu'>
		<ul>
			<li><a href = {$this->router->getWelcomePageURL()}>Accueil</a></li>";

if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Tutor")
	echo"<li><a href = {$this->router->getTutoringCreationPageURL()}>Créer un tutorat</a></li>";
else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Admin")
	echo"<li><a href={$this->router->getAdminPageURL()}>Gestion des comptes</a></li>";

if(!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null)
	echo "<li><a href = {$this->router->getConnectionPageURL()}>Se connecter</a></li>";
else{
	if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Admin"){
		echo "<li><a href = {$this->router->getAdminTutoringPageURL()}>Gestion des tutorats</a></li>";
		echo "<li><a href = {$this->router->getDisconnectionURL()}>Se déconnecter</a></li>";
	}else{
		echo "<li><a href = {$this->router->getTutoringListPageURL()}>Liste de vos tutorats</a></li>";
		echo "<li><a href = {$this->router->getDisconnectionURL()}>Se déconnecter</a></li>";
	}

}

echo "</ul></nav>";

?>
