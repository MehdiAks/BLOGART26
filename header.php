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

        .site-header .navbar-brand span {
            font-size: 1.1rem;
        }

        .site-header .navbar-nav .nav-link {
            color: var(--bec-dark);
            font-weight: 500;
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
    <header class="site-header border-bottom bg-white">
        <nav class="navbar navbar-expand-lg navbar-light container py-3">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo ROOT_URL . '/index.php'; ?>">
                <img src="<?php echo ROOT_URL . '/Romain/assets/images/logo.png'; ?>" alt="BEC" class="site-logo">
                <span>Bordeaux Étudiant Club</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Ouvrir le menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL . '/index.php'; ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL . '/actualites.php'; ?>">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL . '/contact.php'; ?>">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL . '/anciens-et-amis.php'; ?>">Anciens et amis</a>
                    </li>
                </ul>
                <div class="d-flex align-items-lg-center gap-2 ms-lg-3 mt-3 mt-lg-0">
                    <?php if ($pseudoMemb): ?>
                        <div class="dropdown">
                            <button class="btn btn-bec-outline dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($pseudoMemb); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo ROOT_URL . '/compte.php'; ?>">Mon compte</a></li>
                                <?php if ($numStat === 1 || $numStat === 2): ?>
                                    <li><a class="dropdown-item" href="<?php echo ROOT_URL . '/views/backend/dashboard.php'; ?>">Panneau admin</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo ROOT_URL . '/api/security/disconnect.php'; ?>">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-bec-primary" href="<?php echo ROOT_URL . '/views/backend/security/login.php'; ?>">
                            Connexion / Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <main class="site-main container py-5">
