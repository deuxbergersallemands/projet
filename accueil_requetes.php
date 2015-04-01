<?php
	$requete="SELECT * FROM niveau";  // Retourner le id_personne de l'utilisateur!
	$response = $pdo->prepare($requete);
	$response->execute();

	$niveaux = $response->fetchAll();


	$pseudo = $_SESSION['pseudo'];

	$requete2="SELECT id_personne FROM personne WHERE pseudo = '$pseudo'";  // Retourner le id_personne de l'utilisateur!
	$response2 = $pdo->prepare($requete2);
	$response2->execute();

	$enregistrements = $response2->fetchAll();
	$_SESSION['id_personne'] = $enregistrements[0]['id_personne'];



	$requeteChanson="SELECT * FROM chanson WHERE id_chanson > ((SELECT COUNT(*) FROM chanson) - 10)";  // Retourner le id_personne de l'utilisateur!
	$responseChanson = $pdo->prepare($requeteChanson);
	$responseChanson->execute();

	$chansonsRecentes = $responseChanson->fetchAll();

    /**
     * Attraper toutes les catégories
     */
	$requeteCategorie="SELECT * FROM categorie"; 
	$responseCategorie = $pdo->prepare($requeteCategorie);
	$responseCategorie->execute();

	$categories = $responseCategorie->fetchAll();
?>