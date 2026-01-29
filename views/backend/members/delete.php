<?php
/*
 * Vue back-end (administration) : page de suppression/confirmation pour members.
 * Ce fichier mélange du PHP et du HTML pour afficher la page.
 * Les commentaires ajoutés ci-dessous expliquent les sections clés pour un débutant.
 */
// Charge le layout ou des dépendances communes nécessaires à la vue.
include '../../../header.php';
// Charge le layout ou des dépendances communes nécessaires à la vue.
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';

// Condition PHP : on adapte l'affichage selon les données.
if (isset($_GET['numMemb'])) {
    $numMemb = $_GET['numMemb'];
    // Requête SQL : récupère des données pour construire la vue.
    $member = sql_select('MEMBRE', '*', "numMemb = '$numMemb'")[0];
    $pseudoMemb = $member['pseudoMemb'];
    $prenomMemb = $member['prenomMemb'];
    $nomMemb = $member['nomMemb'];
    $eMailMemb = $member['eMailMemb'];
    $dtCreaMemb = $member['dtCreaMemb'];
    $numStat = $member['numStat'];
    ?>
    <!-- Bootstrap form to delete a member -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Suppression Membre</h1>
            </div>
            <div class="col-md-12">
                <!-- Form to delete a member -->
<!-- Formulaire HTML pour saisir/modifier des données. -->
                <form action="<?php echo ROOT_URL . '/api/members/delete.php' ?>" method="post">
                    <div class="form-group">
                        <!-- NUM -->
                        <label for="numMemb">Numéro du Membre</label>
                        <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text"
                            value="<?php echo ($numMemb); ?>" readonly="readonly" />
                        <!-- PRENOM -->
                        <label for="prenomMemb">Prénom du Membre</label>
                        <input id="prenomMemb" name="prenomMemb" class="form-control" type="text"
                            value="<?php echo ($prenomMemb); ?>" readonly="readonly" disabled />
                        <!-- NOM -->
                        <label for="nomMemb">Nom du Membre</label>
                        <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php echo ($nomMemb); ?>"
                            readonly="readonly" disabled />
                        <!-- PSEUDO -->
                        <label for="pseudoMemb">Pseudo du Membre</label>
                        <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text"
                            value="<?php echo ($pseudoMemb); ?>" readonly="readonly" disabled />
                        <!-- MAIL -->
                        <label for="eMailMemb">Adresse email du Membre</label>
                        <input id="eMailMemb" name="eMailMemb" class="form-control" type="text"
                            value="<?php echo ($eMailMemb); ?>" readonly="readonly" disabled />
                        <!-- DATE CREA -->
                        <label for="dtCreaMemb">Date de création du Membre</label>
                        <input id="dtCreaMemb" name="dtCreaMemb" class="form-control" type="text"
                            value="<?php echo ($dtCreaMemb); ?>" readonly="readonly" disabled />
                        <!-- STATUT -->
                        <label for="numStat">Statut du Membre</label>
                        <input id="statutMemb" name="statutMemb" class="form-control" type="text" value="<?php
                        // Condition PHP : on adapte l'affichage selon les données.
                        if ($numStat == '1') {
                            echo 'Administrateur';
                        }
                        // Condition PHP : on adapte l'affichage selon les données.
                        if ($numStat == '2') {
                            echo 'Modérateur';
                        }
                        // Condition PHP : on adapte l'affichage selon les données.
                        if ($numStat == '3') {
                            echo 'Membre';
                        }
                        ?>" readonly="readonly" disabled />
                        <input id="idMemb" name="idMemb" class="form-control" style="display: none" type="text"
                            value="<?php echo ($numStat); ?>" readonly="readonly" />
                    </div>
                    <br />
                    <?php
                    // Condition PHP : on adapte l'affichage selon les données.
                    if ($numStat == 1) {
                        echo '<p>Un administrateur ne peut pas être supprimé.</p>';
                    } else { ?>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Est-ce que tu es sûr(e) de vouloir supprimer ce membre ?')">Confirmer
                                la suppression</button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
