<?php 
	session_start();
	require_once("connexion_base.php");
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
			<div class="boite-centrale">
				<form>
					<input type="text" class="form-control" placeholder="Titre de Chanson"/>
					<input type="text" class="form-control" placeholder="Artiste"/>

					<div class="etiquettes">
						<input type="text" class="form-control" placeholder="Étiquettes"/>
					</div>
					<div class="paroles">
						<input type="textfield" class="form-control" placeholder="Paroles!"/>
					</div>
					<div class="lien">
						<input type="text" class="form-control" placeholder="Mettre un lien ici!"/>
					</div>
						<a href="accueil.php"> Envoyer </a>
				</form>
 			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>