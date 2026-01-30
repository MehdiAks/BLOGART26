<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/libs/cookie-consent.php';
$pageStyles = [ROOT_URL . '/src/css/home.css'];
$pageHasVideo = true;
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

<main class="home-main">
    <section class="home-hero">
        <div class="home-hero__content">
            <span class="eyebrow">Bordeaux Étudiant Club</span>
            <h1>Vivez la vie étudiante bordelaise avec énergie, culture et passion sportive.</h1>
            <p>
                Inspirez-vous des initiatives locales, suivez les actions du club et plongez dans une communauté dynamique qui met en lumière
                les talents étudiants, les événements et les projets associatifs.
            </p>
            <div class="home-hero__actions">
                <a class="btn-primary" href="<?php echo ROOT_URL . '/actualites.php'; ?>">Découvrir les actualités</a>
                <a class="btn-secondary" href="<?php echo ROOT_URL . '/contact.php'; ?>">Nous contacter</a>
            </div>
            <div class="home-hero__stats">
                <div class="stat">
                    <span>+120</span>
                    <p>articles & portraits publiés</p>
                </div>
                <div class="stat">
                    <span>15</span>
                    <p>associations partenaires</p>
                </div>
                <div class="stat">
                    <span>4</span>
                    <p>pôles d’actions engagés</p>
                </div>
            </div>
        </div>
        <div class="home-hero__media">
            <video autoplay muted loop playsinline poster="<?php echo ROOT_URL . '/src/images/background/background-index.jpg'; ?>">
                <source src="<?php echo ROOT_URL . '/src/videos/fond.mp4'; ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
            <div class="home-hero__card">
                <strong>À venir :</strong>
                <p>Forum des associations, ateliers sportifs & soirées solidaires.</p>
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="section-heading reveal">
            <span class="eyebrow">Notre mission</span>
            <h2>Créer des rencontres, valoriser les initiatives et fédérer les étudiants.</h2>
            <p>
                Le BEC accompagne les étudiants bordelais en mettant en avant des expériences collectives, des temps forts et un réseau d’entraide
                pensé pour l’épanouissement de chacun.
            </p>
        </div>
        <div class="home-grid home-grid--three">
            <article class="info-card reveal">
                <h3>Programmes sur-mesure</h3>
                <p>Des activités sportives, culturelles et citoyennes pour soutenir les parcours étudiants.</p>
                <a href="<?php echo ROOT_URL . '/anciens-et-amis.php'; ?>">Découvrir le réseau →</a>
            </article>
            <article class="info-card reveal">
                <h3>Événements rythmés</h3>
                <p>Rencontres, tournois, conférences et soirées pour enrichir la vie associative.</p>
                <a href="<?php echo ROOT_URL . '/actualites.php'; ?>">Voir le calendrier →</a>
            </article>
            <article class="info-card reveal">
                <h3>Accompagnement étudiant</h3>
                <p>Conseils, ressources et mises en relation pour faire grandir chaque projet.</p>
                <a href="<?php echo ROOT_URL . '/contact.php'; ?>">Parler à l’équipe →</a>
            </article>
        </div>
    </section>

    <section class="home-section">
        <div class="section-heading reveal">
            <span class="eyebrow">Dernières actualités</span>
            <h2>Les nouvelles du BEC et des initiatives locales.</h2>
            <p>Suivez nos actions, nos portraits d’étudiants et les rendez-vous qui font vibrer le campus.</p>
        </div>
        <?php if (!empty($articles)): ?>
            <div class="home-grid home-grid--three">
                <?php foreach ($articles as $article): ?>
                    <?php
                    $imagePath = !empty($article['urlPhotArt'])
                        ? ROOT_URL . '/src/uploads/' . htmlspecialchars($article['urlPhotArt'])
                        : ROOT_URL . '/src/images/article.png';
                    $excerpt = isset($article['libChapoArt'])
                        ? substr($article['libChapoArt'], 0, 120) . (strlen($article['libChapoArt']) > 120 ? '...' : '')
                        : '';
                    ?>
                    <article class="news-card reveal">
                        <img src="<?php echo $imagePath; ?>" alt="Image article">
                        <h3><?php echo htmlspecialchars($article['libTitrArt']); ?></h3>
                        <p><?php echo htmlspecialchars($excerpt); ?></p>
                        <a href="<?php echo ROOT_URL . '/article.php?numArt=' . $article['numArt']; ?>">Lire l'article →</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="reveal">Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </section>

    <section class="home-cta reveal">
        <div>
            <span class="eyebrow" style="color: rgba(255, 255, 255, 0.8);">Rejoignez-nous</span>
            <h2>Participez à l’aventure BEC et construisez la vie étudiante de demain.</h2>
            <p>Vous souhaitez collaborer, partager un projet ou proposer un événement ? Parlons-en.</p>
        </div>
        <div class="home-hero__actions">
            <a class="btn-secondary" href="<?php echo ROOT_URL . '/contact.php'; ?>">Écrire à l’équipe</a>
            <a class="btn-primary" href="<?php echo ROOT_URL . '/compte.php'; ?>">Créer un compte</a>
        </div>
    </section>
</main>

<script>
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.18 });

    revealElements.forEach((element) => observer.observe(element));
</script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
