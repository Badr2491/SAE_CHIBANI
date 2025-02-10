<?php
// Démarrer la session et vérifier si l'utilisateur est déjà connecté
session_start();
if (isset($_SESSION['username'])) {
    // Si l'utilisateur est connecté, redirige-le vers le tableau de bord
    header('Location: dashboard.php');
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
                <!-- Lien d'inscription -->
                <li><a href="signup.php">S'inscrire</a></li>
                <!-- Lien de connexion -->
                <li><a href="login.php">Se connecter</a></li>
                <!-- Lien vers l'intranet -->
                <li><a href="intranet.php">Intranet</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h2>Bienvenue sur notre plateforme !</h2>
            <p>Créez votre compte et commencez à profiter de nos services exclusifs.</p>
            <!-- Boutons d'action -->
            <a href="signup.php" class="btn-primary">Créer un compte</a>
            <a href="login.php" class="btn-secondary">Se connecter</a>
            <a href="intranet.php" class="btn-intranet">Intranet</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mon Projet - Tous droits réservés</p>
    </footer>
</body>
</html>

