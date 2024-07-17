<?php 
    // session_start();
    // include 'dbconn.php';

    // if(isset($_POST['logout'])){
    //     session_unset();
    //     session_destroy();
    //     header("Location: login.php");
    //     exit();
    // }

    // $result = mysqli_query($conn, "SELECT * FROM animal_info");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Appointment - Paws & Whiskers Veterinary Appointment System</title>
</head>
<body>
    <header class="header">
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="index.php"><img src="assets/img/logo.png" alt="logo">Paws & Whiskers</a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <span><i class="ri-menu-line"></i></span>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li class="link"><a href="index.php#home">Home</a></li>
                <li class="link"><a href="index.php#about">About</a></li>
                <li class="link"><a href="index.php#services">Services</a></li>
                <li class="link"><a href="index.php#vets">Our Vets</a></li>
                <li class="link"><a href="index.php#plans">Plans</a></li>
                <li class="link"><a href="appointment.php">Appointment</a></li>
                <li class="link"><a href="index.php#account">Account</a></li>
                <li class="link"><button class="btn">Contact Us</button></li>
            </ul>
        </nav>
    </header>

    <section class="section__container appointment__container" id="appointment">
        <div class="appointment__header">
            <h2 class="section__header">Animal Information</h2>
            <p class="section__description">
                Below is the information about the animals in our database.
            </p>
        </div>
        <div class="general__form__container">
            <?php if(isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Pet's Name</th>
                        <th>Date of Appointment</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Vet Name</th>
                        <th>Sex</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['animal_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['animal_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['animal_breed']); ?></td>
                            <td><?php echo htmlspecialchars($row['animal_age']); ?></td>
                            <td><?php echo htmlspecialchars($row['animal_vetname']); ?></td>
                            <td><?php echo htmlspecialchars($row['animal_sex']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <img src="assets/logo.png" alt="logo" />
                    <h2>Paws & Whiskers</h2>
                </div>
                <p class="section__description">
                    Dedicated to providing compassionate and comprehensive care for your pets.
                </p>
                <div class="footer__socials">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-google-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                </div>
            </div>
            <div class="footer__col">
                <div class="footer__links">
                    <a href="index.php#home">Home</a>
                    <a href="index.php#about">About</a>
                    <a href="index.php#services">Services</a>
                    <a href="index.php#vets">Our Vets</a>
                    <a href="index.php#plans">Plans</a>
                    <a href="index.php#account">Account</a>
                </div>
            </div>
        </div>
        <div class="footer__bar">
            © 2024 Paws & Whiskers. All rights reserved.
        </div>
    </footer>

    <script></script>
</body>
</html>

<?php mysqli_close($conn); ?>
