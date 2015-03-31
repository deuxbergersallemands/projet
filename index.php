<?php
	session_start();
	require_once("connexion_base.php");

	if (!empty($_POST)) {
		$pseudo = $_POST['identifiant'];
		$motdepasse = $_POST['motdepasse'];

		$requete="SELECT * FROM personne WHERE pseudo = '$pseudo'";  // Retourner le id_personne de l'utilisateur!
		$response = $pdo->prepare($requete);
		$response->execute();

		$pseudoArray = $response->fetchAll();

		if (count($pseudoArray)) {
			if ($pseudoArray[0]['mot_de_passe'] == $motdepasse) {  // Vérifier mot de passe
				$_SESSION['pseudo'] = $pseudo; // Ajouter à la session
				header('Location: http://localhost:8888/projet/accueil.php');   // Diriger l'utilisateur vers la page d'accueil
			}
			else 
				echo "<script> alert('Le mot de passe nest pas juste!'); </script>";
		}
		else 
			echo "<script> alert('Ce pseudo nexiste pas!'); </script>";
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="telechargements/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/maintenant.css" rel="stylesheet" type="text/css" media="all"/>

		<script src="js/index.js" type="text/javascript"> </script> 

		<title> UnBergerAllemand </title>
	</head>
	<body>
		<header>
		</header>
		<div>
			<div class="boite-centrale">
				<form action="index.php" method="post" id="connection">
					<p> Pour vous connecter, veuillez remplir les champs au-dessous! </p> 
					<div class="champs-login">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						<input class ="form-control" type="text" id="identifiant" name="identifiant" placeholder="Identifiant ou Email"/>
					</div> 
					<div> 
						<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
						<input class="form-control" type="password" id="motDePasse" name="motdepasse" placeholder="Mot de passe"/>
					</div class="champs-login">
					<div class="soumettre">
						<input class="btn btn-primary"  onclick="soumettreConnection()" id="validation"/>
					</div>
					<hr>
					<a href="creercompte.php"> Vous n'avez pas de compte? Vous pouvez vous inscrire en cliquant au-dessous! </a> 
				</form>
			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>