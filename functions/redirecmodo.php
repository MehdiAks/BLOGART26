<?php
// Commentaire: Fonctions utilitaires pour redirecmodo.
if ($numStat !== 1 && $numStat !== 2) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}