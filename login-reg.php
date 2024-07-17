<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">Login</button>

<!-- Login Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      
        <div class="form__group">
            <label for="uname">Username/Email</label>
            <input type="text" name="uname" placeholder="Enter Username or Email" required>
        </div>

        <div class="form__group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="loginbtn" class="btn">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpet">Add Pet</button>

<!-- Register Modal -->
<div class="modal fade" id="addpet" tabindex="-1" aria-labelledby="addpetLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addpetLabel">Register</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      
        <div class="form__group">
            <label for="pet-name">Given Name</label>
            <input type="text" name="pet_name" placeholder="Enter your pet name" required>
        </div>

        <div class="form__group">
            <label for="pet_species">Surname</label>
            <input type="text"name="pet_species" placeholder="Enter your pet species" required>
        </div>

        <div class="form__group">
            <label for="pet_breed">Email</label>
            <input type="text" name="pet_breed" placeholder="Enter your pet breed" required>
        </div>

        <div class="form__group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form__group">
            <label for="address">Address</label>
            <input type="text" name="address" placeholder="Enter your pet gender" required>
        </div>

        <div class="form__group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
        </div>
        <div class="form__group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="add_pet" class="btn">Add Pet</button><br>
        <div class="form__group">
            <a id="loginLink" href="user-login.php">Already have an account? Login here</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>