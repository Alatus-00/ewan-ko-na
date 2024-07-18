<?php
session_start();
include 'dbconn.php'; 
include 'predefined-functions.php';

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

// CRUD operations for vets
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vet_crud'])) {
    $action = $_POST['action'];
    $vet_id = $_POST['vet_id'] ?? null;
    $vet_name = htmlspecialchars($_POST['vet_name']);
    $vet_expertise = htmlspecialchars($_POST['vet_expertise']);

    if ($action == 'create') {
        $stmt = $conn->prepare("INSERT INTO veterinarians (vet_name, vet_expertise) VALUES (?, ?)");
        $stmt->bind_param('ss', $vet_name, $vet_expertise);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'update' && $vet_id) {
        $stmt = $conn->prepare("UPDATE veterinarians SET vet_name = ?, vet_expertise = ? WHERE vet_id = ?");
        $stmt->bind_param('ssi', $vet_name, $vet_expertise, $vet_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'delete' && $vet_id) {
        $stmt = $conn->prepare("DELETE FROM veterinarians WHERE vet_id = ?");
        $stmt->bind_param('i', $vet_id);
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
<?php staffHeader(); ?>
<section class="section__container appointment__container" id="appointment">
    <div class="appointment__header">
        <h2 class="section__header">Manage Veterinarian</h2>
        <p class="section__description">
            Create, Update, Delete Veterinarians' Data in the database.
        </p>
    </div>
    <div class="appointment__form__container">
        <form method="post" class="appointment__form">
            <input type="hidden" name="vet_crud" value="1">
            <h3>Manage Veterinarians</h3>
            <div class="form__group">
                <label for="action">Action:</label>
                <select id="action" name="action" required>
                    <option value="create">Create</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="form__group">
                <label for="vet_id">Vet ID:</label>
                <input type="number" id="vet_id" name="vet_id">
            </div>
            <div class="toggleable form__group">
                <label for="vet_name">Vet Name:</label>
                <input type="text" id="vet_name" name="vet_name" required>
            </div>
            <div class="toggleable form__group">
                <label for="vet_expertise">Vet Expertise:</label>
                <input type="text" id="vet_expertise" name="vet_expertise" required>
            </div>
            <div class="form__group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>
<?php callFooter(); ?>
</body>
</html>

