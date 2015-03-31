<?php 
	session_start();
	require_once("connexion_base.php");

	switch ($_POST['submit']) {
		case 'afficher':
			$id_chanson = $_POST['id_chanson'];

			$requeteChanson="SELECT * FROM chanson WHERE id_chanson = $id_chanson";  // Retourner le id_personne de l'utilisateur!
			$responseChanson = $pdo->prepare($requeteChanson);
			$responseChanson->execute();

			$chanson = $responseChanson->fetchAll();
			$_SESSION['titre'] = $chanson[0]['titre'];
			$_SESSION['interprete'] = $chanson[0]['interprete'];
			$_SESSION['paroles'] = $chanson[0]['paroles'];
			$_SESSION['lien'] = $chanson[0]['lien'];
			$_SESSION['id_chanson'] = $id_chanson;
			break;

		case 'commentaire_soumis':
			$nouveau_commentaire = $_POST['commentaire'];
			$id_utilisateur = $_SESSION['id_personne'];
			$id_chanson = $_SESSION['id_chanson'];

			$requete3="INSERT INTO commentaire (texte, id_utilisateur, id_chanson, date_soumise) VALUES (?, ?, ?, NOW())";
			$response3=$pdo->prepare($requete3);
			$response3->execute(array($nouveau_commentaire, $id_utilisateur, $id_chanson));			
		break;
	}
	/**
	 * Trouver les commentaires liés avec cette chanson
	 **/
	$requete="SELECT * FROM commentaire WHERE id_chanson = $id_chanson";  // Retourner les commentaires pour une chanson
	$response = $pdo->prepare($requete);
	$response->execute();
	$commentaires = $response->fetchAll();

	/**
	 * Trouver les pseudos liés avec les commentaires
	 **/
	$requete2="SELECT pseudo FROM personne INNER JOIN commentaire  WHERE personne.id_personne = commentaire.id_utilisateur AND commentaire.id_chanson = $id_chanson";
	$response2 = $pdo->prepare($requete2);
	$response2->execute();
	$pseudo = $response2->fetchAll();
	
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
				<?php
					echo "<h3> ".$_SESSION['titre']."</h3>
						<h5> de ".$_SESSION['interprete']."</h5>";
				?>
				<div class="etiquettes">
					<div class="etiquette">Passe-Compose</div>
					<div class="etiquette">Plus-Que-Parfait</div>
					<div class="etiquette">Plus-Que-Parfait</div>
				</div>
				<div class="paroles">
					<?php
						echo "<p> ".$_SESSION['paroles']."</p>"; 
					?>
				</div>
				<div class="lien">
					<?php
						echo "<a href=".$_SESSION['lien']." target='_blank'> Cliquez ici pour écouter ".$_SESSION['titre']."</a>";  
					?>
				</div>
				<div>
					<form action='chanson.php' method='post'>
						<p> Pensez à laisser un commentaire </p>
						<textarea name='commentaire' class='form-control'> </textarea>
						<button type='submit' class='btn btn-primary' name='submit' value='commentaire_soumis'></button>
					</form>
				</div>
				<div class="commentaires">
					<?php 
						for ($i=0; $i<count($commentaires); $i++) {
						echo "<div class='commentaire'> 
								<h5>".$pseudo[$i]['pseudo']."</h5>
								<hl>
								<p>".$commentaires[$i]['texte']."</p>
							</div>";  
						} 
					?> 			
				</div>
 			</div>
		</div>
		<footer>
			<a href="http://www.yahoo.fr"> Contactez-nous! </a>
		</footer> 
	</body>
</html>