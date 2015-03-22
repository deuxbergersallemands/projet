function soumettreConnection() {
	var form = document.getElementById('connection');
	if ((document.getElementById('identifiant').value).length > 0 && (document.getElementById('motDePasse').value).length > 0)
		form.submit();
	else {
		alert("Vous avez oublié de remplir votre ID ou mot de passe! Veuillez essayer à nouveau!");
		return false;
	}
}

function soumettreInscription() {
	var form = document.getElementById('inscription');
	if ((document.getElementById('confirmer').value).length > 0 && (document.getElementById('psuedo').value).length > 0 && (document.getElementById('email').value).length > 0 && (document.getElementById('motdepasse').value).length > 0)
		form.submit();
	else {
		alert("Vous n'avez pas rempli tous les champs! Veuillez essayer à nouveau!");
		return false;
	}
}