<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../views/backend/members/list.php');
    exit();
}

$numMemb = ctrlSaisies($_POST['numMemb'] ?? '');
$redirectUrl = '../../views/backend/members/delete.php';
if (!empty($numMemb)) {
    $redirectUrl .= '?numMemb=' . urlencode($numMemb);
}

$recaptcha = verifyRecaptcha($_POST['g-recaptcha-response'] ?? '', 'delete');
if (!$recaptcha['valid']) {
    $_SESSION['errors'] = [$recaptcha['message'] ?: 'Échec de la vérification reCAPTCHA.'];
    header('Location: ' . $redirectUrl);
    exit();
}

if (empty($numMemb)) {
    $_SESSION['errors'] = ['ID du membre manquant.'];
    header('Location: ' . $redirectUrl);
    exit();
}

sql_delete('MEMBRE', "numMemb = $numMemb");

header('Location: ../../views/backend/members/list.php');
