<?php 
	session_start();
	require_once("connexion_base.php");
	require_once("requete.php");

	echo count($niveaux);

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

	if (!empty($_GET)) {
		$option = $_GET['champ'];

		if ($option == 'niveau') {
			$requete="SELECT niveau_texte FROM niveau";  // Tous les niveaux du texte!
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();

		}
		else if ($option == 'categories') {

		}
		else if ($option == 'style') {

		}
		else { // Afficher toutes les chansons 
			$requete="SELECT * FROM chanson";  // Retourner le id_personne de l'utilisateur!
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();
		}
	}
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
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button type='submit' name='champ' value='niveau'> Niveau </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button type='submit' name='champ' value='categories'> Catégories </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button type='submit' name='champ' value='style'> Style de Musique </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button type='submit' name='champ' value='toutes'> Toutes </button>
				</form>
			</div>
			<?php  /* Afficher les résultats s'il y en a*/ 
				if (count($chansons)) {
				echo "<div class='resultats'> 
						<table class=' table table-condensed table-bordered table-hover table-striped'>
							<tr>
								<th> Chanson </th>
								<th> Interpète </th>
								<th> Niveau </th>
								<th> Date Soumise </th> 
								<th> Allez-y! </th>
							</tr>";
				for ($i=0; $i<count($chansons); $i++) {
					echo "<tr>
								<td>".$chansons[$i]['titre']."</td>
								<td>".$chansons[$i]['interprete']."</td>
								<td>".$chansons[$i]['niveau']."</td>
								<td>".$chansons[$i]['date_soumise']."</td>
								<td> <form action='chanson.php' method='post'><button type='submit' name='id_chanson' value='".$chansons[$i]['id_chanson']."' class='btn btn-primary btn-xs'> Cliquez ici! </button></form></td>  

						  </tr> ";
					}		
				echo "</table>
					</div> ";
				}
			?>
			<div class="favoris">
 				<h4> Récemment ajoutées </h4> 
				<table class="table-condensed table-bordered table-hover table-striped table">
					<tr>
						<th> Chanson </th>
						<th> Interpète </th>
						<th> Niveau </th>
						<th> Date Soumise </th> <!-- Remplacer avec 'niveau' et peut-être des catégories-->
						<th> En savoir plus </th>
					</tr>
					<?php
						for ($i = count($chansonsRecentes)-1; $i >= 0; $i--) {
							echo "<tr>
									<td>".$chansonsRecentes[$i]['titre']."</td>
									<td>".$chansonsRecentes[$i]['interprete']."</td>
									<td>".$chansonsRecentes[$i]['niveau']."</td>
									<td>".$chansonsRecentes[$i]['date_soumise']."</td>
									<td> <form action='chanson.php' method='post'><button type='submit' name='id_chanson' value='".$chansonsRecentes[$i]['id_chanson']."' class='btn btn-primary btn-xs'> Cliquez pour Étudier </button></form></td>  
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