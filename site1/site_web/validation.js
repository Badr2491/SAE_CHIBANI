function validerConnexion() {
    // Récupérer les valeurs des champs
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Vérification si les champs sont vides
    if (username == "" || password == "") {
        alert("Veuillez remplir tous les champs.");
        return false;
    }

    // Validation du mot de passe
    var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/; // Au moins 8 caractères, une majuscule et un chiffre
    if (!regex.test(password)) {
        alert("Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
        return false;
    }

    // Si tout est ok, afficher le message de connexion réussie (pour simulation)
    var successMessage = document.getElementById('success-message');
    successMessage.style.display = "block";

    // Simulation de la soumission du formulaire (vous pouvez remplacer cela par une vraie vérification côté serveur)
    setTimeout(function() {
        window.location.href = "index.php"; // Rediriger vers la page d'accueil après 2 secondes
    }, 2000);

    return false; // Empêche la soumission du formulaire (à remplacer par votre traitement PHP)
}
