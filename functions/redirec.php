<?php
// Commentaire: Fonctions utilitaires pour redirec.
if ((int)$numStat !== 1) {
    if ((int)$numStat == 2) {
        header("Location: " . ROOT_URL . "/views/backend/comments/list.php");
        exit();
    }
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}

