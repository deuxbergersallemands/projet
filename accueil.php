<?php 
	session_start();
	require_once("connexion_base.php");
	require_once("accueil_requetes.php");

	echo "<h1> $psuedo </h1>";
		
	switch ($_GET['champ']) {
		case 'toutes':
			$requete="SELECT * FROM chanson";  // Retourner le id_personne de l'utilisateur!
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();
			break;
		case 'niveau_chanson':
			$niveau_demande = $_GET['niveau_chanson'];

			$requete="SELECT * FROM chanson WHERE niveau=$niveau_demande";
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();	
			break;
		case 'genre_chanson':
			$genre_demande = $_GET['genre_chanson'];

			$requete="SELECT * FROM chanson WHERE genre=$genre_demande";
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();
			break; 
		case 'categorie_chanson':
			$categorie_demande = $_GET['categorie_chanson'];

			$requete="SELECT * FROM chanson WHERE id_chanson IN (SELECT id_chanson FROM contenu_chanson WHERE id_categorie=$categorie_demande)";
			$response = $pdo->prepare($requete);
			$response->execute();

			$chansons = $response->fetchAll();
			break; 
	}
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
			<h1> Page d'accueil </h1>
			<a href="soumettrechanson.php"> Soumettre une chanson! </a> 
			<form action="deconnexion.php" method="post">
				<button type="submit" class="btn btn-warning"> Déconnexion </button>
			</form>
			<a href="forum.php"> Aller au Forum </av>
		</header>
		<?php
			if ($_SESSION['pseudo'])
				echo "<p> Hello ".$_SESSION['pseudo']."</p>";
		?>
		<div class="boite-centrale">
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button class='btn btn-info' type='submit' name='champ' value='niveau'> Niveau </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button class='btn btn-info' type='submit' name='champ' value='categories'> Catégories </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button class='btn btn-info' type='submit' name='champ' value='style'> Style de Musique </button>
				</form>
			</div>
			<div class="rechercher-grammaire">
				<form action="accueil.php" method="get">
					<button class='btn btn-info' type='submit' name='champ' value='toutes'> Toutes </button>
				</form>
			</div>
			<?php 
				if ($_GET['champ'] == 'niveau' || $_GET['champ'] == 'niveau_chanson') {
					echo "<form method='get' action='accueil.php'>";
						for ($i=0; $i<count($niveaux); $i++) {
							echo "<input type='hidden' name='champ' value='niveau_chanson'><button class='btn btn-primary' type='submit' name='niveau_chanson' value='".$niveaux[$i]['id_niveau']."'>".$niveaux[$i]['niveau_texte']."</button>";
						}
					echo "</form>";
				}
				if ($_GET['champ'] == 'categories' || $_GET['champ'] == 'categorie_chanson') {
					echo "<form method='get' action='accueil.php'>";
						for ($i=0; $i<count($categories); $i++) {
							echo "<input type='hidden' name='champ' value='categorie_chanson'><button class='btn btn-primary' type='submit' name='categorie_chanson' value='".$categories[$i]['id_categorie']."'>".$categories[$i]['texte']."</button>";
						}
					echo "</form>";
				}
				if ($_GET['champ'] == 'style' || $_GET['champ'] == 'genre_chanson') {
					echo "<form method='get' action='accueil.php'>";
						for ($i=0; $i<count($styles); $i++) {
							echo "<input type='hidden' name='champ' value='genre_chanson'><button class='btn btn-primary' type='submit' name='genre_chanson' value='".$styles[$i]['id_genre']."'>".$styles[$i]['texte']."</button>";
						}
					echo "</form>";
				}		
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
								<td> <form action='chanson.php' method='post'><input type='hidden' name='id_chanson' value='".$chansons[$i]['id_chanson']."'/><button type='submit' name='submit' value='afficher' class='btn btn-primary btn-xs'> Cliquez pour Étudier </button></form></td>   

						  </tr> ";
					}		
				echo "</table>
					</div> ";
				}
			?>

			<!-- Afficher les chasons publiées récennement -->
			<div class="favoris">
 				<h4> Dernières ajoutées </h4> 
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
									<td> <form action='chanson.php' method='post'><input type='hidden' name='id_chanson' value='".$chansonsRecentes[$i]['id_chanson']."'/><button type='submit' name='submit' value='afficher' class='btn btn-primary btn-xs'> Cliquez pour Étudier </button></form></td>  
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