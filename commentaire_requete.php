<?php 
	$requete="SELECT * FROM commentaire WHERE ";  // Retourner les commentaires pour une chanson
	$response = $pdo->prepare($requete);
	$response->execute();

	$commentaires = $response->fetchAll();
?>