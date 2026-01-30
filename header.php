<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$pseudoMemb = $_SESSION['pseudoMemb'] ?? null;
$numStat = $_SESSION['numStat'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BEC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL . '/Romain/assets/css/reset.css'; ?>" rel="stylesheet">
    <link href="<?php echo ROOT_URL . '/Romain/assets/css/variables.css'; ?>" rel="stylesheet">
    <link href="<?php echo ROOT_URL . '/Romain/assets/css/system.css'; ?>" rel="stylesheet">
    <link href="<?php echo ROOT_URL . '/Romain/assets/css/style.css'; ?>" rel="stylesheet">
    <link href="<?php echo ROOT_URL . '/Romain/assets/css/fonts.css'; ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="/romain/assets/images/logo.png" />
    <?php if (!empty($pageStyles) && is_array($pageStyles)) : ?>
        <?php foreach ($pageStyles as $stylePath) : ?>
            <link href="<?php echo htmlspecialchars($stylePath); ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>


    <style>
        :root {
            --bec-offwhite: #f6f1ea;
            --bec-dark: #1c1c1c;
            --bec-accent: #67081D;
        }

        body {
            background-color: var(--bec-offwhite);
            color: var(--bec-dark);
        }

        .site-main {
            text-align: left;
            min-height: 60vh;
        }

        .site-header .navbar-brand {
            font-weight: 700;
            color: var(--bec-dark);
        }

        .site-header {
            background-color: transparent;
            border-bottom: none;
        }

        .site-header .navbar-brand span {
            font-size: 1.1rem;
        }

        .site-header .navbar-nav .nav-link {
            color: var(--bec-dark);
            font-weight: 500;
        }

        .site-header .header-nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .site-header .header-nav a {
            color: var(--bec-dark);
            text-decoration: none;
            font-weight: 500;
            font-family: "Montserrat", sans-serif;
        }

        .site-header .header-nav a:hover,
        .site-header .header-nav a:focus {
            color: var(--bec-accent);
        }

        .site-header .navbar-nav .nav-link:hover,
        .site-header .navbar-nav .nav-link:focus {
            color: var(--bec-accent);
        }

        .site-logo {
            height: 44px;
            width: auto;
        }

        .btn-bec-primary {
            background-color: var(--bec-accent);
            border-color: var(--bec-accent);
            color: #fff;
        }

        .btn-bec-primary:hover {
            background-color: #8a0a27;
            border-color: #8a0a27;
        }

        .btn-bec-outline {
            border-color: rgba(103, 8, 29, 0.35);
            color: var(--bec-accent);
        }

        .btn-bec-outline:hover {
            background-color: rgba(103, 8, 29, 0.08);
        }

        .site-footer {
            background-color: #fff;
        }

        .site-footer a,
        .site-footer h3,
        .site-footer h4,
        .site-footer p {
            color: var(--bec-dark);
        }

        .cookie-popup {
            position: fixed;
            bottom: 24px;
            right: 24px;
            left: auto;
            width: min(420px, 90vw);
            background-color: #1f1f1f;
            color: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            text-align: left;
        }

        .cookie-content {
            max-width: 100%;
        }

        .cookie-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-start;
        }

        .cookie-buttons button {
            border-radius: 999px;
            padding: 10px 16px;
        }

        @media (max-width: 768px) {
            .site-main {
                padding-top: 20px;
                padding-bottom: 40px;
            }
        }
    </style>

</head>

<body>
    <header class="site-header">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-3 py-3">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo ROOT_URL . '/index.php'; ?>">
                <img src="<?php echo ROOT_URL . '/Romain/assets/images/logo.png'; ?>" alt="BEC" class="site-logo">
                <span>Bordeaux Étudiant Club</span>
            </a>

            <nav class="header-nav">
                <ul>
                    <li>
                        <a href="<?php echo ROOT_URL . '/index.php'; ?>">Accueil</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL . '/notre-histoire.php'; ?>">Notre histoire</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL . '/actualites.php'; ?>">Actualités</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL . '/contact.php'; ?>">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL . '/anciens-et-amis.php'; ?>">Anciens et amis</a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <?php if ($pseudoMemb): ?>
                    <details class="header-menu">
                        <summary class="header-menu__toggle">
                            <span class="header-user"><?php echo htmlspecialchars($pseudoMemb); ?></span>
                            <span class="header-burger" aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </summary>
                        <div class="header-menu__dropdown">
                            <a href="<?php echo ROOT_URL . '/compte.php'; ?>">Mon compte</a>
                            <?php if ($numStat === 1 || $numStat === 2): ?>
                                <a href="<?php echo ROOT_URL . '/views/backend/dashboard.php'; ?>">Panneau admin</a>
                            <?php endif; ?>
                            <a class="header-menu__logout" href="<?php echo ROOT_URL . '/api/security/disconnect.php'; ?>">Déconnexion</a>
                        </div>
                    </details>
                <?php else: ?>
                    <a class="btn btn-bec-primary" href="<?php echo ROOT_URL . '/views/backend/security/login.php'; ?>">
                        Connexion / Inscription
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="site-main container py-5">
