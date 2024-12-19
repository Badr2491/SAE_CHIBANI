<?php
session_start(); // Démarre la session

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connexion à la base de données
    $servername = "mysql:3306";
    $username = "root";
    $password = "rootpassword";
    $dbname = "compte_db";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Récupération des valeurs du formulaire
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Suppression du var_dump, car il envoie déjà une sortie au navigateur
    // var_dump($_POST); // Affiche les données envoyées par le formulaire

    // Recherche de l'utilisateur dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE username = '$user'";
    $result = $conn->query($sql);

    // Vérifier si l'utilisateur existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérification du mot de passe
        if (password_verify($pass, $row['password'])) {
            // Connexion réussie, définir la session
            $_SESSION['username'] = $row['username']; // Enregistrer l'utilisateur dans la session
            header('Location: accueil.php'); // Redirige vers la page d'accueil
            exit(); // Assurez-vous d'arrêter le script après la redirection
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="papa.css">
    <script src="intranet.js"></script> <!-- Lien vers votre fichier JavaScript -->
</head>
<body>
    <div class="container"> <!-- Conteneur ajouté pour centrer -->
        <form action="connexion.php" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Se connecter">
        </form>
        <p>Pas encore de compte ? <a href="enreigstrement.php">S'inscrire</a></p>
    </div> <!-- Fermeture du conteneur -->
</body>
</html>
