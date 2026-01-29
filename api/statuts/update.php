<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numStat = (int) ($_POST['numStat'] ?? 0);
$libStat = trim(ctrlSaisies($_POST['libStat'] ?? ''));

if ($libStat === '') {
    header("Location: ../../views/backend/statuts/edit.php?numStat=$numStat&error=empty");
    exit();
}

$statut = sql_select("STATUT", "numStat", "numStat = $numStat");
if (!$statut) {
    header('Location: ../../views/backend/statuts/list.php?error=missing');
    exit();
}

sql_update(table: 'STATUT', attributs: 'libStat = "' . $libStat . '"', where: "numStat = $numStat");

header('Location: ../../views/backend/statuts/list.php?success=updated');
exit();
