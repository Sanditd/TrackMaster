<div class="container">
    <h1><?= htmlspecialchars($sport['sportName'] ?? 'Sport') ?> Details</h1>

    <?php if (isset($sport)): ?>
        <!-- General Sport Details -->
        <div class="sport-details">
            <h2>General Information</h2>
            <br>
            <br>
            <div class="detail-row">
                <strong>Sport Type:</strong>
                <span><?= htmlspecialchars($sport['sportType'] ?? 'N/A') ?></span>
            </div>
            <div class="detail-row">
                <strong>Duration (Minutes):</strong>
                <span><?= htmlspecialchars($details['durationMinutes'] ?? 'N/A') ?></span>
                <button class="edit-btn" onclick="openEditModal('Duration (Minutes)', '<?= $details['durationMinutes'] ?? '' ?>', 'durationMinutes')">Edit</button>
            </div>
            <div class="detail-row">
                <strong>Is Indoor:</strong>
                <span><?= htmlspecialchars($details['isIndoor'] ?? 'N/A') ?></span>
                <button class="edit-btn" onclick="openEditModal('Is Indoor', '<?= $details['isIndoor'] ?? '' ?>', 'isIndoor')">Edit</button>
            </div>
            <div class="detail-row">
                <strong>Created At:</strong>
                <span><?= htmlspecialchars($details['created_at'] ?? 'N/A') ?></span>
                
            </div>
            <div class="detail-row">
                <strong>Updated At:</strong>
                <span><?= htmlspecialchars($details['updated_at'] ?? 'N/A') ?></span>
               
            </div>
        </div>

        <!-- Additional Sport Details -->
        <?php if (isset($details)): ?>
            <div class="sport-details">
                <h2>Additional Information</h2>
                <br><br>
                <div class="detail-row">
                    <strong>Equipment:</strong>
                    <span><?= htmlspecialchars($details['equipment'] ?? 'N/A') ?></span>
                    <button class="edit-btn" onclick="openEditModal('Equipment', '<?= $details['equipment'] ?? '' ?>', 'equipment')">Edit</button>
                </div>
                <div class="detail-row">
                    <strong>Categories:</strong>
                    <span><?= htmlspecialchars($details['categories'] ?? 'N/A') ?></span>
                    <button class="edit-btn" onclick="openEditModal('Categories', '<?= $details['categories'] ?? '' ?>', 'categories')">Edit</button>
                </div>
                <div class="detail-row">
                    <strong>Scoring System:</strong>
                    <span><?= htmlspecialchars($details['scoringSystem'] ?? 'N/A') ?></span>
                    <button class="edit-btn" onclick="openEditModal('Scoring System', '<?= $details['scoringSystem'] ?? '' ?>', 'scoringSystem')">Edit</button>
                </div>
                <div class="detail-row">
                    <strong>Rules Link:</strong>
                    <span>
                        <a href="<?= htmlspecialchars($details['rulesLink'] ?? '#') ?>" target="_blank">
                            <?= htmlspecialchars($details['rulesLink'] ?? 'N/A') ?>
                        </a>
                    </span>
                    <button class="edit-btn" onclick="openEditModal('Rules Link', '<?= $details['rulesLink'] ?? '' ?>', 'rulesLink')">Edit</button>
                    <button class="edit-btn" onclick="openEditModal('Sport ID', '<?= $sport['sportId'] ?? '' ?>', 'sportId', '<?= $sport['id'] ?? '' ?>')" style="display:none"></button>

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
        <a href="<?= ROOT ?>/admin/sportManage" class="btn">Back to Manage Sports</a>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 id="editTitle">Edit</h3>
            <form id="editForm" method="post" action="<?= ROOT ?>/admin/updateIndSportDetail">
                <input type="hidden" name="fieldName" id="fieldName">
                <input type="hidden" name="sportId" id="sportId" value="<?= htmlspecialchars($sport['sportId'] ?? '') ?>">
                <input type="text" name="fieldValue" id="fieldValue">
                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn" onclick="closeEditModal()">Cancel</button>
            </form>

        </div>
    </div>
</div>

<script>
function openEditModal(field, value, fieldName, sportId) {
    document.getElementById('editTitle').textContent = 'Edit ' + field;
    document.getElementById('fieldName').value = fieldName;
    document.getElementById('fieldValue').value = value;

    // Set the sportId in the hidden input
    document.getElementById('sportId').value = sportId;

    document.getElementById('editModal').style.display = 'block';
}


function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>
