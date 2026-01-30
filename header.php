<?php
//load config
require_once 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="src/images/article1.png" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="/src/images/article1.png" alt="Logo Bordeaux étudiant club" width="36" height="36" class="me-2" />
      Bordeaux étudiant club
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        <li class="nav-item">
          <a class="nav-link" href="/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#Contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#Anciens-et-amis">Anciens &amp; amis</a>
        </li>
        <?php if (!empty($_SESSION['user_id'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="/views/backend/dashboard.php">Admin</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <?php if (!empty($_SESSION['user_id']) && !empty($_SESSION['pseudoMemb'])) : ?>
            <a class="btn btn-outline-dark" href="/api/security/disconnect.php" role="button">
              👤 <?= htmlspecialchars($_SESSION['pseudoMemb']); ?>
            </a>
          <?php else : ?>
            <a class="btn btn-dark" href="/views/backend/security/login.php" role="button">
              👤 Connexion / Inscription
            </a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
