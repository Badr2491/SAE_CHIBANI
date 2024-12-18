<?php
session_start(); // Démarre la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: connexion.php'); 
    exit(); // Assurez-vous que le script s'arrête ici après la redirection
}

// Récupérer le nom d'utilisateur depuis la session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Accueil</title>
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenue, <?php echo htmlspecialchars($username); ?>, sur le dash !</h1>
        <p>Ceci est votre espace réservé. Vous pouvez accéder à des ressources et des services exclusifs.</p>

        <a href="deconnexion.php" class="btn-secondary">Se déconnecter</a>
    </div>
</body>
</html>
