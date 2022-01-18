<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel = "stylesheet" href = "style.css">
		<title><?php echo $this->title; ?></title>
	</head>
	<body>
		<?php include("Menu.php"); ?>

		<?php echo $this->content; ?>
	</body>
</html>