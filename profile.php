<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("location: user-login.php");
    }

    $user_id = $_SESSION['user_id'];
    require_once 'predefined-functions.php';
    include 'dbconn.php';

    $user_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
    $user_info = $user_result->fetch_assoc();
    
    $name = $user_info['given_name'] . " " . $user_info['surname'];
    $email = $user_info['email'];
    $contact = $user_info['contact_number'];
    $address = $user_info['address'];
    
    $pet_result = mysqli_query($conn, "SELECT * FROM pets WHERE user_id = '$user_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Profile - Paws & Whiskers Veterinary Appointment System</title>
</head>
<body>
    <?php callHeader(); ?>

    <section class="section__container profile__container" id="profile">
        <div class="profile_header">
            <h2 class="section__header">Profile</h2>
        </div>

        <div class="profile__form__container">
            <strong>Owner</strong>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Name</strong><br> <?php echo $name; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Email</strong><br> <?php echo $email; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Contact Number</strong><br> <?php echo $contact; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Address</strong><br> <?php echo $address; ?>
                    </div>
                </div>
                <!-- edit button popup edit window-->
                <button type="button" class="btn btn-success editownerbtn"> EDIT</button>
        </div>
<!-- EDIT OWNER -->
<div class="modal fade" id="editowner" tabindex="-1" aria-labelledby="editownerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editownerLabel">Edit Owner Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="contact">Contact</label>
            <input type="contact" id="contact" name="contact" class="form-control" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="address" id="address" name="address" class="form-control" placeholder="" required>
          </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="updatebtn" class="btn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--  -->
<?php
if($pet_result->num_rows > 0){ ?>
  <div class="table-data" id="pet_table">
    <div class="order">
        <div class="head">
            <h3>Pet</h3>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Weight</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody id="pet_info">
              <?php while($pet = mysqli_fetch_assoc($pet_result)): ?>
                <tr data-pet-id="<?php echo htmlspecialchars($pet['pet_id']); ?>">
                  <td><?php echo htmlspecialchars($pet['pet_name']); ?></td>
                  <td><?php echo htmlspecialchars($pet['pet_species']); ?></td>
                  <td><?php echo htmlspecialchars($pet['pet_breed']); ?></td>
                  <td><?php echo htmlspecialchars($pet['pet_bday']); ?></td>
                  <td><?php echo htmlspecialchars($pet['pet_gender']); ?></td>
                  <td><?php echo htmlspecialchars($pet['pet_weight']); ?></td>
                  <td><button type="button" class="btn btn-success editpetbtn"> EDIT</button></td>
                  <td><button type="button" class="btn btn-success deletepetbtn"> Delete</button></td>
                </tr>
              <?php endwhile; ?>
          </tbody>
        </table>
    </div>
  </div>
<?php } ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpet">Add Pet</button>

<!-- Add Modal -->
<div class="modal fade" id="addpet" tabindex="-1" aria-labelledby="addpetLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addpetLabel">Add Pet Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      
        <div class="form__group">
            <label for="pet-name">Pet Name</label>
            <input type="text" name="pet_name" placeholder="Enter your pet name" required>
        </div>

        <div class="form__group">
            <label for="pet_species">Species</label>
            <input type="text"name="pet_species" placeholder="Enter your pet species" required>
        </div>

        <div class="form__group">
            <label for="pet_breed">Breed</label>
            <input type="text" name="pet_breed" placeholder="Enter your pet breed" required>
        </div>

        <div class="form__group">
            <label for="pet_bday">Birthday</label>
            <input type="date" name="pet_bday" required min="<?php date('Y-m-d');?>">
        </div>

        <div class="form__group">
            <label for="pet_gender">Gender</label>
            <input type="text" name="pet_gender" placeholder="Enter your pet gender" required>
        </div>

        <div class="form__group">
            <label for="pet_weight">Weight</label>
            <input type="text" name="pet_weight" placeholder="Enter your pet weight" min="0" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_pet" class="btn">Add Pet</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT PET -->
<div class="modal fade" id="editpet" tabindex="-1" aria-labelledby="editpetLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editpetLabel">Edit Pet Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="pet_id" id="pet_id">
            <label for="pet_name">Pet Name</label>
            <input type="text" id="pet_name" name="pet_name" class="form-control" placeholder="Enter your pet name" required>
          </div>
          <div class="form-group">
            <label for="pet_species">Species</label>
            <input type="text" id="pet_species" name="pet_species" class="form-control" placeholder="Enter your pet species" required>
          </div>
          <div class="form-group">
            <label for="pet_breed">Breed</label>
            <input type="text" id="pet_breed" name="pet_breed" class="form-control" placeholder="Enter your pet breed" required>
          </div>
          <div class="form-group">
            <label for="pet_bday">Birthday</label>
            <input type="date" id="pet_bday" name="pet_bday" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="pet_gender">Gender</label>
            <input type="text" id="pet_gender" name="pet_gender" class="form-control" placeholder="Enter your pet gender" required>
          </div>
          <div class="form-group">
            <label for="pet_weight">Weight</label>
            <input type="text" id="pet_weight" name="pet_weight" class="form-control" placeholder="Enter your pet weight" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update_pet" class="btn" id="savechangesbtn" onclick="window.location.reload();">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

    </section>

    <?php callFooter(); ?>

<!-- bootstrap js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('.editpetbtn').on('click', function() {
            $('#editpet').modal('show');

            $tr = $(this).closest('tr');
            var petId = $tr.data('pet-id');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            $('#editpet #pet_id').val(petId);
            $('#editpet #pet_name').val(data[0]);
            $('#editpet #pet_species').val(data[1]);
            $('#editpet #pet_breed').val(data[2]);
            $('#editpet #pet_bday').val(data[3]);
            $('#editpet #pet_gender').val(data[4]);
            $('#editpet #pet_weight').val(data[5]);
        });

        // $('.deletebtn').on('click', function() {
        //   $tr = $(this).closest('tr');
        //   var petId = $tr.data('pet-id');
        //   window.location.href = 'delete_pet.php?id=' + petId;
        // });
    });

    $(document).ready(function() {
    $('.editownerbtn').on('click', function() {
        $('#editowner').modal('show');

        var name = $('.appointment__form__container .col-md-6').eq(0).text().trim();
        var email = $('.appointment__form__container .col-md-6').eq(1).text().trim();
        var contact = $('.appointment__form__container .col-md-6').eq(2).text().trim();
        var address = $('.appointment__form__container .col-md-6').eq(3).text().trim();

        console.log(name, email, contact, address);

        $('#editowner #name').val(name);
        $('#editowner #email').val(email);
        $('#editowner #contact').val(contact);
        $('#editowner #address').val(address);
    });
  });
</script>
</body>
</html>

<?php 
  if(isset($_POST['add_pet'])){
    $pet_name = sanitize($_POST['pet_name']);
    $pet_species = sanitize($_POST['pet_species']);
    $pet_breed = sanitize($_POST['pet_breed']);
    $pet_bday = sanitize($_POST['pet_bday']);
    $pet_gender = sanitize($_POST['pet_gender']);
    $pet_weight = sanitize($_POST['pet_weight']);

    $add_pet = $conn->prepare("INSERT INTO pets (user_id, pet_name, pet_species, pet_breed, pet_bday, pet_gender, pet_weight) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $add_pet->bind_param("issssss", $user_id, $pet_name, $pet_species, $pet_breed, $pet_bday, $pet_gender, $pet_weight);
    $add_pet->execute();
    $add_pet->close();
  }
  if(isset($_POST['update_pet'])){
    $pet_id = sanitize($_POST['pet_id']);
    $pet_name = sanitize($_POST['pet_name']);
    $pet_species = sanitize($_POST['pet_species']);
    $pet_breed = sanitize($_POST['pet_breed']);
    $pet_bday = sanitize($_POST['pet_bday']);
    $pet_gender = sanitize($_POST['pet_gender']);
    $pet_weight = sanitize($_POST['pet_weight']);

    $update_pet = $conn->prepare("UPDATE pets SET pet_name = ?, pet_species = ?, pet_breed = ?, pet_bday = ?, pet_gender = ?, pet_weight = ? WHERE user_id = ? AND pet_id = ?");
    $update_pet->bind_param("ssssssii", $pet_name, $pet_species, $pet_breed, $pet_bday, $pet_gender, $pet_weight, $user_id, $pet_id);      
    $update_pet->execute();
    $update_pet->close();

  }
  $conn->close();
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
  }  
?>