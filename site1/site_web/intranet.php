<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Intranet</title>
    <link rel="stylesheet" href="style_int.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion à l'Intranet</h2>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'invalid') {
                echo "<p style='color: red;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
            } elseif ($_GET['error'] == 'nouser') {
                echo "<p style='color: red;'>L'utilisateur n'existe pas.</p>";
            }
        }
        ?>

        <!-- Formulaire de connexion -->
        <form action="intranet.php" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Se connecter">
        </form>

        <p>Pas encore de compte ? Contacter l'admin</p>
    </div>
</body>
</html>


<?php
session_start();

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

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des informations du formulaire
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe dans la table 'interne'
    $sql = "SELECT * FROM interne WHERE username = '$user'";
    $result = $conn->query($sql);

    if (password_verify($pass, $row['password'])) {
        // Connexion réussie
        $_SESSION['username'] = $user;
        header('Location: interne.php');
        exit();
    } else {
        // Mot de passe incorrect
        header('Location: intranet.php?error=invalid');
        exit();
    }
}

// Fermer la connexion
$conn->close();
?>

