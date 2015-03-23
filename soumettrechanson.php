<?php 
	session_start();
	require_once("connexion_base.php");
	$id_personne = $_SESSION['id_personne'];

	$chanson = $_POST['chanson'];
	$artiste = $_POST['artiste'];			
	$paroles = $_POST['paroles'];
	$lien = $_POST['lien'];


	$requete3="INSERT INTO chanson (titre, interprete, paroles, lien, utilisateur, date_soumise) VALUES (?, ?, ?, ?, ?, NOW())";
	$response3=$pdo->prepare($requete3);
	$response3->execute(array($chanson, $artiste, $paroles, $lien, $id_personne));


	if (!empty($_POST)) {
		header('Location: http://localhost:8888/projet/accueil.php');   // Diriger l'utilisateur vers la page d'accueil
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
				<input type="submit" class="btn btn-warning"/>
			</form>
			<div class="boite-centrale">
				<form action="soumettrechanson.php" method="post" id="soumettrechanson" >
					<input type="text" class="form-control" name="chanson" placeholder="Titre de Chanson"/>
					<input type="text" class="form-control" name="artiste" placeholder="Artiste"/>

					<div class="etiquettes">
						<input type="text" class="form-control" name="etiquettes" placeholder="Étiquettes"/>
					</div>
					<div class="paroles">
						<textarea class="form-control" name="paroles" placeholder="Paroles!"></textarea>
					</div>
					<div class="lien">
						<input type="text" class="form-control" name="lien" placeholder="Mettre un lien ici!"/>
					</div>
						<input type="submit" name="submit" value="Envoyer"/>
					</div>
				</form>
 			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>