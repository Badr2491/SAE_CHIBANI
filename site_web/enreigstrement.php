<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement - Compte interne</title>
    <link rel="stylesheet" href="mama.css">
    <script src="validation.js"></script> <!-- Lien vers votre fichier JavaScript -->
 

</head>
<body>
    <h2>Créer un compte</h2>
    <form action="enreigstrement.php" method="POST" onsubmit="return validerConnexion()">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirmer le mot de passe:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Enregistrer">
    </form>
    <p>Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>
</body>
</html>

<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";  // Utilisateur de base pour XAMPP
    $password = "";      // Mot de passe par défaut pour XAMPP
    $dbname = "compte_db";  // Nom de votre base de données

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Récupération des données du formulaire
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Cryptage du mot de passe

    // Vérification si l'utilisateur existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);  // "s" signifie string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Nom d'utilisateur déjà pris.";
    } else {
        // Insertion de l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $pass);  // "ss" pour deux chaînes de caractères
        if ($stmt->execute()) {
            // Rediriger vers la page de connexion après un enregistrement réussi
            header("Location: connexion.php");  // Redirige vers la page de connexion
            exit();  // Assurez-vous que le script s'arrête ici pour éviter toute autre exécution
        } else {
            echo "Erreur d'enregistrement : " . $conn->error;
        }
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>
