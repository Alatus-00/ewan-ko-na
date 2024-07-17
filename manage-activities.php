<?php
session_start();
include 'dbconn.php'; 
include 'predefined-functions.php';

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

// CRUD operations for volunteer activities
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['volunteer_crud'])) {
    $action = $_POST['action'];
    $activity_id = $_POST['activity_id'] ?? null;
    $user_id = $_POST['user_id'];
    $activity_date = htmlspecialchars($_POST['activity_date']);
    $shelter_name = htmlspecialchars($_POST['shelter_name']);
    $activity_description = htmlspecialchars($_POST['activity_description']);

    if ($action == 'create') {
        $stmt = $conn->prepare("INSERT INTO volunteer_activities (user_id, activity_date, shelter_name, activity_description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $user_id, $activity_date, $shelter_name, $activity_description);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'update' && $activity_id) {
        $stmt = $conn->prepare("UPDATE volunteer_activities SET user_id = ?, activity_date = ?, shelter_name = ?, activity_description = ? WHERE activity_id = ?");
        $stmt->bind_param('isssi', $user_id, $activity_date, $shelter_name, $activity_description, $activity_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'delete' && $activity_id) {
        $stmt = $conn->prepare("DELETE FROM volunteer_activities WHERE activity_id = ?");
        $stmt->bind_param('i', $activity_id);
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
    <title>Manage Veterinarian</title>
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
        <h2 class="section__header">Manage Veterinarian</h2>
        <p class="section__description">
            Create, Update, Delete Veterinarians' Data in the database.
        </p>
    </div>
    <div class="appointment__form__container">
<form method="post" class="appointment__form">
<h3>Manage Volunteer Activities</h3>
<form method="post">
    <input type="hidden" name="volunteer_crud" value="1">
    <div class="form__group">
    <label for="action">Action:</label>
    <select id="action" name="action" required>
        <option value="create">Create</option>
        <option value="update">Update</option>
        <option value="delete">Delete</option>
    </select>
    </div>
    <div class="form__group">
    <label for="activity_id">Activity ID:</label>
    <input type="number" id="activity_id" name="activity_id">
    </div>
    <div class="toggleable form__group">
    <label for="user_id">User ID:</label>
    <input type="number" id="user_id" name="user_id" required>
    </div>
    <div class="toggleable form__group">
    <label for="activity_date">Activity Date:</label>
    <input type="date" id="activity_date" name="activity_date" required>
    </div>
    <div class="toggleable form__group">
    <label for="shelter_name">Shelter Name:</label>
    <input type="text" id="shelter_name" name="shelter_name" required>
    </div>
    <div class="toggleable form__group">
    <label for="activity_description">Activity Description:</label>
    <textarea id="activity_description" name="activity_description" required></textarea>
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