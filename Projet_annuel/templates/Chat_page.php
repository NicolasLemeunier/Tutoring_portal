<?php

$deco = $this->router->getTutoringListPageURL();
//$ended = $this->router->getEndedTutoringURL($data['id']);

$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$filename = "logs/log".$data['id'].".html"; // chaque tutorat à son fichier différent(pour differencer les chats)
//var_dump($data);

if(isset($_SESSION['user'])){
  // AFFICHE TROP DE FOIS 'a rejoint le chat'!!! A REGLER !!!!
  $txt = "";
  //if(isset($_POST['text']) && $_POST['text'] == ""){
    if($_SESSION['user']->getStatus()=="Tutor"){
      $txt = "Le tuteur";
    }else if($_SESSION['user']->getStatus()=="Student"){
      $txt = "L'élève";
    }
    $login_message = "<div class='msgln'><span style='color:green' class='in-info'>{$txt} <a style='color:green' title='Voir profil de {$_SESSION['user']->getLogin()}' href=".$this->router->getProfilURL($_SESSION['user']->getID())."><b>".$_SESSION['user']->getLogin()."</b></a> a rejoint le chat</span><br></div>";
    file_put_contents($filename, $login_message, FILE_APPEND);
    //}
}
?>

 <div id="wrapper">
   <div id="menu">
         <p class="welcome"><?php echo "Bienvenue {$_SESSION['user']->getLogin()} au tutorat {$data['category']}";?><b></b></p>
         <p class="logout"><a id="exit" href='#'>Quitter le Chat</a></p>
         <div style="clear:both"></div>
     </div>

     <div id="chatbox"><?php
        if(file_exists($filename) && filesize($filename) > 0){
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);

            echo $contents;
        }
        ?>
     </div>

     <form name="message" action="">
         <input name="usermsg" type="text" id="usermsg" size="63" />
         <input name="submitmsg" type="submit"  id="submitmsg" value="Envoyer" />
     </form>
 </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
 // jQuery Document :


 $(document).ready(function(){
   $("#exit").click(function(){
            var exit = confirm("Quitter le chat ?");
            if(exit==true){window.location = '<?php echo "$url";?>&logout=true';}
      });
 });
 //If user submits the form
	$("#submitmsg").click(function(){
      // C'EST LA QUE ÇA BUGG
  		var clientmsg = $("#usermsg").val(); //on prends la valeur du champs
  		$.post("", {text: clientmsg});
  		$("#usermsg").attr("value", ""); //on remets la valeur du champs à vide
  		return false;
	});

  //Load the file containing the chat log and update the chat
  function loadLog(){
  		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
  		$.ajax({
  			url: "<?php echo $filename;?>",
  			cache: false,
  			success: function(html){
  				$("#chatbox").html(html); //Insert chat log into the #chatbox div
  				//Auto-scroll
  				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
  				if(newscrollHeight > oldscrollHeight){
  					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
  				    }
  		  	},
          error: function(){
            //quand le tuteur supprime le tutorat
            window.location = '<?php echo "$url";?>&ended';
          },
  		});
  	}

setInterval (loadLog, 1000);// update tous les : 1000 = 1s
 </script>


 <?php

//OK
 if(isset($_GET['logout'])){
        //Message de déconnexion
        if($_SESSION['user']->getStatus()=="Tutor"){
          $txt = "Le tuteur";
        }else{
          $txt = "L'élève";
        }
        $logout_message = "<div class='msgln'><span style='color:red' class='left-info'>{$txt} <a title='Voir profil de {$_SESSION['user']->getLogin()}' href=".$this->router->getProfilURL($_SESSION['user']->getID())."><b class='user-name-left'>".$_SESSION['user']->getLogin()."</b></a> a quitté le chat</span><br></div>";
       file_put_contents($filename, $logout_message, FILE_APPEND | LOCK_EX);
       header("Location: $deco"); //Redirect the user
 }

//OK
 if(isset($_SESSION['user'])){
   //pour écrore le message dans le log
   if(isset($_POST['text']) && $_POST['text'] != ""){
     $text = $_POST['text'];
     $fp = fopen($filename, 'a');
     fwrite($fp, "<div class='msgln'>(".date("H:i:s").") <a title='Voir profil de {$_SESSION['user']->getLogin()}' href=".$this->router->getProfilURL($_SESSION['user']->getID())."><b>".$_SESSION['user']->getLogin()."</b></a>: ".stripslashes(htmlspecialchars($text))."<br></div>");
     fclose($fp);
   }
 }

?>
