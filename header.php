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

        .box {
            height: 250px;
            margin-bottom: 20px;
        }

        .article-image {
            width: 100%;
            object-fit: cover;
        }

        .article-content {
            background-color: var(--bec-offwhite);
            padding: 20px;
            border-radius: 6px;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .article-content p {
            color: var(--bec-dark);
        }

        .article-content a {
            color: var(--bec-accent);
            font-weight: 600;
        }

        .exercice {
            margin-top: 80px;
        }

        .header {
            background-color: var(--bec-offwhite);
            align-items: center;
            min-height: 96px;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .header-nav ul {
            align-items: center;
            gap: 40px;
            margin: 0;
        }

        .header-nav li {
            display: flex;
            align-items: center;
        }

        .header-nav a {
            color: var(--bec-dark);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-user {
            font-weight: 600;
            color: var(--bec-dark);
        }

        .header-menu {
            position: relative;
        }

        .header-menu summary {
            list-style: none;
        }

        .header-menu summary::-webkit-details-marker {
            display: none;
        }

        .header-menu__toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .header-burger {
            display: inline-flex;
            flex-direction: column;
            gap: 4px;
        }

        .header-burger span {
            width: 20px;
            height: 2px;
            background-color: var(--bec-dark);
            display: block;
        }

        .header-menu__dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 12px);
            background: #fff;
            border-radius: 12px;
            padding: 12px;
            min-width: 220px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 10;
        }

        .header-menu:not([open]) .header-menu__dropdown {
            display: none;
        }

        .header-menu__dropdown a,
        .header-menu__dropdown button {
            text-align: left;
            background: transparent;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            color: var(--bec-dark);
            font-weight: 600;
        }

        .header-menu__dropdown a:hover,
        .header-menu__dropdown button:hover {
            background-color: rgba(103, 8, 29, 0.08);
        }

        .header-menu__dropdown .header-menu__logout {
            color: var(--bec-accent);
        }

        .header-actions button {
            background-color: var(--bec-accent);
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 600;
        }

        .header-actions button:hover {
            background-color: #8a0a27;
        }

        .footer {
            background-color: var(--bec-offwhite);
            color: var(--bec-dark);
        }

        .footer a,
        .footer h3,
        .footer h4 {
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
            .header {
                flex-direction: column;
                gap: 16px;
                padding: 16px;
            }

            .header-nav {
                flex-direction: column;
            }

            .header-actions {
                flex-direction: column;
            }
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="header-logo">
            <a href="<?php echo ROOT_URL . '/index.php'; ?>">
                <img src="<?php echo ROOT_URL . '/Romain/assets/images/logo.png'; ?>" alt="BEC" class="header-logo">
            </a>
        </div>

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
                    <a href="<?php echo ROOT_URL . '/views/backend/security/login.php'; ?>">
                        <button type="button">Connexion / Inscription</button>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
