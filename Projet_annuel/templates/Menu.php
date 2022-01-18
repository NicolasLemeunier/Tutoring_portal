<?php
echo "<nav>
		<ul>
			<li><a href = {$this->router->getWelcomePageURL()}>Accueil</a></li>";

if(!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null)
	echo "<li><a href = {$this->router->getConnectionPageURL()}>Se connecter</a></li>";
else
	echo "<li><a href = {$this->router->getDisconnectionURL()}>Se déconnecter</a></li>";
/*
if($_SESSION['user']->getStatus() === "admin")
	$this->content .= "<li><a href={$this->url["AccountsManaging"]}>Gestion des comptes</a></li>";
*/
echo "</li></ul></nav>";

?>