<?php 
	session_start();
	require_once("connexion_base.php");

	$pseudo = $_SESSION['pseudo'];
	echo "<h1> $psuedo </h1>";

	$requete2="SELECT id_personne FROM personne WHERE pseudo = '$pseudo'";  // Retourner le id_personne de l'utilisateur!
	$response2 = $pdo->prepare($requete2);
	$response2->execute();

	$enregistrements = $response2->fetchAll();

	$_SESSION['id_personne'] = $enregistrements[0]['id_personne'];

	$requeteChanson="SELECT * FROM chanson WHERE id_chanson > ((SELECT COUNT(*) FROM chanson) - 10)";  // Retourner le id_personne de l'utilisateur!
	$responseChanson = $pdo->prepare($requeteChanson);
	$responseChanson->execute();

	$chansonsRecentes = $responseChanson->fetchAll();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="css/accueil.css" rel="stylesheet" type="text/css" media="all"/>
		<title> UnBergerAllemand </title>
	</head>
	<body>
		<header>
			<h1> BergerAllemand </h1>
			<a href="soumettrechanson.php"> Soumettre une chanson! </a> 
			<form action="deconnexion.php" method="post">
				<button type="submit" class="btn btn-warning"> Déconnexion </button>
			</form>
		</header>
		<?php
			if ($_SESSION['pseudo'])
				echo "<p> Hello ".$_SESSION['pseudo']."</p>";
		?>
		<div class="boite-centrale">
			<div class="rechercher-niveau">
				<h4> Rechercher à partir du difficulté: </h4>
				<form action="niveau.php" method="get">
					<button name="niveau" class="btn btn-primary" type="submit" value="debutant">Débutant</button>
					<br>
					<button name="niveau" class="btn btn-primary" type="submit" value="niveau2">niveau2</button>
					<br>
					<button name="niveau" class="btn btn-primary" type="submit" value="intermediaire">Intermediaire</button>
					<br>
					<button name="niveau" class="btn btn-primary" type="submit" value="niveau4">niveau4</button>
					<br>
					<button name="niveau" class="btn btn-primary" type="submit" value="avance">Avancé</button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<h4> Rechercher à partir de la grammaire: </h4> 
				<select multiple class="form-control">
					<option> Passé Composé </option>
					<option> Plus-Que-Parfait </option>
					<option> Futur Proche </option>
					<option> Argot </option>
					<option> Présent </option>
					<option> Imparfait </option>
					<option> Futur Simple </option>
					<option> .... </option> 
				</select>
			</div>
			<div class="favoris">
 				<h4> Récemment ajoutées </h4> 
				<table class="table-condensed table-bordered table-hover table-striped table">
					<tr>
						<th> Chanson </th>
						<th> Interpète </th>
						<th> Date Soumise </th> <!-- Remplacer avec 'niveau' et peut-être des catégories-->
						<th> En savoir plus </th>
					</tr>
					<?php
						for ($i = count($chansonsRecentes)-1; $i >= 0; $i--) {
							echo "<tr>
									<td>".$chansonsRecentes[$i]['titre']."</td>
									<td>".$chansonsRecentes[$i]['interprete']."</td>
									<td>".$chansonsRecentes[$i]['date_soumise']."</td>
									<td> <form action='chanson.php' method='post'><button type='submit' name='id_chanson' value='".$chansonsRecentes[$i]['id_chanson']."' class='btn btn-primary'>En Savoir Plus </button></form></td>  
								  </tr>";
						}
					?>
				</table>
			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>