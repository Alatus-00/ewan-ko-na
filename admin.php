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

// Fetch recent users
$recent_users = $conn->query("SELECT * FROM users ORDER BY user_id DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
<?php callHeader(); ?>

<section class="section__container appointment__container" id="appointment">
        <div class="appointment__header">
            <h2 class="section__header">Admin Dashboard</h2>
            <p class="section__description">
                Manage Users, Veterinarians, Appointments, and Volunteer Activities.
            </p>
        </div>
        <br><br>
        <h2>Recent Users</h2>
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Given Name</th>
            <th>Middle Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Birthday</th>
            <th>Sex</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $recent_users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($user['user_id']) ?></td>
                <td><?= htmlspecialchars($user['given_name']) ?></td>
                <td><?= htmlspecialchars($user['middle_name']) ?></td>
                <td><?= htmlspecialchars($user['surname']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['contact_number']) ?></td>
                <td><?= htmlspecialchars($user['birthday']) ?></td>
                <td><?= htmlspecialchars($user['sex']) ?></td>
                <td><?= htmlspecialchars($user['address']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<br><br>
<hr>


<section class="section__container class__container">
      <h2 class="section__header">Manage</h2>
      <p class="section__description">
        For Creating, Updating, and Deleting data in the database.</p>
      <div class="class__grid">
        <a href="manage-users.php">
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/admin-1.jpg" alt="admin" />
          <div class="class__content">
            <h4>Manage Users</h4>
          </div>
        </div>
        </a>
        <a href="manage-vet.php">
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/admin-2.jpg" alt="admin" />
          <div class="class__content">
            <h4>Manage Veterinarians</h4>
          </div>
        </div>
        </a>
        <a href="manage-appointments.php">
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/admin-3.jpg" alt="admin" />
          <div class="class__content">
            <h4>Manage Appointments</h4>
          </div>
        </div>
        </a>
        <a href="manage-activities.php">
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/admin-4.jpg" alt="admin" />
          <div class="class__content">
            <h4>Manage Activities</h4>
          </div>
        </div>
        </a>
      </div>
    </section>


</section>

</body>
</html>

<?php
$conn->close();
?>
