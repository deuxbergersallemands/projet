<?php 
	session_start();
	require_once("connexion_base.php");
	require_once("requete.php");
	require_once("accueil_requetes.php");
	require_once("genre_requete.php");


	$id_personne = $_SESSION['id_personne'];


	if (!empty($_POST)) {
		$chanson = $_POST['chanson'];
		$artiste = $_POST['artiste'];			
		$paroles = $_POST['paroles'];
		$niveau = $_POST['niveau'];
		$genre = $_POST['genre'];
		$lien = $_POST['lien'];
		$cats = $_POST['categories'];

		$requete3="INSERT INTO chanson (titre, interprete, paroles, niveau, genre, lien, utilisateur, date_soumise) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
		$response3=$pdo->prepare($requete3);
		$response3->execute(array($chanson, $artiste, $paroles, $niveau, $genre, $lien, $id_personne));

		$id_chanson = $pdo->lastInsertId();

		foreach ($cats as $id_cat) {
			$requete4="INSERT INTO contenu_chanson (id_categorie, id_chanson, date_soumise) VALUES (?, ?, NOW())";
			$reponse4 =$pdo->prepare($requete4);
			$reponse4->execute(array($id_cat, $id_chanson));
		}

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
				<form action="soumettrechanson.php" method="post" id="soumettrechanson" >
					<input type="text" class="form-control" name="chanson" placeholder="Titre de Chanson"/>
					<input type="text" class="form-control" name="artiste" placeholder="Artiste"/>
					<select multiple name="categories[]">
				    <?php
						for ($i=0; $i<count($categories); $i++) {
								echo "<option type='radio' name='etiquette' value='".$categories[$i]['id_categorie']."'>".$categories[$i]['texte']."</option>";
						}
					 ?>
					</select>
					<div class="paroles">
						<textarea class="form-control" name="paroles" placeholder="Paroles!"></textarea>
					</div>
					<div class="niveau">
						<?php
							for ($i=0; $i<count($niveaux); $i++) {
								echo "<input type='radio' name='niveau' value='".$niveaux[$i]['id_niveau']."'>".$niveaux[$i]['niveau_texte']."</input>";
							}
						?>
					</div>
					<div class="genre">
						<?php
							for ($i=0; $i<count($genres); $i++) {
								echo "<input type='radio' name='genre' value='".$genres[$i]['id_genre']."'>".$genres[$i]['texte']."</input>";
							}
						?>
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