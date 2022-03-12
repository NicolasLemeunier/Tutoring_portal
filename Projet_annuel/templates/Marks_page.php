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
          echo "{$student['student']}";
          echo "<div class='stars'>
              		<i class='lar la-star' data-value='1'></i>
              		<i class='lar la-star' data-value='2'></i>
              		<i class='lar la-star' data-value='3'></i>
              		<i class='lar la-star' data-value='4'></i>
              		<i class='lar la-star' data-value='5'></i>
                </div>";
        }
      }else{
        foreach ($studentRegistered as $key => $student) {
          echo "{$student['tutor']}, note ?";
        }
      }

   ?>

</div>
