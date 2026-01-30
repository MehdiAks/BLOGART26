<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$numMemb = $_SESSION['user_id'] ?? null;
if (!$numMemb) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}

$memberData = sql_select(
    "MEMBRE INNER JOIN STATUT ON MEMBRE.numStat = STATUT.numStat",
    "MEMBRE.numMemb, MEMBRE.pseudoMemb, MEMBRE.prenomMemb, MEMBRE.nomMemb, MEMBRE.eMailMemb, STATUT.libStat",
    "MEMBRE.numMemb = $numMemb"
)[0] ?? [];

$totalComments = sql_select("comment", "COUNT(*) as total", "numMemb = $numMemb")[0]['total'] ?? 0;
$pendingComments = sql_select(
    "comment",
    "COUNT(*) as total",
    "numMemb = $numMemb AND attModOK = 0 AND delLogiq = 0"
)[0]['total'] ?? 0;
$publishedComments = sql_select(
    "comment",
    "COUNT(*) as total",
    "numMemb = $numMemb AND attModOK = 1 AND delLogiq = 0"
)[0]['total'] ?? 0;

$recentComments = sql_select(
    "comment c INNER JOIN article a ON c.numArt = a.numArt",
    "c.libCom, c.dtCreaCom, c.attModOK, c.delLogiq, a.libTitrArt",
    "c.numMemb = $numMemb",
    null,
    "c.dtCreaCom DESC",
    5
);

require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>

<main class="container my-5">
    <h1 class="mb-4">Mon compte</h1>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Statut</h2>
                    <p class="mb-1"><strong>Pseudo :</strong> <?php echo htmlspecialchars($memberData['pseudoMemb'] ?? ''); ?></p>
                    <p class="mb-1"><strong>Statut :</strong> <?php echo htmlspecialchars($memberData['libStat'] ?? ''); ?></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Coordonnées</h2>
                    <p class="mb-1"><strong>Prénom :</strong> <?php echo htmlspecialchars($memberData['prenomMemb'] ?? ''); ?></p>
                    <p class="mb-1"><strong>Nom :</strong> <?php echo htmlspecialchars($memberData['nomMemb'] ?? ''); ?></p>
                    <p class="mb-1"><strong>Email :</strong> <?php echo htmlspecialchars($memberData['eMailMemb'] ?? ''); ?></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 mb-3">Commentaires</h2>
                    <p class="mb-1"><strong>Total :</strong> <?php echo htmlspecialchars((string) $totalComments); ?></p>
                    <p class="mb-1"><strong>En attente :</strong> <?php echo htmlspecialchars((string) $pendingComments); ?></p>
                    <p class="mb-1"><strong>Publiés :</strong> <?php echo htmlspecialchars((string) $publishedComments); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h2 class="h5 mb-3">Derniers commentaires</h2>
            <?php if (!empty($recentComments)): ?>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Commentaire</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentComments as $comment): ?>
                                <?php
                                $statusLabel = 'En attente';
                                if ((int) $comment['delLogiq'] === 1) {
                                    $statusLabel = 'Supprimé';
                                } elseif ((int) $comment['attModOK'] === 1) {
                                    $statusLabel = 'Publié';
                                }
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($comment['libTitrArt']); ?></td>
                                    <td><?php echo htmlspecialchars($comment['libCom']); ?></td>
                                    <td><?php echo htmlspecialchars($comment['dtCreaCom']); ?></td>
                                    <td><?php echo htmlspecialchars($statusLabel); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Vous n'avez pas encore publié de commentaire.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
