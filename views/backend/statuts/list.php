<?php
// Commentaire: Vue backend pour lister statuts.
/*
 * Vue back-end (administration) : liste des éléments pour statuts.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php'; // contains the header and call to config.php

//Load all statuts
// Requête SQL : récupère des données pour construire la vue.
$statuts = sql_select("STATUT", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Statuts</h1>
            <?php if (isset($_GET['success'])) { ?>
                <?php if ($_GET['success'] === 'created') { ?>
                    <div class="alert alert-success">Statut créé avec succès.</div>
                <?php } elseif ($_GET['success'] === 'updated') { ?>
                    <div class="alert alert-success">Statut mis à jour avec succès.</div>
                <?php } elseif ($_GET['success'] === 'deleted') { ?>
                    <div class="alert alert-success">Statut supprimé avec succès.</div>
                <?php } ?>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <?php if ($_GET['error'] === 'missing') { ?>
                    <div class="alert alert-danger">Statut inexistant.</div>
                <?php } elseif ($_GET['error'] === 'empty') { ?>
                    <div class="alert alert-danger">Le nom du statut est obligatoire.</div>
                <?php } elseif ($_GET['error'] === 'used') { ?>
                    <div class="alert alert-danger">Suppression impossible : ce statut est lié à au moins un membre.</div>
                <?php } ?>
            <?php } ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des statuts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<!-- Boucle PHP : on parcourt une liste pour générer du HTML dynamique. -->
                    <?php foreach($statuts as $statut){ ?>
                        <tr>
                            <td><?php echo($statut['numStat']); ?></td>
                            <td><?php echo($statut['libStat']); ?></td>
                            <td>
                                <a href="edit.php?numStat=<?php echo($statut['numStat']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numStat=<?php echo($statut['numStat']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php
include '../../../footer.php'; // contains the footer
