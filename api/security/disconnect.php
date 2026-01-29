<?php
// Commentaire: Endpoint API pour déconnecter la ressource security.
session_start(); 
session_unset();
session_destroy();

header("Location: /index.php");
exit();
?>
