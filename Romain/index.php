<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
sql_connect();

$articles = sql_select("ARTICLE", "*", null, null, "RAND()", 3);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BEC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap et CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/reset.css" rel="stylesheet">
    <link href="assets/css/variables.css" rel="stylesheet">
    <link href="assets/css/system.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/fonts.css" rel="stylesheet">

    <style>
    .box {
        height: 250px;
        margin-bottom: 20px;
    }
    .article-image {
        width: 100%;
        object-fit: cover;
    }
    .article-content {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 6px;
        height: 100%;
    }
    .exercice {
        margin-top: 80px;
    }
    </style>
</head>

<body>

<!-- header -->
    <header class="header">
        <div class="header-logo">
            <a href="index.php"><img src="assets/images/logo.png" alt="BEC" class="header-logo"></a>
        </div>

        <nav class="header-nav">
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="#Contact">Contact</a>
                </li>
                <li>
                    <a href="#Anciens et amis">Anciens et amis</a>
                </li>
                <li>
                    <button>Se connecter</button>
                </li>
                <li>
                    <button>S'inscrire</button>
                </li>
            </ul>
        </nav>
    </header>

<!-- Carousel -->


<!-- Actus -->
    <h2>Dernières actualités</h2>

    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $index => $article): ?>
            <?php
            $imagePath = !empty($article['urlPhotArt'])
                ? ROOT_URL . '/src/uploads/' . htmlspecialchars($article['urlPhotArt'])
                : ROOT_URL . '/src/images/article1.png';
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
        <button>Découvrez l'ensemble de nos actualités</button>
    </a>

<!-- footer-->
    <footer class="footer">
        <div class="footer-left">
            <h3>
            Contactez-nous :
            </h3>
            <h4>
            secretariat@bec-bordeaux
            </h4>
            <h4>
            06 71 94 23 80 - 05 56 91 83 50
            </h4>
                <a href="https://www.instagram.com/becfootballclub/?hl=fr" class="social-icon"><img src="assets/images/instagram.png" alt="Instagram"></a>
                <a href="https://www.facebook.com/becofficiel/?locale=fr_FR" class="social-icon"><img src="assets/images/facebook.png" alt="Facebook"></a>
        </div>

        <div class="footer-right">
            <img src="assets/images/map.png" class="map">
        </div>
    </footer>


</body>
</html>
