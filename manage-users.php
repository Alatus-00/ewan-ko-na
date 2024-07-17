<?php
session_start();
include 'dbconn.php'; 
include 'predefined-functions.php';

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

// CRUD operations for users
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_crud'])) {
    $action = $_POST['action'];
    $user_id = $_POST['user_id'] ?? null;
    $given_name = htmlspecialchars($_POST['given_name'] ?? '');
    $middle_name = htmlspecialchars($_POST['middle_name'] ?? '');
    $surname = htmlspecialchars($_POST['surname'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $contact_number = htmlspecialchars($_POST['contact_number'] ?? '');
    $birthday = htmlspecialchars($_POST['birthday'] ?? '');
    $sex = htmlspecialchars($_POST['sex'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

    if ($action == 'create') {
        $stmt = $conn->prepare("INSERT INTO users (given_name, middle_name, surname, email, contact_number, birthday, sex, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $given_name, $middle_name, $surname, $email, $contact_number, $birthday, $sex, $address, $password);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'update' && $user_id) {
        $stmt = $conn->prepare("UPDATE users SET given_name = ?, middle_name = ?, surname = ?, email = ?, contact_number = ?, birthday = ?, sex = ?, address = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param('sssssssssi', $given_name, $middle_name, $surname, $email, $contact_number, $birthday, $sex, $address, $password, $user_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'delete' && $user_id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
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
    <title>Manage Users</title>
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
    </script>
</head>
<body>
<?php callHeader(); ?>
<section class="section__container appointment__container" id="appointment">
    <div class="appointment__header">
        <h2 class="section__header">Manage Users</h2>
        <p class="section__description">
            Create, Update, Delete User Data in the database.
        </p>
    </div>
    <div class="appointment__form__container">
        <form method="post" class="appointment__form">
            <h3>Manage Users</h3>
            <input type="hidden" name="user_crud" value="1">
            <div class="form__group">
                <label for="action">Action:</label>
                <select id="action" name="action" required onchange="toggleFields(this.value)">
                    <option value="create">Create</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="form__group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id">
            </div>
            <div class="toggleable form__group">
                <label for="given_name">Given Name:</label>
                <input type="text" id="given_name" name="given_name" required>
            </div>
            <div class="toggleable form__group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>
            <div class="toggleable form__group">
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required>
            </div>
            <div class="toggleable form__group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="toggleable form__group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required>
            </div>
            <div class="toggleable form__group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" required>
            </div>
            <div class="toggleable form__group">
                <label for="sex">Sex:</label>
                <select id="sex" name="sex" required>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="toggleable form__group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="toggleable form__group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
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
