<?php
$numStat = $_SESSION['numStat'] ?? null;

if ($numStat === null) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}

if ((int)$numStat !== 1 && (int)$numStat !== 2) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}
