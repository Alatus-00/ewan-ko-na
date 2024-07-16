<?php 
    session_start();
    if(isset($_POST['save'])){
        include 'dbconn.php';

        function sanitize($data) {
            global $conn;
            return mysqli_real_escape_string($conn, trim($data));
        }

        $name = sanitize($_POST['name']);
        $date = sanitize($_POST['DoA']);
        $breed = sanitize($_POST['breed']);
        $age = sanitize($_POST['age']);
        $vetname = sanitize($_POST['vet-name']);
        $sex = sanitize($_POST['sex']);
    
        $findName  = "SELECT * FROM animal_info WHERE name = '$name'";
        $foundName = mysqli_query($conn,$findName);

        if(empty($name) || empty($date) || empty($breed) || empty($age) || empty($vetname) || empty($sex)) {
            $message = "Fill out the details.";
        } else if($foundName->num_rows >= 1){
            $message = "Data already added.";
        } else {
            $insert = "INSERT INTO animal_info(animal_name, animal_date, animal_breed, animal_age, animal_vetname, animal_sex)
            VALUES('$name', '$date', '$breed', '$age', '$vetname', '$sex')";
            if (mysqli_query($conn, $insert)) {
                $message = "Data added successfully.";
            } else {
                $message = "Error: " . $insert . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
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
            <h2 class="section__header">Book an Appointment</h2>
            <p class="section__description">
                Schedule an appointment for your pet with our experienced veterinarians.
            </p>
        </div>
        <div class="appointment__form__container">
            <?php if(isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="" method="post" class="appointment__form">
                <div class="form__group">
                    <label for="pet-name">Pet's Name</label>
                    <input type="text" id="pet-name" name="name" placeholder="Enter your pet's name" required>
                </div>
                <div class="form__group">
                    <label for="DoA">Date of Appointment</label>
                    <input type="date" id="DoA" name="DoA" required>
                </div>
                <div class="form__group">
                    <label for="breed">Breed</label>
                    <input type="text" id="breed" name="breed" placeholder="Enter your pet's breed" required>
                </div>
                <div class="form__group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" placeholder="Enter your pet's age" required>
                </div>
                <div class="form__group">
                    <label for="vet-name">Vet Name</label>
                    <input type="text" id="vet-name" name="vet-name" placeholder="Enter your vet's name" required>
                </div>
                <div class="form__group">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form__group">
                    <button type="submit" name="save" class="btn">Add Animal Info</button>
                </div>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <img src="assets/img/logo.png" alt="logo" />
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

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const navLinks = document.getElementById('nav-links');

        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('nav__open');
        });
    </script>
</body>
</html>
