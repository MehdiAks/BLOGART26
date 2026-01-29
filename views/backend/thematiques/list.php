<?php
// Commentaire: Vue backend pour lister thematiques.
/*
 * Vue back-end (administration) : liste des éléments pour thematiques.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php'; 
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';

//Load all statuts
// Requête SQL : récupère des données pour construire la vue.
$thematiques = sql_select("THEMATIQUE", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Thematiques</h1>
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des thematiques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<!-- Boucle PHP : on parcourt une liste pour générer du HTML dynamique. -->
                    <?php foreach ($thematiques as $thematique) { ?>
                        <tr>
                            <td><?php echo $thematique['numThem']; ?></td>
                            <td><?php echo $thematique['libThem']; ?></td>
                            <td>
                                <a href="edit.php?numThem=<?php echo($thematique['numThem']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numThem=<?php echo($thematique['numThem']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
