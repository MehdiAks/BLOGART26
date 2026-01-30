<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/redirec.php';
include '../../../header.php';

// Récupération des erreurs flash
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
$recaptchaSiteKey = getenv('RECAPTCHA_SITE_KEY');
$recaptchaSiteKeyEscaped = htmlspecialchars($recaptchaSiteKey ?? '', ENT_QUOTES, 'UTF-8');

// Seulement si tu es admin ou modérateur, tu as accès à cette page
/*if (!isset($_SESSION['numStat']) || $_SESSION['numStat'] !== 1 && $_SESSION['numStat'] !== 2 ) {
    header('Location: ../../../index.php');
    exit();
}*/

// Initialisation des variables
$numMemb = $pseudoMemb = $prenomMemb = $nomMemb = $passMemb = $eMailMemb = "";
$numStat = 3; // Par défaut, statut "Membre"

if (isset($_GET['numMemb'])) {
    $numMemb = $_GET['numMemb'];
    $membre = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0] ?? [];

    $pseudoMemb = $membre['pseudoMemb'] ?? "";
    $prenomMemb = $membre['prenomMemb'] ?? "";
    $nomMemb = $membre['nomMemb'] ?? "";
    $passMemb = $membre['passMemb'] ?? "";
    $eMailMemb = $membre['eMailMemb'] ?? "";
    $numStat = $membre['numStat'] ?? 3;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Membre</h1>
        </div>
        <?php if (!empty($errors)): ?>
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/update.php' ?>" method="post">
                <input name="numMemb" class="form-control" type="hidden"
                    value="<?php echo htmlspecialchars($numMemb); ?>" />
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-update">

                <div class="form-group">
                    <!-- NOM D'UTILISATEUR -->
                    <label for="pseudoMemb">Nom d'utilisateur du membre (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text"
                        value="<?php echo htmlspecialchars($pseudoMemb); ?>" readonly disabled />

                    <!-- PRENOM -->
                    <label for="prenomMemb">Prénom du membre</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text"
                        value="<?php echo htmlspecialchars($prenomMemb); ?>" />

                    <!-- NOM -->
                    <label for="nomMemb">Nom du membre</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text"
                        value="<?php echo htmlspecialchars($nomMemb); ?>" />

                    <!-- MDP -->
                    <label for="passMemb">Mot de Passe</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="password"
                        value="<?php echo htmlspecialchars($passMemb); ?>" />
                    <p>(Entre 8 et 15 car., au moins une majuscule, une minuscule, un chiffre, caractères spéciaux
                        acceptés)</p>
                    <button type="button" id="afficher" class="btn btn-secondary">Afficher le mot de
                        passe</button><br><br>

                    <!-- MDP VERIFICATION -->
                    <label for="passMemb2">Confirmez le mot de passe</label>
                    <input id="passMemb2" name="passMemb2" class="form-control" type="password"
                        value="<?php echo htmlspecialchars($passMemb); ?>" />
                    <button type="button" id="afficher2" class="btn btn-secondary">Afficher le mot de
                        passe</button><br><br>

                    <!-- EMAIL -->
                    <label for="eMailMemb">Email du membre</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email"
                        value="<?php echo htmlspecialchars($eMailMemb); ?>" />

                    <!-- EMAIL VERIFICATION -->
                    <label for="eMailMemb2">Confirmez l'email du membre</label>
                    <input id="eMailMemb2" name="eMailMemb2" class="form-control" type="email"
                        value="<?php echo htmlspecialchars($eMailMemb); ?>" />
                    <br><br>

                    <!-- STATUT -->
                    <label for="numStat">Statut :</label>
                    <select name="numStat" id="numStat" class="form-control">
                        <option value="1" <?= ($numStat == 1) ? 'selected' : '' ?>>Administrateur</option>
                        <option value="2" <?= ($numStat == 2) ? 'selected' : '' ?>>Modérateur</option>
                        <option value="3" <?= ($numStat == 3) ? 'selected' : '' ?>>Membre</option>
                    </select>
                </div>

                <br />
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Confirmer update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (!empty($recaptchaSiteKey)): ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $recaptchaSiteKeyEscaped; ?>"></script>
<?php endif; ?>
<!-- JS POUR CACHER/AFFICHER MDP-->
<script>
    document.getElementById('afficher').addEventListener("click", function () {
        let passInput = document.getElementById('passMemb');
        passInput.type = (passInput.type === 'password') ? 'text' : 'password';
    });

    document.getElementById('afficher2').addEventListener("click", function () {
        let passInput2 = document.getElementById('passMemb2');
        passInput2.type = (passInput2.type === 'password') ? 'text' : 'password';
    });

    (function () {
        var form = document.querySelector('form');
        var tokenInput = document.getElementById('g-recaptcha-response-update');
        var siteKey = '<?php echo $recaptchaSiteKeyEscaped; ?>';
        if (!form || !tokenInput || !siteKey || typeof grecaptcha === 'undefined') {
            return;
        }

        var isSubmitting = false;
        form.addEventListener('submit', function (event) {
            if (isSubmitting) {
                return;
            }
            event.preventDefault();
            if (typeof grecaptcha === 'undefined') {
                form.submit();
                return;
            }
            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, {action: 'update'})
                    .then(function (token) {
                        tokenInput.value = token;
                        isSubmitting = true;
                        form.submit();
                    });
            });
        });
    })();
</script>
