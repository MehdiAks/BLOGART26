<?php
// Commentaire: Endpoint API pour authentifier la ressource security.
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = ctrlSaisies($_POST['pseudo']);
    $password = ctrlSaisies($_POST['password']);

    // Vérifier si l'utilisateur existe avec ce pseudo
    $user = sql_select("MEMBRE", "*", "pseudoMemb = '$pseudo'");
    
    if ($user) {
        // Utiliser password_verify pour comparer le mot de passe saisi avec celui haché
        if (password_verify($password, $user[0]['passMemb'])) {
            $_SESSION['user_id'] = $user[0]['numMemb'];
            $_SESSION['pseudoMemb'] = $user[0]['pseudoMemb'];
            $_SESSION['numStat'] = $user[0]['numStat'];

            header("Location: " . ROOT_URL . "/index.php");
            exit();
        } else {
            header("Location: " . ROOT_URL . "/views/backend/security/login.php?error=Mot de passe incorrect");
            exit();
        }
    } else {
        header("Location: " . ROOT_URL . "/views/backend/security/login.php?error=Pseudo ou mot de passe incorrect");
        exit();
    }
}
?>
