<?php
session_start();
include('db.php'); // Inclusion de la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Vérification des informations de connexion
    $sql = "SELECT * FROM utilisateurs WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass == $row['password']) {
            $_SESSION['username'] = $user;
            echo "Connexion réussie"; // Ajoute le point-virgule ici
            exit(); // Ajoute exit pour stopper l'exécution après la redirection
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form action="login.php" method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required><br><br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <p>Pas encore de compte ? <a href="signup.php">Créer un compte</a></p>
</body>
</html>

