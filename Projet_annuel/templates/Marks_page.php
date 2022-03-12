<?php

var_dump($studentRegistered);

if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() == "Tutor"){
  $titre = "Noter vos élèves";
  $status = "tutor";
}else if(isset($_SESSION['user']) && $_SESSION['user']->getStatus() == "Student"){
  $titre = "Noter votre tuteur";
  $status = "student";
}


 ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="style.css">
 <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
 <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
 <script>

 $( function() {

   function finish(){
     window.location = '<?php echo $this->router->getTutoringListPageURL(); ?>';
   }

   $( "#dialog" ).dialog({
      autoOpen: true,
      height: 400,
      width: 350,
      modal: true,
      button : {
        "J'ai finis" : finish
      }
   });
});



</script>



<div id="dialog" title="<?php echo $titre; ?>">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<?php
      if($status == "tutor"){
        foreach ($studentRegistered as $key => $student) {
          //marche que si ya un seul étudiant
          /*
          echo "<form action={$this->router->getTutoringListPageURL()} method=\"post\">
                    <div class='stars'>
                    <a title='Voir profil de {$student['student']}' href=".$this->router->getProfilURL($student['student'])."><b>".$student['student']."</b></a>
                		<i class='lar la-star' data-value='1'></i><i class='lar la-star' data-value='2'></i><i class='lar la-star' data-value='3'></i><i class='lar la-star' data-value='4'></i><i class='lar la-star' data-value='5'></i>
                  </div>
                  <input type='hidden' name='note' id='note' value='0'>
                  <input type='hidden' name='student' id='student' value='{$student['student']}'>
                  <button type=\"submit\">Valider</button>
                </form>";
                  */
        }
      }
      else if($status == "student"){
        echo "<form action={$this->router->getTutoringListPageURL()} method=\"post\">
                  <div class='stars'>
                  <a title='Voir profil de {$studentRegistered[0]['tutor']}' href=".$this->router->getProfilURL($studentRegistered[0]['tutor'])."><b>".$studentRegistered[0]['tutor']."</b></a>
                  <i class='lar la-star' data-value='1'></i><i class='lar la-star' data-value='2'></i><i class='lar la-star' data-value='3'></i><i class='lar la-star' data-value='4'></i><i class='lar la-star' data-value='5'></i>
                </div>
                <input type='hidden' name='note' id='note' value='0'>
                <input type='hidden' name='tutor' id='tutor' value='{$studentRegistered[0]['tutor']}'>
                <button type=\"submit\">Valider</button>
              </form>";
          }

   ?>
<script src="scripts.js"></script>
</div>
