<?php 
    session_start();
    include 'predefined-functions.php';
    include 'dbconn.php';
    $fetchPet = "SELECT pet_id, pet_name FROM pets WHERE user_id='1'";
    $petResult = mysqli_query($conn,$fetchPet);
    $fetchVet = "SELECT vet_id, vet_name FROM veterinarians";
    $vetResult = mysqli_query($conn,$fetchVet);
    if(isset($_POST['save'])){
        // include 'dbconn.php';

        function sanitize($data) {
            global $conn;
            return mysqli_real_escape_string($conn, trim($data));
        }

        // $name = sanitize($_POST['name']);
        // $date = sanitize($_POST['DoA']);
        // $breed = sanitize($_POST['breed']);
        // $age = sanitize($_POST['age']);
        // $vetname = sanitize($_POST['vet_name']);
        // $sex = sanitize($_POST['sex']);
    
        // $findName  = "SELECT * FROM animal_info WHERE name = '$name'";
        // $foundName = mysqli_query($conn,$findName);

        // if(empty($name) || empty($date) || empty($breed) || empty($age) || empty($vetname) || empty($sex)) {
        //     $message = "Fill out the details.";
        // } else if($foundName->num_rows >= 1){
        //     $message = "Data already added.";
        // } else {
        //     $insert = "INSERT INTO animal_info(animal_name, animal_date, animal_breed, animal_age, animal_vetname, animal_sex)
        //     VALUES('$name', '$date', '$breed', '$age', '$vetname', '$sex')";
        //     if (mysqli_query($conn, $insert)) {
        //         $message = "Data added successfully.";
        //     } else {
        //         $message = "Error: " . $insert . "<br>" . mysqli_error($conn);
        //     }
        // }
        // mysqli_close($conn);
    }
    mysqli_close($conn);
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
    <?php callHeader(); ?>

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
                    <select name="pet" id="pet">
                        <option value="">Select a pet</option>
                        <?php
                        if ($petResult->num_rows > 0) {
                            // Output data of pets
                            while($pet = $petResult->fetch_assoc()) {
                                echo "<option value='" . $pet['pet_id'] . "'>" . $pet['pet_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No pets available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form__group">
                    <label for="DoA">Date of Appointment</label>
                    <input type="date" id="DoA" name="DoA" required>
                </div>
                <div class="form__group">
                    <label for="ToA">Time of Appointment</label>
                    <input type="time" id="ToA" name="ToA" required>
                </div>
                <div class="form__group">
                    <label for="vet_name">Vet Name</label>
                    <select name="vet" id="vet">
                        <option value="">Select a Vet</option>
                        <?php
                        if ($vetResult->num_rows > 0) {
                            // Output data of vets
                            while($vets = $vetResult->fetch_assoc()) {
                                echo "<option value='" . $vets['vet_id'] . "'>" . $vets['vet_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No vets available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form__group">
                    <label for="session">Session Type</label>
                    <input type="text" id="session" name="session" placeholder="Enter session details? or select nalang based sa vet" required>
                </div>
                <div class="form__group">
                    <button type="submit" name="save" class="btn">Book Appointment</button>
                </div>
            </form>
        </div>
    </section>

    <?php callFooter(); ?>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const navLinks = document.getElementById('nav-links');

        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('nav__open');
        });
    </script>
</body>
</html>
