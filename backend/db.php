<?php
// db.php - Connexion à la base de données MySQL

$servername = "mysql"; // Nom du service MySQL dans Docker
$username = "root";
$password = "rootpassword"; // Mot de passe de la base de données
$dbname = "compte_db"; // Nom de la base de données

// Connexion à la base de données MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>

