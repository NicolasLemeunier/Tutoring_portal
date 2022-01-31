<?php

echo "<h2>Informations sur le tutorat</h2>";

echo "<h4>Catégorie :</h4> $category </br>";

echo "<h4>Tuteur :</h4> $tutor </br>";

echo "<h4>Nombre d'étudiant maximum pouvant suivre ce tutorat :</h4> {$data['nbMaxStudents']} </br>";

echo "<h4>Description :</h4> {$data['description']} </br>";

if($registered != null){
	echo "<table><thead><tr><th>Étudiants inscrits</th></tr></thead><tbody><tr>";

	foreach ($registered as $key) {
		echo "<th>{$key['student']}</th>";
	}

	echo "</tr></tbody></table></br>";
	}

if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student")
	echo "<button><a href={$this->router->getRegisterURL($tutor)}>S'inscrire à ce tutorat</a></button>"

?>