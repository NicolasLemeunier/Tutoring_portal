<?php

$deco = $this->router->getTutoringListPageURL();
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//var_dump($data);
//echo "<h1>{$url}&logout=true</h1>"; //OK
?>

 <div id="wrapper">
   <div id="menu">
         <p class="welcome"><?php echo "Bienvenue {$_SESSION['user']->getLogin()} au tutorat {$data['category']}";?><b></b></p>
         <p class="logout"><a id="exit" href='<?php echo "$url";?>&logout=true'>Quitter le Chat</a></p>
         <div style="clear:both"></div>
     </div>

     <div id="chatbox"><?php
        if(file_exists("log.html") && filesize("log.html") > 0){
            $handle = fopen("log.html", "r");
            $contents = fread($handle, filesize("log.html"));
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
 // jQuery Document
 $(document).ready(function(){
   $("#exit").click(function(){
            var exit = confirm("Are you sure you want to end the session?");
            if(exit==true){window.location = '<?php echo "$url";?>&logout=true';}
      });
 });
 //If user submits the form
	$("#submitmsg").click(function(){
  		var clientmsg = $("#usermsg").val(); //on prends la valeur du champs
  		$.post("templates/Chat_page_post.php", {text: clientmsg});
  		$("#usermsg").attr("value", ""); //on remets la valeur du champs à vide
  		return false;
	});

  //Load the file containing the chat log and update the chat
  function loadLog(){
  		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
  		$.ajax({
  			url: "log.html",
  			cache: false,
  			success: function(html){
  				$("#chatbox").html(html); //Insert chat log into the #chatbox div

  				//Auto-scroll
  				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
  				if(newscrollHeight > oldscrollHeight){
  					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
  				    }
  		  	},
  		});
  	}
setInterval (loadLog, 2000);//1000 = 1s
 </script>

 <?php

//OK
 if(isset($_GET['logout'])){
        //Simple exit message
        if($_SESSION['user']->getStatus()=="tutor"){
          $txt = "Le tuteur";
        }else{
          $txt = "L'élève";
        }
       $logout_message = "<div class='msgln'><span class='left-info'>{$txt} <b class='user-name-left'>". $_SESSION['user']->getLogin() ."</b> a quitté le chat.</span><br></div>";
       file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);

       header("Location: $deco"); //Redirect the user
 }

?>
