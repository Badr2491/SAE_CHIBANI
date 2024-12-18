<?php
// Démarre la session si ce n'est pas déjà fait
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="deconnexion.css"> <!-- Si vous avez un fichier CSS -->
</head>
<body>
    <div class="message">
        <h1>Vous êtes déconnecté</h1>
        <p>Merci de votre visite. Vous avez été déconnecté avec succès.</p>
        <a href="index.php">Retour à l'accueil</a> <!-- Ou un autre lien de redirection -->
    </div>
</body>
</html>
