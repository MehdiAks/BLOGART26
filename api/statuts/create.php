<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libStat = trim(ctrlSaisies($_POST['libStat'] ?? ''));

if ($libStat === '') {
    header('Location: ../../views/backend/statuts/list.php?error=empty');
    exit();
}

sql_insert('STATUT', 'libStat', "'$libStat'");

header('Location: ../../views/backend/statuts/list.php?success=created');
exit();
