<?php

//var_dump($data);
//var_dump($marks);

echo "<h2>Profil de {$data['login']}</h2>";
echo "<h4>Login : {$data['login']} </h4>";
echo "<h4>Status : {$data['status']} </h4>";
if(sizeof($marks) != 0){
  $total = sizeof($marks);
  $moyenne = 0;
  foreach ($marks as $idKey => $valeur) {
      foreach ($valeur as $test => $ma) {
        if($test == "mark" && $test != "0"){
          $moyenne += $ma;
        }
    }
    $moyenne2 = $moyenne / $total;
  }
  $format_moyenne = number_format($moyenne2, 2); //l'arrondi
  echo "<h4>Notes :  {$format_moyenne}(moyenne), {$total} notes au total</h4>";
}else{
  echo "<h4>Notes :  pas encore de notes</h4>";
}



?>
