<?php

$nbEtudiantsInscrits = count($registered);
$placesRestantes = $data['nbMaxStudents']-$nbEtudiantsInscrits;
//var_dump($data);
echo "<h2>Informations sur le tutorat : </h2>";

echo "<h4>Catégorie :</h4> {$data['category']} </br>";

echo "<h4>Tuteur :</h4> <a href='{$this->router->getProfilURLLogin($data['tutor'])}' title='Lien du profil'>{$data['tutor']}</a></br>";

echo "<h4>Places restantes :</h4> {$nbEtudiantsInscrits}(étudiants inscrits) / {$data['nbMaxStudents']}(nombre maximum de places) => {$placesRestantes} places disponibles</br>";

echo "<h4>Description :</h4> {$data['description']} </br>";

echo "<h4>Status :</h4> {$data['status']} </br>";

$isRegistered = false;

$counter = 0;
//var_dump($data);
//var_dump($registered);
if($registered != null){
	echo "<br>";
	echo "<table><thead><tr><th>Étudiants inscrits :</th></tr></thead><tbody><tr>";

	foreach ($registered as $key) {
		if(isset($_SESSION['user'])){
			if($key['student'] == $_SESSION['user']->getLogin()){
				$isRegistered = true;
				echo "<th>{$key['student']} (vous), </th>";
			}else{
				echo "<th>{$key['student']}, </th>";
			}
		}
	}

	echo "</tr></tbody></table></br>";
	}

if($placesRestantes == 0){
	echo "<h4 style='color:red'>! PLUS DE PLACES DISPONIBLES POUR CE TUTORAT !</h4>";
}
else if(!isset($_SESSION['user'])){
	echo "<button><a href={$this->router->getConnectionPageURL()}>Connecter vous pour vous inscrire à ce tutorat</a></button>";
}
else if((isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student" && $isRegistered == false)){
	echo "<button><a href={$this->router->getRegisterURL($data['id'])}>S'inscrire à ce tutorat</a></button>";
}
else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() === "Student" && $isRegistered){
	echo "<h4 style='color:red'>! Vous êtes déjà inscrit à ce tutorat ! </h4>
	<h5>Consulter votre liste de tutorat pour plus d'informations => <button><a href={$this->router->getTutoringListPageURL($_SESSION['user']->getLogin())}>ici</a></button></h5>";
}
?>
