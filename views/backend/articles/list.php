<?php
// Commentaire: Vue backend pour lister articles.
/*
 * Vue back-end (administration) : liste des éléments pour articles.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php'; // contains the header and call to config.php
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';

//Load all articles
// Requête SQL : récupère des données pour construire la vue.
$articles = sql_select("ARTICLE", "*");
// Requête SQL : récupère des données pour construire la vue.
$keywords = sql_select("MOTCLE", "*");
// Requête SQL : récupère des données pour construire la vue.
$keywordsart = sql_select("MOTCLEARTICLE", "*");
// Requête SQL : récupère des données pour construire la vue.
$thematiques = sql_select("THEMATIQUE", "*");
?>

<!-- Bootstrap default layout to display all articles in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
<!-- Tableau HTML pour afficher des données sous forme de lignes/colonnes. -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Chapeau</th>
                        <th>Accroche</th>
                        <th>Mots-clés</th>
                        <th>Thématique</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<!-- Boucle PHP : on parcourt une liste pour générer du HTML dynamique. -->
                    <?php foreach ($articles as $article) { 
                        $numArt = $article['numArt']; // QUEL ARTICLE NUM EST-IL QUESTION?
                        // Requête SQL : récupère des données pour construire la vue.
                        $listMot = sql_select('ARTICLE
                        INNER JOIN MOTCLEARTICLE ON article.numArt = motclearticle.numArt
                        INNER JOIN motcle ON motclearticle.numMotCle = motcle.numMotCle', 'article.numArt, libMotCle', "article.numArt = '$numArt'");
                        ?>
                        <tr>
                            <td><?php echo $article['numArt']; ?></td>
                            <td><?php echo $article['dtCreaArt']; ?></td>
                            <td><?php echo $article['libTitrArt']; ?></td>
                            <td style="max-width: 400px; white-space: wrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo substr($article['libChapoArt'], 0, 100) . (strlen($article['libChapoArt']) > 100 ? '...' : ''); ?></td>
                            <td style="max-width: 400px; white-space: wrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo $article['libAccrochArt']; ?></td>
                            <td>
                                <?php 
                                foreach ($keywordsart as $keywordart) { 
                                    // Condition PHP : on adapte l'affichage selon les données.
                                    if ($keywordart['numArt'] == $article['numArt']) {
                                        foreach ($keywords as $keyword) {
                                            // Condition PHP : on adapte l'affichage selon les données.
                                            if ($keyword['numMotCle'] == $keywordart['numMotCle']) {
                                                echo $keyword['libMotCle'] . "<br>"; 
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                            <?php
                                foreach ($thematiques as $thematique) { 
                                    // Condition PHP : on adapte l'affichage selon les données.
                                    if ($thematique['numThem'] == $article['numThem']) { 
                                        echo $thematique['libThem'];
                                        break; 
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
