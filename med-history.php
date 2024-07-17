<?php
session_start();
include 'db_connect.php'; // Include your database connection file
include 'predefined-functions.php'; // Include the file with the predefined function

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user name
$query = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($user_name);
$query->fetch();
$query->close();

// Fetch pets' medical history
$query = $conn->prepare("
    SELECT 
        p.pet_id, p.pet_name, p.pet_breed, p.pet_weight, p.pet_age, v.vet_name, mh.session_type 
    FROM 
        pets p 
    JOIN 
        medical_history mh ON p.pet_id = mh.pet_id 
    JOIN 
        vets v ON mh.vet_id = v.vet_id 
    WHERE 
        p.user_id = ?
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Medical History</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<?php callHeader(); ?> <!-- Call the header function -->

<div class="section__container">
    <h2 class="section__header">Medical History of <?= htmlspecialchars($user_name) ?>'s Pets</h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Pet Breed</th>
                    <th>Pet Weight</th>
                    <th>Pet Age</th>
                    <th>Vet Name</th>
                    <th>Session Type</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['pet_id']) ?></td>
                        <td><?= htmlspecialchars($row['pet_name']) ?></td>
                        <td><?= htmlspecialchars($row['pet_breed']) ?></td>
                        <td><?= htmlspecialchars($row['pet_weight']) ?></td>
                        <td><?= htmlspecialchars($row['pet_age']) ?></td>
                        <td><?= htmlspecialchars($row['vet_name']) ?></td>
                        <td><?= htmlspecialchars($row['session_type']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php
$query->close();
$conn->close();
?>
