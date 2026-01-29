<?php
// Commentaire: Vue backend pour modifier statuts.
/*
 * Vue back-end (administration) : formulaire d'édition pour statuts.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';



if (isset($_GET['numStat'])) {
    $numStat = (int) $_GET['numStat'];
    $statut = sql_select("STATUT", "libStat", "numStat = $numStat");
    if (!$statut) {
        header('Location: list.php?error=missing');
        exit();
    }
    $libStat = $statut[0]['libStat'];
} else {
    header('Location: list.php?error=missing');
    exit();
}

?> 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1> Statut</h1>
        </div>
        <div class="col-md-12">
            <?php if (isset($_GET['error']) && $_GET['error'] === 'empty') { ?>
                <div class="alert alert-danger">Le nom du statut est obligatoire.</div>
            <?php } ?>
            <!-- Form to create a new statut -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form action="<?php echo ROOT_URL . '/api/statuts/update.php' ?>" method="post">
                <div class="form-group">
                    <label for="libStat">Nom du statut</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo($numStat); ?>" readonly="readonly" />
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo($libStat); ?>" required />
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
