<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numStat = (int) ($_POST['numStat'] ?? 0);

$statut = sql_select("STATUT", "numStat", "numStat = $numStat");
if (!$statut) {
    header('Location: ../../views/backend/statuts/list.php?error=missing');
    exit();
}

// Vérifie si le statut est lié à un membre
$countnumStat = sql_select("MEMBRE", "COUNT(*) AS total", "numStat = $numStat")[0]['total'];
if ($countnumStat > 0) {
    header('Location: ../../views/backend/statuts/list.php?error=used');
    exit();
}

sql_delete('STATUT', "numStat = $numStat");

header('Location: ../../views/backend/statuts/list.php?success=deleted');
exit();
