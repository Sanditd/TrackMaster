<div class="container">
    <h1><?= htmlspecialchars($sport['sportName'] ?? 'Sport') ?> Details</h1>

    <?php if (isset($sport)): ?>
        <!-- General Sport Details -->
        <div class="sport-details">
            <h2>General Information</h2>
            <div class="detail-row">
                <strong>Sport Type:</strong>
                <span><?= htmlspecialchars($sport['sportType'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Number of Players:</strong>
                <span><?= htmlspecialchars($sport['numPlayers'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Positions:</strong>
                <span><?= htmlspecialchars($sport['positions'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Team Formation:</strong>
                <span><?= htmlspecialchars($sport['teamFormation'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Duration (Minutes):</strong>
                <span><?= htmlspecialchars($sport['durationMinutes'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Half-Time Duration:</strong>
                <span><?= htmlspecialchars($sport['halfTimeDuration'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Is Outdoor:</strong>
                <span><?= htmlspecialchars(isset($sport['isOutdoor']) ? ($sport['isOutdoor'] ? 'Yes' : 'No') : 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Equipment:</strong>
                <span><?= htmlspecialchars($sport['equipment'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Rules Link:</strong>
                <span>
                    <a href="<?= htmlspecialchars($sport['rulesLink'] ?? '#') ?>" target="_blank">
                        <?= htmlspecialchars($sport['rulesLink'] ?? 'N/A') ?>
                    </a>
                </span>
            </div>
            <div class="detail-row">
                <strong>Created At:</strong>
                <span><?= htmlspecialchars($sport['created_at'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Updated At:</strong>
                <span><?= htmlspecialchars($sport['updated_at'] ?? 'N/A') ?></span>
            </div>
        </div>
    <?php else: ?>
        <p>Sport not found or invalid ID provided.</p>
    <?php endif; ?>

    <!-- Back Button -->
    <div class="back-button">
        <a href="<?= ROOT ?>/admin/sportManage" class="btn">Back to Manage Sports</a>
    </div>
</div>
