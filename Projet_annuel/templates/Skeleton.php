<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel = "stylesheet" href = "style.css">
		<title><?php echo $this->title; ?></title>
	</head>
	<body>
		<?php include("Menu.php"); ?>
		<main>
			<?php echo $this->content; ?>
		</main>
	</body>

	<script>
	function tabs(category) {
  		var i;
  		var x = document.getElementsByClassName("Tab_content");
  		for (i = 0; i < x.length; i++) {
    		x[i].style.display = "none";  
  		}
  		document.getElementById(category).style.display = "block";  
	}

	</script>
</html>