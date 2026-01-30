<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/libs/cookie-consent.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';

sql_connect();

$articles = sql_select("ARTICLE", "*", null, null, "RAND()", 3);
?>

<?php if (!hasUserMadeCookieChoice()): ?>
<div id="cookie-popup" class="cookie-popup" style="display: block;">
    <div class="cookie-content">
        <h3>Politique de Cookies</h3>
        <p>
            Nous utilisons des cookies pour assurer le bon fonctionnement de ce blog sur le Bordeaux étudiant club, améliorer votre expérience, personnaliser
            le contenu et analyser le trafic. Certains cookies sont strictement nécessaires, tandis que d'autres permettent de mieux comprendre
            votre navigation.
            <br>
            <br>En cliquant sur "Continuer et accepter", vous autorisez l'utilisation de tous les cookies. Si vous choisissez "Continuer sans
            accepter", vous ne pourrez pas créer de compte. Si vous possèdez déjà un compte, vous devrez le supprimer pour refuser les cookies.
            <br>
            <br>Votre choix sera enregistré pour une durée de <?php echo COOKIE_CONSENT_DURATION_MINUTES; ?> minutes, mais vous pourrez le modifier à tout moment en accédant aux "Politique
            de confidentialité" en bas de page.
        </p>
        <div class="cookie-buttons">
            <form method="POST" style="display: inline;">
                <button type="submit" name="reject_cookies" id="reject-cookies">Continuer sans accepter</button>
            </form>
            <form method="POST" style="display: inline;">
                <button type="submit" name="accept_cookies" id="accept-cookies">Continuer et accepter</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<h2>Dernières actualités</h2>

<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $index => $article): ?>
        <?php
        $imagePath = !empty($article['urlPhotArt'])
            ? ROOT_URL . '/src/uploads/' . htmlspecialchars($article['urlPhotArt'])
            : ROOT_URL . '/src/images/article.png';
        $excerpt = isset($article['libChapoArt'])
            ? substr($article['libChapoArt'], 0, 120) . (strlen($article['libChapoArt']) > 120 ? '...' : '')
            : '';
        ?>
        <div class="container">
            <h3><?php echo htmlspecialchars($article['libTitrArt']); ?></h3>
            <div class="row">
                <?php if ($index % 2 === 0): ?>
                    <div class="col-lg-4 col-md-4 col-12">
                        <img class="box article-image" src="<?php echo $imagePath; ?>" alt="Image article">
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="box article-content">
                            <p><?php echo htmlspecialchars($excerpt); ?></p>
                            <a href="<?php echo ROOT_URL . '/article.php?numArt=' . $article['numArt']; ?>">Lire l'article →</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="box article-content">
                            <p><?php echo htmlspecialchars($excerpt); ?></p>
                            <a href="<?php echo ROOT_URL . '/article.php?numArt=' . $article['numArt']; ?>">Lire l'article →</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <img class="box article-image" src="<?php echo $imagePath; ?>" alt="Image article">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="container">
        <p>Aucun article disponible.</p>
    </div>
<?php endif; ?>

<a href="<?php echo ROOT_URL . '/actualites.php'; ?>">
    <button type="button">Découvrez l'ensemble de nos actualités</button>
</a>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>