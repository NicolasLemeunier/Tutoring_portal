<?php

$deco = $this->router->getTutoringListPageURL();

?>

 <div id="wrapper">
   <div id="menu">
         <p class="welcome"><?php echo "Bienvenue {$_SESSION['user']->getLogin()} au tutorat {$data['category']}";?><b></b></p>
         <p class="logout"><a id="exit" href="<?php echo $deco;?>">Quitter le Chat</a></p>
         <div style="clear:both"></div>
     </div>

     <div id="chatbox"></div>

     <form name="message" action="">
         <input name="usermsg" type="text" id="usermsg" size="63" />
         <input name="submitmsg" type="submit"  id="submitmsg" value="Envoyer" />
     </form>
 </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
 // jQuery Document
 $(document).ready(function(){
   $("#exit").click(function(){
          var exit = confirm("Quitter le chat ?");
          if(exit==true){
            window.location = "<?php $deco;?>";
          }
      });
 });
 //If user submits the form
	$("#submitmsg").click(function(){
  		var clientmsg = $("#usermsg").val();
  		$.post("post.php", {text: clientmsg});
  		$("#usermsg").attr("value", "");
  		return false;
	});
 </script>

 <?php


?>
