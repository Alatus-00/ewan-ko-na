<?php
include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $activity_date = $_POST["activity_date"];
    $shelter_name = $_POST["shelter_name"];
    $activity_description = $_POST["activity_description"];

    $stmt = $conn->prepare("INSERT INTO volunteer_activities (user_id, activity_date, shelter_name, activity_description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $activity_date, $shelter_name, $activity_description);

    if ($stmt->execute()) {
        echo "New volunteer activity recorded successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer at Animal Shelter</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    
<?php
include 'predefined-functions.php';
callHeader();
?>

<section class="section__container">
    <div class="container">
        <h1>Volunteer at Animal Shelter</h1>
        <form action="volunteer.php" method="post">
            <label for="activity_date">Date:</label>
            <input type="date" id="activity_date" name="activity_date" required>

            <label for="shelter_name">Shelter Name:</label>
            <input type="text" id="shelter_name" name="shelter_name" required>

            <label for="activity_description">Activity Description:</label>
            <textarea id="activity_description" name="activity_description" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</section>

<?php
callFooter();
?>
</body>
</html>
