<div class="container">
    <?php if (empty($data)): ?>
        <p>No data available</p>
    <?php else: ?>
        <h1><?= htmlspecialchars($sport['sportName'] ?? 'Sport') ?> Details</h1>
        <form method="POST" action="<?= ROOT ?>/admin/updateSportDetails">
            <div class="sport-details">
                <h2>General Information</h2>
                <br><br>
                <div class="detail-row">
                    <strong>Sport Type:</strong>
                    <span><?= htmlspecialchars($sport['sportType'] === 'teamSport' ? 'Team Sport' : ($sport['sportType'] ?? 'N/A')) ?></span>
                </div>
                <div class="detail-row">
                    <strong>Number of Players:</strong>
                    <span id="numPlayers"><?= htmlspecialchars($details['numPlayers'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('numPlayers', 'Number of Players')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Positions:</strong>
                    <span id="positions"><?= htmlspecialchars($details['positions'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('positions', 'Positions')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Team Formation:</strong>
                    <span id="teamFormation"><?= htmlspecialchars($details['teamFormation'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('teamFormation', 'Team Formation')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Duration (Minutes):</strong>
                    <span id="durationMinutes"><?= htmlspecialchars($details['durationMinutes'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('durationMinutes', 'Duration (Minutes)')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Half-Time Duration:</strong>
                    <span id="halfTimeDuration"><?= htmlspecialchars($details['halfTimeDuration'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('halfTimeDuration', 'Half-Time Duration')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Location Type:</strong>
                    <span id="isOutdoor"><?= htmlspecialchars($details['isOutdoor'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('isOutdoor', 'Location Type')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Equipment:</strong>
                    <span id="equipment"><?= htmlspecialchars($details['equipment'] ?? 'N/A') ?></span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('equipment', 'Equipment')">Edit</button> -->
                </div>
                <div class="detail-row">
                    <strong>Rules Link:</strong>
                    <span id="rulesLink">
                        <a href="<?= htmlspecialchars($details['rulesLink'] ?? '#') ?>" target="_blank">
                            <?= htmlspecialchars($details['rulesLink'] ?? 'N/A') ?>
                        </a>
                    </span>
                    <!-- <button type="button" class="edit-btn" onclick="openEditModal('rulesLink', 'Rules Link')">Edit</button> -->
                </div>
            </div>
            <!-- Hidden Input for Edited Field -->
            <input type="hidden" id="editField" name="field">
            <input type="hidden" id="editValue" name="value">

            <!-- Submit Button for Form -->
            <button type="submit" id="submitForm" style="display: none;"></button>
        </form>
        <div class="back-button">
            <a href="<?= ROOT ?>/admin/sportManage" class="btn">Back to Manage Sports</a>
        </div>
    <?php endif; ?>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal hidden">
    <div class="modal-content">
        <h3 id="editModalTitle"></h3>
        <input type="text" id="editInput" placeholder="Enter new value">
        <button class="save-btn" onclick="saveChanges()">Save</button>
        <button class="close-btn" onclick="closeEditModal()">Close</button>
    </div>
</div>

<script>
    let currentField = '';

    function openEditModal(fieldId, fieldName) {
        document.getElementById('editTitle').textContent = 'Edit ' + field;
    document.getElementById('fieldName').value = fieldName;
    document.getElementById('fieldValue').value = value;

    // Set the sportId in the hidden input
    document.getElementById('sportId').value = sportId;

    document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        currentField = '';
    }

    function saveChanges() {
        const newValue = document.getElementById('editInput').value.trim();
        if (currentField) {
            // Update the hidden inputs for form submission
            document.getElementById('editField').value = currentField;
            document.getElementById('editValue').value = newValue;

            // Submit the form
            document.getElementById('submitForm').click();
        }
    }
</script>


