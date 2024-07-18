<?php 
    // session_start();
    include 'predefined-functions.php';
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
    <?php callHeader(); ?>
    
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
            
            <?php callFooter(); ?>
        </body>
</html>

<?php mysqli_close($conn); ?>