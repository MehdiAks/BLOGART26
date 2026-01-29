<?php
/*
 * Vue back-end (administration) : formulaire d'édition pour keywords.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';

// Condition PHP : on adapte l'affichage selon les données.
if(isset($_GET['numMotCle'])){
    $numMotCle = $_GET['numMotCle'];
    // Requête SQL : récupère des données pour construire la vue.
    $libMotCle = sql_select("MOTCLE", "libMotCle", "numMotCle = $numMotCle")[0]['libMotCle'];
}

?> 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1> Mot-Clé</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form action="<?php echo ROOT_URL . '/api/keywords/update.php' ?>" method="post">
                <div class="form-group">
                    <label for="libMotCle">Nom du statut</label>
                    <input id="numMotCle" name="numMotCle" class="form-control" style="display: none" type="text" value="<?php echo($numMotCle); ?>" readonly="readonly" />
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" value="<?php echo($libMotCle); ?>"/>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">Confirmer Edit ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
