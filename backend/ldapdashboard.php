<?php
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header('Location: intranet.php'); // Redirige vers la page de connexion si non connecté
    exit();
}

$user = $_SESSION['username']; // Nom de l'utilisateur connecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h2>Bienvenue, <?php echo htmlspecialchars($user); ?> !</h2>

    <!-- Formulaire de déconnexion -->
    <form action="logput.php" method="POST">
        <input type="submit" value="Se déconnecter">
    </form>
</body>
</html>

