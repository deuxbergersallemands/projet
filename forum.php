<?php 
	session_start();
	require_once("connexion_base.php");
	require_once("accueil_requetes.php");

	echo "<h1> $psuedo </h1>";

		$requete="SELECT * FROM forum_categorie";  // Retourner le id_personne de l'utilisateur!
		$response = $pdo->prepare($requete);
		$response->execute();

		$categories = $response->fetchAll();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/accueil.css" rel="stylesheet" type="text/css" media="all"/>
		<title> Page d'accueil </title>
	</head>
	<body>
		<header>
			<h1> Forum </h1>
			<a href="forum.php"> Aller au Forum </a>
			<a href="soumettresujet.php"> Soumettre un sujet </a> 
		</header>
		<?php
			if ($_SESSION['pseudo'])
				echo "<p> Hello ".$_SESSION['pseudo']."</p>";
		?>

		<div>
			<form action="forum.php" method="get">
			<?php
				for ($i=0; $i < count($categories); $i++) {
					echo "<button class='btn btn-primary' name='categorie' value='".$categories[$i]['id_categorie']."'>".$categories[$i]['texte']."</button>";
				}
			?>
			</form>
		</div>




		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>