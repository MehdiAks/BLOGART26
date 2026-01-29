<?php
/*
 * Vue back-end (administration) : liste des éléments pour comments.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php'; // contains the header and call to config.php
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirecmodo.php';

//Load all statuts
// Requête SQL : récupère des données pour construire la vue.
$coms = sql_select("comment", "*");
// Requête SQL : récupère des données pour construire la vue.
$articles = sql_select("article", "*");
// Requête SQL : récupère des données pour construire la vue.
$membres = sql_select("membre", "*");
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
// Requête SQL : récupère des données pour construire la vue.
$coms = sql_select("comment c INNER JOIN article a ON c.numArt = a.numArt", 
        "c.numCom, c.dtCreaCom, c.libCom, c.dtModCom, c.delLogiq, c.attModOK, c.notifComKOAff, c.numArt, c.numMemb, a.libTitrArt");
// Requête SQL : récupère des données pour construire la vue.
$coms = sql_select("comment c INNER JOIN article a ON c.numArt = a.numArt
                                   INNER JOIN membre m ON c.numMemb = m.numMemb", 
                        "c.numCom, c.dtCreaCom, c.libCom, c.dtModCom, c.delLogiq, c.attModOK, c.notifComKOAff, c.numArt, c.numMemb, a.libTitrArt, m.pseudoMemb");


                       
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
    <div class="row">
        <h1 class="titre text-start" style="margin: 2rem 10rem 2rem 10rem;">Commentaires en attente</h1>
                <thead>
                    <tr>
                        <th>Titre Article</th>
                        <th>Pseudo</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php  foreach($coms as $com ){ 
                            // Condition PHP : on adapte l'affichage selon les données.
                            if ($com['attModOK'] == 0 && $com['delLogiq'] == 0){?> 
                                <?php ?> 
                                    <tr>
                                        <td><?php echo($com['libTitrArt']); ?></td>
                                        <td><?php echo($com['pseudoMemb']); ?></td>
                                        <td><?php echo($com['dtCreaCom']); ?></td>
                                        <td><?php echo($com['libCom']); ?></td>
                                        <td>
                                            <a href="edit - ATTENTE MODIFICATION.php?numCom=<?php echo($com['numCom']); ?>" class="btn btn-warning">Edit</a>
                                        </td>
                                        <td>
                                            <a href="edit - CONTROLLER MODIFICATION.php?numCom=<?php echo($com['numCom']); ?>" class="btn btn-primary">Controller</a>
                                        </td>
                                        

                                    </tr>
                        <?php }} ?>
                </tbody>
                
            </table>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
    <div class="row">
        <h1 class="titre text-start" style="margin: 2rem 10rem 2rem 10rem;">Commentaires contrôlés</h1>

                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Dernière modif</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php  foreach($coms as $com){ 
                            // Condition PHP : on adapte l'affichage selon les données.
                            if ($com['attModOK'] == 1 && $com['delLogiq'] == 0){?> 
                                <?php ?> <tr>
                                    <td><?php echo($com['pseudoMemb']); ?></td>

                                    <td><?php echo($com['dtModCom']); ?></td>
                                    <td><?php echo($com['libCom']); ?></td>
                                    <td><?php echo($com['dtCreaCom']); ?></td>
                                    <td>
                                        <a href="edit - CONTROLLER MODIFICATION.php?numCom=<?php echo($com['numCom']); ?>" class="btn btn-warning">Edit</a>
                                    </td>
                                    

                                </tr>
                        <?php }} ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
    <div class="row">
        <h1 class="titre text-start" style="margin: 2rem 10rem 2rem 10rem;">suppression logique</h1>

                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>date suppr logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                <?php  foreach($coms as $com){ 
                            // Condition PHP : on adapte l'affichage selon les données.
                            if ($com['attModOK'] == 0 && $com['delLogiq'] == 1){?> 
                                <?php ?> <tr>
                                    <td><?php echo($com['pseudoMemb']); ?></td>
                                    <td><?php echo($com['dtModCom']); ?></td>
                                    <td><?php echo($com['libCom']); ?></td>
                                    <td><?php echo($com['dtCreaCom']); ?></td>
                                    <td><?php echo($com['notifComKOAff']); ?></td>
                                    <td>
                                        <a href="edit - SUPPRESION.php?numCom=<?php echo($com['numCom']); ?>" class="btn btn-warning">Edit</a>
                                    </td>
                                    

                                </tr>
                        <?php }} ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
    <div class="row">
        <h1 class="titre text-start" style="margin: 2rem 10rem 2rem 10rem;">suppression physique</h1>

                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date suppr logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                <?php  foreach($coms as $com){ 
                            // Condition PHP : on adapte l'affichage selon les données.
                            if ($com['delLogiq'] == 1){?> 
                                <?php ?> <tr>
                                    <td><?php echo($com['pseudoMemb']); ?></td>
                                    <td><?php echo($com['dtModCom']); ?></td>
                                    <td><?php echo($com['libCom']); ?></td>
                                    <td><?php echo($com['dtCreaCom']); ?></td>
                                    <td><?php echo($com['notifComKOAff']); ?></td>
                                    <td>
                                        <a href="delete.php?numCom=<?php echo($com['numCom']); ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                    

                                </tr>
                        <?php }} ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div class="col-md-2" style="margin: 0.5rem 1rem;">
    <a href="create.php" class="btn btn-success">Create</a>
</div>
