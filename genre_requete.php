<?php
	$requete="SELECT * FROM genre";  // Retourner le id_personne de l'utilisateur!
	$response = $pdo->prepare($requete);
	$response->execute();

	$genres = $response->fetchAll();
?>