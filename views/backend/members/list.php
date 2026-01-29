<?php
// Commentaire: Vue backend pour lister members.
/*
 * Vue back-end (administration) : liste des éléments pour members.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php'; 
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';



// Charger tous les membres avec leur statut
// Requête SQL : récupère des données pour construire la vue.
$members = sql_select("MEMBRE INNER JOIN STATUT ON MEMBRE.numStat = STATUT.numStat", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Accord RGPD</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($members)) : ?>
<!-- Boucle PHP : on parcourt une liste pour générer du HTML dynamique. -->
                        <?php foreach ($members as $mem) : ?>
                            <tr>
                                <td><?php echo($mem['numMemb']); ?></td>
                                <td><?php echo($mem['prenomMemb']); ?></td>
                                <td><?php echo($mem['nomMemb']); ?></td>
                                <td><?php echo($mem['eMailMemb']); ?></td>
                                <td><?= $mem['accordMemb'] ? '✅ Oui' : '❌ Non'; ?></td>
                                <td><?php echo($mem['libStat']); ?></td>
                                <td>
                                    <a href="edit.php?numMemb=<?= htmlspecialchars($mem['numMemb']); ?>" class="btn btn-primary">Edit</a>
                                    <?php if ($mem['numStat'] == 1) : ?>
                                        <button class="btn btn-danger disabled">Delete</button>
                                    <?php else : ?>
                                        <a href="delete.php?numMemb=<?= htmlspecialchars($mem['numMemb']); ?>" class="btn btn-danger">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Aucun membre trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Créer</a>
        </div>
    </div>
</div>
