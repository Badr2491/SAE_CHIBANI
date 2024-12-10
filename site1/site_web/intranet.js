function validerConnexion() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Validation simple : Vérification de la longueur du mot de passe
    var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

    // Si le mot de passe ne respecte pas les critères
    if (!regex.test(password)) {
        alert("Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
        return false;
    }

    return true;
}
