<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="skin/style.css">

	<title><?php echo $this->title; ?></title>
</head>
<body>
<nav  class="menu">
		<ul>
<?php
	
/* Construit le menu à partir d'un tableau associatif texte=>lien. */
foreach ($this->getMenu() as $text => $link) {
	echo "<li><a href=\" $link \">$text</a></li>";
}
?>
		</ul>
	</nav>
	

	<main>
	    <?= $this->feedback; ?>
		<h1><?= $this->title; ?></h1>
		<?= $this->content; ?>
		<img src="..images/index.jpg" alt="">
	</main>
	
</body>
</html>


