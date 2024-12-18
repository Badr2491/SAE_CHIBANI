<?php
session_start();

// Vérifier si l'utilisateur est bien connecté
if (!isset($_SESSION['username'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header('Location: connexion_wi.php');
    exit();
}

// Récupérer le nom d'utilisateur depuis la session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet - Accueil</title>
    <link rel="stylesheet" href="interne.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenue, <?php echo htmlspecialchars($username); ?>, sur le site !</h1>
        <p>Ceci est votre espace réservé. Vous pouvez accéder à des ressources et des services exclusifs.</p>

        <a href="deconnexion.php" class="btn-secondary">Se déconnecter</a>
    </div>
</body>
</html>

