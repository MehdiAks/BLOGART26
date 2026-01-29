<?php
/**
 * Vue : Création d'une nouvelle thématique (backend)
 * But : Afficher un formulaire simple. Les données sont envoyées
 *       en POST vers l'API qui se charge de l'insertion en base.
 * Emplacement : views/backend/thematiques/create.php
 */

// Inclusion de l'en-tête commun (HTML, sessions, constantes comme ROOT_URL...)
include '../../../header.php';

// Inclusion d'un utilitaire de redirection/sécurité si nécessaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';
?>

<!-- Conteneur Bootstrap : formulaire de création d'une thématique -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouvelle Thematique</h1>
        </div>
        <div class="col-md-12">
            <!-- Formulaire : envoi en POST vers l'API qui crée la thématique en base -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/create.php' ?>" method="post">
                <!-- Important : le traitement (validation, sanitisation, insertion)
                     doit être fait côté serveur dans api/thematiques/create.php -->
                <div class="form-group">
                    <label for="libThem">Nom de thematique</label>
                    <!--
                        Champ 'libThem' :
                        - name="libThem" : clé envoyée en POST
                        - valeur attendue : chaîne (libellé de la thématique)
                        - validation requise côté serveur (non vide, longueur max, etc.)
                    -->
                    <input id="libThem" name="libThem" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <!-- Lien vers la liste des thématiques -->
                    <a href="list.php" class="btn btn-primary">List</a>
                    <!-- Bouton de soumission : envoie le formulaire -->
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
