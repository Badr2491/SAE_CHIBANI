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
 


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
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

    // Recherche de l'utilisateur dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Vérification du mot de passe
        if (password_verify($pass, $row['password'])) {
            echo "Connexion réussie.";
            header('Location: connexion_wi.php');
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la connexion
    $conn->close();
}
?>
 
