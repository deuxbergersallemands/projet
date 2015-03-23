<?php
	$requete="SELECT * FROM niveau";  // Retourner le id_personne de l'utilisateur!
	$response = $pdo->prepare($requete);
	$response->execute();

	$niveaux = $response->fetchAll();
?>