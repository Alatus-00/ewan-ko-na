<?php
include 'dbconn.php'; 

$given_name = null;
$surname = null;
$email = null;
$contact = null;
$address = null;
$email_err = null;
$contact_err = null;
$empty_err = null;
$pass_err = null;
$conpass_err = null;
$db_err = null;


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
        $empty_err = "All fields must be filled out.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }

    if ($password !== $confirm_password) {
        $conpass_err = "Passwords do not match.";
    }

    if ($password != "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$") {
        $pass_err = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character";
    }

    if (empty($empty_err) && empty($contact_err) && empty($email_err) && empty($pass_err) && empty($conpass_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (given_name, middle_name, surname, email, contact_number, birthday, sex, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $given_name, $middle_name, $surname, $email, $contact_number, $birthday, $sex, $address, $hashed_password);

        if ($stmt->execute()) {
            header("Location: user-login.php");
            exit();
        } else {
            $db_err = "Error: " . $stmt->error;
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://kit.fontawesome.com/e8975f4132.js" crossorigin="anonymous"></script>
<body>
<div class="registration__form__container">
    <h1 class="form__header">User Registration</h1>
    <form action="" method="POST">
            <?php display_error($empty_err)?>
        <div class="form__group">
        <label for="given_name">Given Name:</label>
        <input type="text" id="given_name" name="given_name" value="<?php echo $given_name; ?>" >
        <br>
    </div>
    
    <div class="form__group">
        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name">
        <br>
    </div>
    
    <div class="form__group">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>" >
        <br>
    </div>
    
    <div class="form__group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" >
        <?php display_error($email_err)?>
        <br>
    </div>
    
    <div class="form__group">
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $contact; ?>" >
        <?php display_error($contact_err)?>
        <br>
    </div>
    
    <div class="form__group">
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" max="<?php date('Y-m-d'); ?>" >
        <br>
    </div>
    
    <div class="form__group">
        <label for="sex">Sex:</label>
        <select id="sex" name="sex" >
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="Other">Other</option>
        </select>
        <br>
    </div>
    
    <div class="form__group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" value="<?php echo $address; ?>" ></textarea>
        <br>
    </div>
    
    <div class="form__group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
        <?php display_error($pass_err)?>
        <br>
    </div>
    
    <div class="form__group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" >
        <?php display_error($conpass_err)?>
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