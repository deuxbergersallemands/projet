<?php 
	session_start();
	require_once("connexion_base.php");

	if (!empty($_POST)) {
		$id_chanson = $_POST['id_chanson'];

		$requeteChanson="SELECT * FROM chanson WHERE id_chanson = $id_chanson";  // Retourner le id_personne de l'utilisateur!
		$responseChanson = $pdo->prepare($requeteChanson);
		$responseChanson->execute();

		$chanson = $responseChanson->fetchAll();
		$_SESSION['titre'] = $chanson[0]['titre'];
		$_SESSION['interprete'] = $chanson[0]['interprete'];
		$_SESSION['paroles'] = $chanson[0]['paroles'];
		$_SESSION['lien'] = $chanson[0]['lien'];
	} 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/chanson.css" rel="stylesheet" type="text/css" media="all"/>
		<title> UnBergerAllemand </title>
	</head>
	<body>
		<div>
			<a href="accueil.php"> Retourner à la page d'accueil </a>
			<form action="deconnexion.php" method="post">
				<button type="submit" class="btn btn-warning"> Déconnexion </button>
			</form>
			<div class="boite-centrale">
				<?php
					echo "<h3> ".$_SESSION['titre']."</h3>
					<h5> de ".$_SESSION['interprete']."</h5>";
				?>
				<div class="etiquettes">
					<div class="etiquette">Passe-Compose</div>
					<div class="etiquette">Plus-Que-Parfait</div>
					<div class="etiquette">Plus-Que-Parfait</div>
				</div>
				<div class="paroles">
					<?php
						echo "<p> ".$_SESSION['titre']."</p>"; 
					?>
				</div>
				<div class="lien">
					<?php
						echo "<a href=".$_SESSION['lien']." target='_blank'> Cliquez ici pour écouter ".$_SESSION['titre']."</a>";  
					?>
				</div>
				<div class="commentaires">
					<div class="commentaire">
						<h5> StromaeFan  10/10/2015</h5>
						<hl>
						<p> OMG Merci bcp! </p>
					</div>
					<div class="commentaire"
						<h5> StromaeFan2  10/14/2015</h5>
						<hl>
						<p> Si tu aimes maître gims, t'es nul! </p>
					</div>
					<div class="commentaire"
						<h5> ReineDesNeiges  10/14/2015</h5>
						<hl>
						<p> Libéréeeeeeee Délivréeeeeee!</p>
					</div>				</div>
 			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>