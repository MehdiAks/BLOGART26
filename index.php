<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'header.php';

sql_connect();

$articles = sql_select("ARTICLE", "*", null, null, "RAND()", 3);
?>
<div id="cookie-popup" class="cookie-popup">
    <div class="cookie-content">
        <h3>Politique de Cookies</h3>
        <p>
            Nous utilisons des cookies pour assurer le bon fonctionnement de ce blog sur le Bordeaux étudiant club, améliorer votre expérience, personnaliser
            le contenu et analyser le trafic. Certains cookies sont strictement nécessaires, tandis que d'autres permettent de mieux comprendre
            votre navigation.
            <br>
            <br>En cliquant sur “Continuer et accepter”, vous autorisez l'utilisation de tous les cookies. Si vous choisissez “Continuer sans
            accepter”, vous ne pourrez pas créer de compte. Si vous possèdez déjà un compte, vous devrez le supprimer pour refuser les cookies.
            <br>
            <br>Votre choix sera enregistré pour une durée de 6 mois, mais vous pourrez le modifier à tout moment en accédant aux “Politique
            de confidentialité” en bas de page.
        </p>
        <div class="cookie-buttons">
            <button id="reject-cookies" type="button">Continuer sans accepter</button>
            <button id="accept-cookies" type="button">Continuer et accepter</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.getElementById("cookie-popup");
        const acceptBtn = document.getElementById("accept-cookies");
        const rejectBtn = document.getElementById("reject-cookies");

        if (localStorage.getItem("cookieConsent") === "rejected" || !localStorage.getItem("cookieConsent")) {
            cookiePopup.style.display = "block";
        }

        acceptBtn.addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "accepted");
            document.cookie = "cookieConsent=accepted; path=/; max-age=" + (6 * 30 * 24 * 60 * 60);
            cookiePopup.style.display = "none";
        });

        rejectBtn.addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "rejected");
            document.cookie = "cookieConsent=rejected; path=/; max-age=" + (6 * 30 * 24 * 60 * 60);
            cookiePopup.style.display = "none";
        });
    });
</script>

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
