<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
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
                    <a href="#Contact">Contact</a>
                </li>
                <li>
                    <a href="#Anciens-et-amis">Anciens et amis</a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL . '/views/backend/security/login.php'; ?>">
                        <button type="button">Se connecter</button>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL . '/views/backend/security/signup.php'; ?>">
                        <button type="button">S'inscrire</button>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
