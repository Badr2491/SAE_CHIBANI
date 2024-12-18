<?php
// Redirection si l'utilisateur est déjà connecté (ajoutez une vérification si nécessaire)
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');  // Redirige vers le tableau de bord si connecté
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon Projet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mon Projet</h1>
            </div>
            <ul class="nav-links">
                <li><a href="enreigstrement.php">S'inscrire</a></li>
                <li><a href="connexion.php">Se connecter</a></li>
                <li><a href="intranet.php">Intranet</a></li>

            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h2>Bienvenue sur notre plateforme !</h2>
            <p>Créez votre compte et commencez à profiter de nos services exclusifs.</p>
            <a href="enreigstrement.php" class="btn-primary">Créer un compte</a>
            <a href="connexion.php" class="btn-secondary">Se connecter</a>
            <a href="intranet.php" class="btn-intranet">Intranet</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mon Projet - Tous droits réservés</p>
    </footer>
</body>
</html>
