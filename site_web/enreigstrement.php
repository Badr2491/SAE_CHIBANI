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
        /*
<!--//connexion à  ldap 
session_start();

// Paramètres du serveur LDAP
$ldap_server = "ldap://votre-serveur-ldap"; // Adresse du serveur LDAP
$ldap_port = 389;                          // Port par défaut pour LDAP
$ldap_base_dn = "ou=intranet,dc=exemple,dc=com"; // Base DN de recherche

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Connexion au serveur LDAP
    $ldap_conn = ldap_connect($ldap_server, $ldap_port);

    if (!$ldap_conn) {
        die("Impossible de se connecter au serveur LDAP.");
    }

    // Activer LDAP v3
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

    // Chercher l'utilisateur dans le serveur LDAP
    $ldap_filter = "(uid=$user)"; // Filtre LDAP basé sur l'UID
    $search_result = ldap_search($ldap_conn, $ldap_base_dn, $ldap_filter);

    if (!$search_result) {
        echo "Erreur dans la recherche LDAP.";
        exit();
    }

    // Récupérer les entrées trouvées
    $entries = ldap_get_entries($ldap_conn, $search_result);

    if ($entries['count'] > 0) {
        $user_dn = $entries[0]['dn']; // Récupère le DN complet de l'utilisateur

        // Vérification du mot de passe
        if (@ldap_bind($ldap_conn, $user_dn, $pass)) {
            // Authentification réussie
            $_SESSION['username'] = $user;
            header('Location: connexion_wi.php'); // Rediriger vers la page d'accueil
            exit();
        } else {
            // Mot de passe incorrect
            header('Location: intranet.php?error=invalid');
            exit();
        }
    } else {
        // Utilisateur non trouvé
        header('Location: intranet.php?error=nouser');
        exit();
    }

    // Fermer la connexion LDAP
    ldap_close($ldap_conn);
}
*/-->

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

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des informations du formulaire
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe dans la table 'intranet'
    $sql = "SELECT * FROM intranet WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Connexion réussie
        $_SESSION['username'] = $user;
        header('Location: connexion_wi.php'); // Rediriger vers la page d'accueil
        exit();
    } else {
        // Nom d'utilisateur ou mot de passe incorrect
        header('Location: intranet.php?error=invalid');
        exit();
    }
}

// Fermer la connexion
$conn->close();
?>

