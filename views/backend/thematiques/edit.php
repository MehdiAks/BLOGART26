<?php
// Commentaire: Vue backend pour modifier thematiques.
/*
 * Vue back-end (administration) : formulaire d'édition pour thematiques.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';



// Condition PHP : on adapte l'affichage selon les données.
if(isset($_GET['numThem'])){
    $numThem = $_GET['numThem'];
    // Requête SQL : récupère des données pour construire la vue.
    $libThem = sql_select("THEMATIQUE", "libThem", "numThem = $numThem")[0]['libThem'];
}

?> 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Thematique</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/update.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom de Thematique </label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text" value="<?php echo($numThem); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo($libThem); ?>"/>
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
