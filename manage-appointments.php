<?php
session_start();
include 'dbconn.php'; 
include 'predefined-functions.php';

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

// CRUD operations for appointments
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_crud'])) {
    $action = $_POST['action'];
    $session_id = $_POST['session_id'] ?? null;
    $pet_id = $_POST['pet_id'];
    $vet_id = $_POST['vet_id'];
    $session_date = htmlspecialchars($_POST['session_date']);
    $session_details = htmlspecialchars($_POST['session_details']);

    if ($action == 'create') {
        $stmt = $conn->prepare("INSERT INTO sessions (pet_id, vet_id, session_date, session_details) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiss', $pet_id, $vet_id, $session_date, $session_details);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'update' && $session_id) {
        $stmt = $conn->prepare("UPDATE sessions SET pet_id = ?, vet_id = ?, session_date = ?, session_details = ? WHERE session_id = ?");
        $stmt->bind_param('iissi', $pet_id, $vet_id, $session_date, $session_details, $session_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'delete' && $session_id) {
        $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
        $stmt->bind_param('i', $session_id);
        $stmt->execute();
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function toggleFields(action) {
            var fields = document.querySelectorAll('.toggleable');
            if (action === 'delete') {
                fields.forEach(field => field.style.display = 'none');
            } else {
                fields.forEach(field => field.style.display = 'flex');
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const actionSelect = document.getElementById('action');
            actionSelect.addEventListener('change', (e) => toggleFields(e.target.value));
            toggleFields(actionSelect.value);
        });
    </script>
</head>
<body>
<?php callHeader(); ?>
<section class="section__container appointment__container" id="appointment">
    <div class="appointment__header">
        <h2 class="section__header">Manage Appointments</h2>
        <p class="section__description">
            Create, Update, Delete Appointments' Data in the database.
        </p>
    </div>
    <div class="appointment__form__container">
    <form method="post" class="appointment__form">
    <h3>Manage Appointments</h3>
    <form method="post">
        <input type="hidden" name="appointment_crud" value="1">
        <div class="form__group">
        <label for="action">Action:</label>
        <select id="action" name="action" required>
            <option value="create">Create</option>
            <option value="update">Update</option>
            <option value="delete">Delete</option>
        </select>
        </div>
        <div class="form__group">
        <label for="session_id">Session ID (for update/delete):</label>
        <input type="number" id="session_id" name="session_id">
        </div>
        <div class="toggleable form__group">
        <label for="pet_id">Pet ID:</label>
        <input type="number" id="pet_id" name="pet_id" required>
        </div>
        <div class="toggleable form__group">
        <label for="vet_id">Vet ID:</label>
        <input type="number" id="vet_id" name="vet_id" required>
        </div>
        <div class="toggleable form__group">
        <label for="session_date">Session Date:</label>
        <input type="date" id="session_date" name="session_date" required>
        </div>
        <div class="toggleable form__group">
        <label for="session_details">Session Details:</label>
        <textarea id="session_details" name="session_details" required></textarea>
        </div>
        <div class="form__group">
        <button type="submit">Submit</button>
        </div>
    </form>
    </form>
    </div>

</section>
</body>
</html>