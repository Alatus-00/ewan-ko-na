<?php
session_start();
include 'dbconn.php'; 

$email = null;
$pass = null;
$empty_err = null;
$invalid_err = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $empty_err = "Email and password are required.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        $stmt->close();

        if ($user_id && password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
            exit();
        } else {
            $invalid_err = "Invalid email or password.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/reg-login-css.css">
</head>
<body>
<div class="registration__form__container">
    <h1 class="form__header">Log-In</h1>
    <form action="" method="post">
        <div class="form__group">
        <?php display_error($empty_err)?>
        <?php display_error($invalid_err)?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <br>
        </div>

        <div class="form__group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        </div>
        <div class="form__group">
        <button type="submit">Log-In</button>
        </div>
        <div class="form__group">
        <a id="refister-link" href="user-register.php">Don't have an account yet? Register here.</a>
        </div>
    </form>
</div>

</body>
</html>
