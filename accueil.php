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
		</header>
		<?php
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
 				<h4> Vos résultats vont s'afficher au-dessous! </h4> 
				<select multiple class="form-control">
					<option> "Papaoutai" de Stromae [Niveau/Difficulté *****] </option>
					<option> "Zombie" de Maître Gims [Niveau *****] </option>
					<option> "Dernière Danse" de Kyo [Niveau **] </option>
					<option> "Où Est Ma Tête" de Pink Martini [Niveau *] </option>
					<option> "Aïcha" de Cheb Khaled [Niveau ***]</option>
					<option> "Elle Me Dit" de MIKA [Niveau *] </option>
					<option> "Sur Ma Route" de Black M [Niveau ****] </option>
					<option> "Papaoutai" de Stromae [Niveau/Difficulté *****] </option>
					<option> "Zombie" de Maître Gims [Niveau *****] </option>
					<option> "Dernière Danse" de Kyo [Niveau **] </option>
					<option> "Où Est Ma Tête" de Pink Martini [Niveau *] </option>
					<option> "Aïcha" de Cheb Khaled [Niveau ***]</option>
					<option> "Elle Me Dit" de MIKA [Niveau *] </option>
					<option> "Sur Ma Route" de Black M [Niveau ****] </option>
					<option> "Papaoutai" de Stromae [Niveau/Difficulté *****] </option>
					<option> "Zombie" de Maître Gims [Niveau *****] </option>
					<option> "Dernière Danse" de Kyo [Niveau **] </option>
					<option> "Où Est Ma Tête" de Pink Martini [Niveau *] </option>
					<option> "Aïcha" de Cheb Khaled [Niveau ***]</option>
					<option> "Elle Me Dit" de MIKA [Niveau *] </option>
					<option> "Sur Ma Route" de Black M [Niveau ****] </option>
					<option> "Papaoutai" de Stromae [Niveau/Difficulté *****] </option>
					<option> "Zombie" de Maître Gims [Niveau *****] </option>
					<option> "Dernière Danse" de Kyo [Niveau **] </option>
					<option> "Où Est Ma Tête" de Pink Martini [Niveau *] </option>
					<option> "Aïcha" de Cheb Khaled [Niveau ***]</option>
					<option> "Elle Me Dit" de MIKA [Niveau *] </option>
					<option> "Sur Ma Route" de Black M [Niveau ****] </option>
				</select>
			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>