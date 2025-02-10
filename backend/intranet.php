<?php
// Démarrer la session pour gérer l'authentification
session_start();

// Paramètres du serveur LDAP
$ldap_server = "ldap://localhost:";  // Adresse du serveur LDAP
$ldap_port = 389;  // Port du serveur LDAP (standard 389, ou 636 pour LDAPS)
$ldap_base_dn = "dc=momo,dc=com"; // Base DN de recherche
$ldap_admin_dn = "cn=admin,dc=momo,dc=com";  // DN de l'administrateur LDAP
$ldap_admin_password = "admin";  // Mot de passe pour l'administrateur LDAP

// Connexion au serveur LDAP
$ldap_conn = ldap_connect($ldap_server, $ldap_port);
if (!$ldap_conn) {
    die("Impossible de se connecter au serveur LDAP.");
}

// Activer LDAP v3
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

// Authentification avec l'administrateur LDAP (pour faire des recherches)
if (@ldap_bind($ldap_conn, $ldap_admin_dn, $ldap_admin_password)) {
    echo "Connexion réussie au serveur LDAP.<br>";

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['username'];  // Nom d'utilisateur à rechercher

        // Filtrer les utilisateurs dans LDAP
        $ldap_filter = "(uid=$user)"; // Filtre LDAP basé sur l'uid
        $search_result = ldap_search($ldap_conn, $ldap_base_dn, $ldap_filter);

        if ($search_result) {
            $entries = ldap_get_entries($ldap_conn, $search_result);

            if ($entries['count'] > 0) {
                // Utilisateur trouvé, affichez les résultats ou connectez-le
                echo "Utilisateur trouvé : <br>";
                echo "DN : " . $entries[0]['dn'] . "<br>";
                echo "Nom complet : " . $entries[0]['cn'][0] . "<br>";
                $_SESSION['username'] = $user;  // Stocker l'utilisateur dans la session
                header('Location: dashboard.php');  // Redirection vers une page de tableau de bord
                exit();
            } else {
                echo "Utilisateur non trouvé dans l'annuaire LDAP.";
            }
        } else {
            echo "Erreur lors de la recherche dans LDAP.";
        }
    }

    // Fermer la connexion LDAP
    ldap_unbind($ldap_conn);
} else {
    echo "Erreur d'authentification avec le serveur LDAP.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche LDAP</title>
</head>
<body>
    <h2>Connexion avec LDAP</h2>
    <form action="recherche.php" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br><br>
        <input type="submit" value="Rechercher">
    </form>
</body>
</html>

