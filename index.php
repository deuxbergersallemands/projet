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
				<form action="accueil.php" method="get" id="connection">
					<p> Pour vous connecter, veuillez remplir les champs au-dessous! </p> 
					<input class ="form-control" type="text" id="identifiant" name="identifiant" placeholder="Identifiant"/>
					<input class="form-control" type="text" id="motDePasse" name="motDePasse" placeholder="Mot de passe"/>
					<div class="soumettre">
						<input class="btn btn-primary"  onclick="soumettreConnection()" id="validation"/>
					</div>
					<hr>
					<a href="creercompte.php"> Vous n'avez pas de compte? Vous pouvez vous inscrire en cliquant ici! </a> 
				</form>
			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>