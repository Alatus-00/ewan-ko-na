<?php
function callHeader(){
    echo '<header class="header">
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="#"><img src="assets/img/logo.png" alt="logo" />Paws & Whiskers</a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <span><i class="ri-menu-line"></i></span>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li class="link"><a href="#home">Home</a></li>
          <li class="link"><a href="#about">About</a></li>
          <li class="link"><a href="#services">Services</a></li>
          <li class="link"><a href="#vets">Our Vets</a></li>
          <li class="link"><a href="appointment.php">Appointment</a></li>
          <li class="link"><a href="profile.php">Account</a></li>
          <li class="link"><a href="?action=logout"><button class="btn">Contact Us</button></a></li>
        </ul>
      </nav>
    </header>';
}

function staffHeader(){
  echo '<header class="header">
    <nav>
    <div class="nav__header">
        <div class="nav__logo">
        <a href="#"><img src="assets/img/logo.png" alt="logo" />Paws & Whiskers</a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
        <span><i class="ri-menu-line"></i></span>
        </div>
    </div>
    <ul class="nav__links" id="nav-links">
        <li class="link"><a href="admin.php">Dashboard</a></li>
        <li class="link"><a href="manage-users.php">Users</a></li>
        <li class="link"><a href="manage-vet.php">Veterinarians</a></li>
        <li class="link"><a href="manage-appointments.php">Appointments</a></li>
        <li class="link"><a href="manage-activities.php">Activities</a></li>
        <li class="link"><a href="?action=logout"><button class="btn">Log Out</button></a></li>
    </ul>
    </nav>
</header>';
}

function callFooter(){
    echo '    <footer class=" footer">
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
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#vets">Our Vets</a>
            <a href="#account">Account</a>
          </div>
        </div>
      </div>
      <div class="footer__bar">
        © 2024 Paws & Whiskers. All rights reserved.
      </div>
    </footer>';

}

function logout(){
  session_unset();
  session_destroy();
  header("Location: homepage.php");
  exit();
}


?>
