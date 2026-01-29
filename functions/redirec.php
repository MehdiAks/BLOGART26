<?php
// 1. On démarre la session pour pouvoir lire les variables utilisateur
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. On récupère le statut depuis la session. 
// Si la session n'existe pas (pas de MDP/Login), on met 0 par défaut.
$numStat = isset($_SESSION['numStat']) ? $_SESSION['numStat'] : 0;

// 3. Logique de redirection
if ((int)$numStat !== 1) { // Si n'est PAS Admin
    
    if ((int)$numStat === 2) { // Si est Modérateur
        header("Location: " . ROOT_URL . "/views/backend/comments/list.php");
        exit();
    }
    
    // Pour tout autre cas (visiteur, non connecté, etc.)
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}

// Si le code arrive ici, c'est que $numStat vaut 1 (Admin), on laisse la page charger.