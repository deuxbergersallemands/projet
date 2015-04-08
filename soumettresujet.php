<?php 
	session_start();
	require_once("connexion_base.php");
	require_once("requete.php");
	require_once("accueil_requetes.php");
	require_once("genre_requete.php");


	$id_personne = $_SESSION['id_personne'];

	$requete="SELECT * FROM forum_categorie";  // Retourner le id_personne de l'utilisateur!
	$response = $pdo->prepare($requete);
	$response->execute();

	$categories = $response->fetchAll();

	if (!empty($_POST)) {
		$titre = $_POST['titre'];
		$texte = $_POST['texte'];			
		$cats = $_POST['categories']; 

		$requete3="INSERT INTO forum_subjet (texte, utilisateur, date_soumis) VALUES (?, ?, NOW())";
		$response3=$pdo->prepare($requete3);
		$response3->execute(array($titre, $id_personne));

		$id_sujet = $pdo->lastInsertId();
		echo "$id_sujet"; 

		foreach ($cats as $id_cat) {
			$requete4="INSERT INTO forum_sujet_categorie (id_sujet, id_commentaire) VALUES (?, ?)";
			$reponse4 =$pdo->prepare($requete4);
			$reponse4->execute(array($id_sujet, $id_cat));
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
				<form action="soumettresujet.php" method="post" id="soumettresujet" >
					<input type="text" class="form-control" name="titre" placeholder="Titre du fil"/>
					<textarea class="form-control" name="texte" placeholder="Écrivez ici!"></textarea>
					<select multiple name="categories[]">
				    <?php
						for ($i=0; $i<count($categories); $i++) {
								echo "<option type='radio' name='etiquette' value='".$categories[$i]['id_categorie']."'>".$categories[$i]['texte']."</option>";
						}
					 ?>
					</select>
					<input type="submit" name="submit" value="Envoyer"/>
				</form>
 			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>