<?php
// Commentaire: Fonctions utilitaires pour redirecmodo.
$numStat = $_SESSION['numStat'] ?? null;

if ($numStat === null || ($numStat !== 1 && $numStat !== 2)) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}
