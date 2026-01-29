<?php
// Commentaire: Vue backend pour créer comments.
/*
 * Vue back-end (administration) : formulaire de création pour comments.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirecmodo.php';

?>

<!-- Bootstrap form to create a new motcle -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau de Commentaires</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new motcle -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form action="<?php echo ROOT_URL . '/api/comments/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="libCom">Commentaires</label>
                    <input id="libCom" name="libCom" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <div class="form-group">
                    <label for="numArt">Article</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <div class="form-group">
                    <label for="numMemb">numéro d'utilisateur</label>
                    <input id="numMemb" name="numMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
