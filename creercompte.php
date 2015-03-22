<?php 
	session_start();
	require_once("connexion_base.php");


	$psuedo = $_POST['psuedo'];
	$_SESSION['psuedo'] = $psuedo;
	$email = $_POST['email'];			
	$motdepasse = $_POST['motdepasse'];
	$confirmmdp = $_POST['comotdepasse'];

	$requete="INSERT INTO personne (psuedo, mot_de_passe, email, date_inscription) VALUES (?, ?, ?, NOW())";
	$response=$pdo->prepare($requete);
	$response->execute(array($psuedo, $motdepasse, $email));


	if (!empty($_POST)) {
		header('Location: http://localhost:8888/projet/accueil.php');   // Diriger l'utilisateur vers la page d'accueil
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
		<script src="js/index.js" type="text/javascript"> </script> 
		<title> UnBergerAllemand </title>
	</head>
	<body>
		<header>
			<h1> BergerAllemand </h1>
		</header>
		<div>
			<div class="boite-centrale">
				<h3> Créer votre compte! </h3>
				<hl> 
				<form action="creercompte.php" method="post" id="inscription">
									<input type="text" class="form-control" id="psuedo" name="psuedo" placeholder="Psuedo">
					<input type="text" class="form-control" id="email" name="email" placeholder="Addresse Email">
					<input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de Passe">
					<input type="text" class="form-control" id="confirmer" name="conmotdepasse" placeholder="Confirmer le Mot de Passe">
					<p> Pensez à mettre un photo de profil (facultatif):</p> 
					<input type="file" name="photo">
					<div class="soumettre">
						<input class="btn btn-primary"  onclick="soumettreInscription()" id="validation"/>
					</div>
				</form>
			</div>


		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>