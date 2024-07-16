<!DOCTYPE html>
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
