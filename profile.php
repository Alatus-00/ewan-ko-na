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
    
    $gname = $user_info['given_name'];
    $sname = $user_info['surname'];
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
          <div class="head">
              <h4>Owner</h4>
          </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Name</strong><br>
                        <div class="content" style="display: inline-block;">
                          <?php echo $gname . " "; ?>
                        </div>
                        <div class="content" style="display: inline-block;">
                          <?php echo $sname; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <strong>Email</strong> <div class="content"><?php echo $email; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Contact Number</strong> <div class="content"><?php echo $contact; ?></div>
                    </div>
                    <div class="col-md-6">
                        <strong>Address</strong> <div class="content"><?php echo $address; ?></div>
                    </div>
                </div>
                <!-- edit button popup edit window-->
                <button type="button" class="btn btn-success editownerbtn mb-3 mt-3">Edit</button>
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
            <label for="gname">Given Name</label>
            <input type="text" id="gname" name="gname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="sname">Surname</label>
            <input type="text" id="sname" name="sname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="contact">Contact</label>
            <input type="contact" id="contact" name="contact" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="address" id="address" name="address" class="form-control" required>
          </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update_user" class="btn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--  -->
  <div class="head">
    <h4>Pet</h4>
  </div>
<?php
if($pet_result->num_rows > 0){ ?>
  <div class="table-data" id="pet_table">
    <div class="order">
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
                  <td><?php echo htmlspecialchars($pet['pet_age']); ?></td>
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
            <label for="pet_age">Age</label>
            <input type="number" name="pet_age" required>
        </div>

        <div class="form__group">
            <label for="pet_gender">Gender</label>
            <input type="text" name="pet_gender" placeholder="Enter your pet gender" required>
        </div>

        <div class="form__group">
            <label for="pet_weight">Weight</label>
            <input type="text" name="pet_weight" placeholder="Enter your pet weight" required>
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
            <label for="pet_age">Age</label>
            <input type="number" id="pet_age" name="pet_age" class="form-control" required>
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
            $('#editpet #pet_age').val(data[3]);
            $('#editpet #pet_gender').val(data[4]);
            $('#editpet #pet_weight').val(data[5]);
        });

        $('.deletepetbtn').on('click', function() {
                var $tr = $(this).closest('tr');
                var petId = $tr.data('pet-id');
                
                if (confirm("Are you sure you want to delete this pet?")) {
                    $.ajax({
                        url: '',
                        type: 'POST',
                        data: { pet_id: petId },
                        success: function(response) {
                            if (response == 'success') {
                                $tr.remove();
                            } else {
                                alert('Failed to delete the pet. Please try again.');
                            }
                        }
                    });
                }
            });
    });

    $(document).ready(function() {
    $('.editownerbtn').on('click', function() {
        $('#editowner').modal('show');

        // Fetch owner information based on your specific HTML structure
        var gname = $('.profile__form__container').find('.content:eq(0)').text().trim();
        var sname = $('.profile__form__container').find('.content:eq(1)').text().trim();
        var email = $('.profile__form__container').find('.content:eq(2)').text().trim();
        var contact = $('.profile__form__container').find('.content:eq(3)').text().trim();
        var address = $('.profile__form__container').find('.content:eq(4)').text().trim();

        // Set values in the modal fields
        $('#editowner #gname').val(gname);
        $('#editowner #sname').val(sname);
        $('#editowner #email').val(email);
        $('#editowner #contact').val(contact);
        $('#editowner #address').val(address);
    });
});

</script>
</body>
</html>

<?php 
  if(isset($_POST['update_user'])){
    $gname = sanitize($_POST['gname']);
    $sname = sanitize($_POST['sname']);
    $email = sanitize($_POST['email']);
    $contact = sanitize($_POST['contact']);
    $address = sanitize($_POST['address']);

    $update_user = $conn->prepare("UPDATE users SET given_name = ?, surname = ?, email = ?, contact_number = ?, address = ? WHERE user_id = ?");
    $update_user->bind_param("sssssi", $gname, $sname, $email, $contact, $address, $user_id);      
    $update_user->execute();
    $update_user->close();
  }
  if(isset($_POST['add_pet'])){
    $pet_name = sanitize($_POST['pet_name']);
    $pet_species = sanitize($_POST['pet_species']);
    $pet_breed = sanitize($_POST['pet_breed']);
    $pet_age = sanitize($_POST['pet_age']);
    $pet_gender = sanitize($_POST['pet_gender']);
    $pet_weight = sanitize($_POST['pet_weight']);

    $add_pet = $conn->prepare("INSERT INTO pets (user_id, pet_name, pet_species, pet_breed, pet_age, pet_gender, pet_weight) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $add_pet->bind_param("issssss", $user_id, $pet_name, $pet_species, $pet_breed, $pet_age, $pet_gender, $pet_weight);
    $add_pet->execute();
    $add_pet->close();
  }
  if(isset($_POST['update_pet'])){
    $pet_id = sanitize($_POST['pet_id']);
    $pet_name = sanitize($_POST['pet_name']);
    $pet_species = sanitize($_POST['pet_species']);
    $pet_breed = sanitize($_POST['pet_breed']);
    $pet_age = sanitize($_POST['pet_age']);
    $pet_gender = sanitize($_POST['pet_gender']);
    $pet_weight = sanitize($_POST['pet_weight']);

    $update_pet = $conn->prepare("UPDATE pets SET pet_name = ?, pet_species = ?, pet_breed = ?, pet_age = ?, pet_gender = ?, pet_weight = ? WHERE user_id = ? AND pet_id = ?");
    $update_pet->bind_param("ssssssii", $pet_name, $pet_species, $pet_breed, $pet_age, $pet_gender, $pet_weight, $user_id, $pet_id);      
    $update_pet->execute();
    $update_pet->close();
  }
  if (isset($_POST['pet_id'])) {
    $pet_id = $_POST['pet_id'];
    $delete_pet = $conn->prepare("DELETE FROM pets WHERE pet_id = ?");
    $delete_pet->bind_param("i", $pet_id);
    $delete_pet->execute();
  }
  $conn->close();
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
  }  
?>