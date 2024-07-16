<?php
include 'dbconn.php'; 

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $given_name = htmlspecialchars(trim($_POST['given_name']));
    $middle_name = htmlspecialchars(trim($_POST['middle_name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $address = htmlspecialchars(trim($_POST['address']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($given_name) || empty($surname) || empty($email) || empty($contact_number) || empty($birthday) || empty($sex) || empty($address) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (given_name, middle_name, surname, email, contact_number, birthday, sex, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $given_name, $middle_name, $surname, $email, $contact_number, $birthday, $sex, $address, $hashed_password);

        if ($stmt->execute()) {
            header("Location: user-login.php");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/reg-login-css.css">

<body>
<div class="registration__form__container">
    <h1 class="form__header">User Registration</h1>
        <form action="user-login.php" method="POST">
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <div class="form__group">
        <label for="given_name">Given Name:</label>
        <input type="text" id="given_name" name="given_name" required>
        <br>
        </div>
        
        <div class="form__group">
        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name">
        <br>
        </div>

        <div class="form__group">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required>
        <br>
        </div>

        <div class="form__group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        </div>

        <div class="form__group">
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>
        <br>
        </div>

        <div class="form__group">
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>
        <br>
        </div>
        
        <div class="form__group">
        <label for="sex">Sex:</label>
        <select id="sex" name="sex" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="Other">Other</option>
        </select>
        <br>
        </div>

        <div class="form__group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <br>
        </div>

        <div class="form__group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        </div>

        <div class="form__group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        </div>

        <div class="form__group">
        <button type="submit">Register</button>
        </div>
        <div class="form__group">
        <a id="loginLink" href="user-login.php">Already have an account? Login here</a>
        </div>
    </form>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
    <title>User Registration</title>
</head>
<body>
    <div class="registration__form__container">
        <h1 class="form__header">User Registration</h1>
        <form action="user-registration-process.php" method="POST">
            <div class="form__group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form__group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form__group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form__group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form__group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form__group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form__group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form__group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form__group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form__group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form__group">
                <label for="zip">Zip Code</label>
                <input type="text" id="zip" name="zip" required>
            </div>
            <div class="form__group">
                <button type="submit">Register</button>
            </div>
            <div class="form__group">
                <a id="loginLink" href="user-login.php">Already have an account? Login here</a>
            </div>
        </form>
    </div>

<script></script>
</body>
</html>
 -->
