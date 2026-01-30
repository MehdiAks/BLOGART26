<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$pseudoMemb = $_SESSION['pseudoMemb'] ?? null;
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
                    <a href="<?php echo ROOT_URL . '/contact.php'; ?>">Contact</a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL . '/anciens-et-amis.php'; ?>">Anciens et amis</a>
                </li>
            </ul>
            <div class="header-actions">
                <?php if ($pseudoMemb): ?>
                    <span class="header-user"><?php echo htmlspecialchars($pseudoMemb); ?></span>
                    <a href="<?php echo ROOT_URL . '/views/backend/dashboard.php'; ?>">
                        <button type="button">Panneau admin</button>
                    </a>
                <?php else: ?>
                    <a href="<?php echo ROOT_URL . '/views/backend/security/login.php'; ?>">
                        <button type="button">Connexion / Inscription</button>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
