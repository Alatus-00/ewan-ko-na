<?php
session_start();
include 'dbconn.php'; 
include 'predefined-functions.php'; 

// Check if the vet is logged in
// if (!isset($_SESSION['vet_id'])) {
//     header("Location: login.php");
//     exit();
// }

// CRUD operations for appointments
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

// Fetch appointments
$appointments = $conn->query("SELECT * FROM sessions WHERE vet_id = " . $_SESSION['vet_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php callHeader(); ?>

<h2>Vet Dashboard</h2>

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
        <input type="number" id="vet_id" name="vet_id" required value="<?= htmlspecialchars($_SESSION['vet_id']) ?>" readonly>
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

<h3>Appointments</h3>
<table>
    <thead>
        <tr>
            <th>Session ID</th>
            <th>Pet ID</th>
            <th>Session Date</th>
            <th>Session Details</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($appointment = $appointments->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($appointment['session_id']) ?></td>
                <td><?= htmlspecialchars($appointment['pet_id']) ?></td>
                <td><?= htmlspecialchars($appointment['session_date']) ?></td>
                <td><?= htmlspecialchars($appointment['session_details']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
