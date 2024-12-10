<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost"; // Ou l'adresse de votre serveur de base de données
    $usernameDB = "root"; // Nom d'utilisateur
    $passwordDB = ""; // Pas de mot de passe
    $dbname = "bdd"; // Nom de votre base de données

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    // Récupération des données du formulaire
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Validation du mot de passe
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)) {
        echo "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre.";
    } else {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion de l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (username, password) VALUES ('$username', '$hashedPassword')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Compte créé avec succès !";
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
