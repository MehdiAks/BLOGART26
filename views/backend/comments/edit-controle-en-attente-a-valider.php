<?php
/*
 * Vue back-end (administration) : rendu HTML/PHP de la page.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirecmodo.php';

// Condition PHP : on adapte l'affichage selon les données.
if(isset($_GET['numCom'])){
    $numCom = $_GET['numCom'];
    // Requête SQL : récupère des données pour construire la vue.
    $dtCreaCom = sql_select("comment", "dtCreaCom", "numCom = $numCom")[0]['dtCreaCom'];
    // Requête SQL : récupère des données pour construire la vue.
    $libCom = sql_select("comment", "libCom", "numCom = $numCom")[0]['libCom'];
    // Requête SQL : récupère des données pour construire la vue.
    $dtModCom = sql_select("comment", "dtModCom", "numCom = $numCom")[0]['dtModCom'];
    // Requête SQL : récupère des données pour construire la vue.
    $attModOK = sql_select("comment", "attModOK", "numCom = $numCom")[0]['attModOK'];
    // Requête SQL : récupère des données pour construire la vue.
    $notifComKOAff = sql_select("comment", "notifComKOAff", "numCom = $numCom")[0]['notifComKOAff'];
    // Requête SQL : récupère des données pour construire la vue.
    $dtDelLogCom = sql_select("comment", "dtDelLogCom", "numCom = $numCom")[0]['dtDelLogCom'];
    // Requête SQL : récupère des données pour construire la vue.
    $delLogiq = sql_select("comment", "delLogiq", "numCom = $numCom")[0]['delLogiq'];
    // Requête SQL : récupère des données pour construire la vue.
    $numArt = sql_select("comment", "numArt", "numCom = $numCom")[0]['numArt'];
    // Requête SQL : récupère des données pour construire la vue.
    $numMemb = sql_select("comment", "numMemb", "numCom = $numCom")[0]['numMemb'];

    // Requête SQL : récupère des données pour construire la vue.
    $pseudoMemb = sql_select("membre", "pseudoMemb", "numMemb = $numMemb")[0]['pseudoMemb'];
    // Requête SQL : récupère des données pour construire la vue.
    $libTitrArt = sql_select("article", "libTitrArt", "numArt = $numArt")[0]['libTitrArt'];
    // Requête SQL : récupère des données pour construire la vue.
    $parag1Art = sql_select("article", "parag1Art", "numArt = $numArt")[0]['parag1Art'];
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="titre text-center">Contrôle commentaire en attente : à valider</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
            <form action="<?php echo ROOT_URL . '/api/comments/update.php' ?>" method="post">

                <div class="form-group">
                    <label for="libTitrArt"><h2>Titre de l'article</h2></label>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo ($libTitrArt); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="pseudoMemb" for="dtCreaCom"><h2>Information commentaire</h2></label>
                    <p><u>Nom d'utilisateur :</u></p>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" value="<?php echo ($pseudoMemb); ?>" readonly="readonly" />
                    <br>
                    <p><u>Date de création :</u></p>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="dtCreaCom" name="dtCreaCom" class="form-control" type="text" value="<?php echo ($dtCreaCom); ?>" readonly="readonly" />
                </div>
                <br>

                <div class="form-group">
                    <label for="libCom"><h2>Contenu du commentaire</h2></label>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <textarea id="libCom" name="libCom" class="form-control" rows="6"><?php echo ($libCom); ?></textarea>
                </div>
                <br>

                <div class="form-group"></div>
                    <label for="attModOK"><h2>Validation du commentaire</h2></label> 
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <br>
                        <label>
                                <input type="radio" name="attModOK" value="1" <?php echo ($attModOK == 1) ? 'checked' : ''; ?>> Valider le commentaire
                        </label>
                        <br>
                        <label>
                                <input type="radio" name="attModOK" value="0" <?php echo ($attModOK == 0) ? 'checked' : ''; ?>> Refuser le commentaire
                        </label>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="parag1Art"><h2>Raison du refus</h2></label>
                    <p>A remplir seulement si le commentaire est refusé</p>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <textarea id="notifComKOAff" name="notifComKOAff" class="form-control" rows="10"><?php echo ($notifComKOAff); ?></textarea>
                </div>
                <br>
                <br>
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-warning">Envoie Control</button>
                </div>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>
