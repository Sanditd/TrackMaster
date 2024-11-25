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
                <strong>Duration (Minutes):</strong>
                <span><?= htmlspecialchars($sport['durationMinutes'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Is Indoor:</strong>
                <span><?= htmlspecialchars($sport['isIndoor'] ?? 'N/A') ?></span>
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

        <!-- Additional Sport Details -->
        <?php if (isset($details)): ?>
            <div class="sport-details">
                <h2>Additional Information</h2>
                <div class="detail-row">
                    <strong>Equipment:</strong>
                    <span><?= htmlspecialchars($details['equipment'] ?? 'N/A') ?></span>
                </div>
                <div class="detail-row">
                    <strong>Categories:</strong>
                    <span><?= htmlspecialchars($details['categories'] ?? 'N/A') ?></span>
                </div>
                <div class="detail-row">
                    <strong>Scoring System:</strong>
                    <span><?= htmlspecialchars($details['scoringSystem'] ?? 'N/A') ?></span>
                </div>
                <div class="detail-row">
                    <strong>Rules Link:</strong>
                    <span>
                        <a href="<?= htmlspecialchars($details['rulesLink'] ?? '#') ?>" target="_blank">
                            <?= htmlspecialchars($details['rulesLink'] ?? 'N/A') ?>
                        </a>
                    </span>
                </div>
            </div>
        <?php else: ?>
            <p>No additional details available for this sport.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Sport not found or invalid ID provided.</p>
    <?php endif; ?>

    <!-- Back Button -->
    <div class="back-button">
        <a href="<?= ROOT ?>/admin/sportManage/sadas" class="btn">Back to Manage Sports</a>
    </div>
</div>
