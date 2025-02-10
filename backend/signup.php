<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Vérifier si l'utilisateur existe déjà (requête préparée)
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
    $stmt->bind_param("s", $user); // "s" signifie que c'est une chaîne
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Si l'utilisateur n'existe pas, on l'ajoute (requête préparée)
        $stmt = $conn->prepare("INSERT INTO utilisateurs (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $pass); // "ss" signifie deux chaînes
        if ($stmt->execute()) {
            header('Location: login.php'); // Rediriger vers la page de connexion
            exit();
        } else {
            $error = "Erreur lors de la création de l'utilisateur.";
        }
    } else {
        $error = "L'utilisateur existe déjà.";
    }
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
</head>
<body>
    <h2>Créer un compte</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form action="signup.php" method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required><br><br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Créer le compte">
    </form>
    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
</html>

