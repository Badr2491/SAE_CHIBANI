<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    exit();
}

echo "Bienvenue, " . $_SESSION['username'] . "!";
?>

<p><a href="logout.php">Déconnexion</a></p>
