<?php

  $text = $_POST['text'];
  $fp = fopen("log.html", 'a');
  fwrite($fp, "<div class='msgln'>(".date("H:i:s").") <b>".$_SESSION['user']->getLogin()."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
  fclose($fp);


 ?>