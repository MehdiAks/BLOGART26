<?php
/*
 * Vue back-end (administration) : page de sécurité/authentification.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once '../../../functions/ctrlSaisies.php';
?>
<body>
        <main>
            
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form>
                <h1 class="h1-mdp">Mot de passe oublié ?</h1>
                <h2 style="font-style: italic; font-size: 70px">Dommage</h2>
                <div class="btn-mdp">
                    <h2><a href="/views/backend/security/login.php" class="link">Retour</a></h2>
                </div>
            </form>
        </main>
</body>
