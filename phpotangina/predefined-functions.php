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
          <li class="link"><a href="#plans">Plans</a></li>
          <li class="link"><a href="appointment.php">Appointment</a></li>
          <li class="link"><a href="#account">Account</a></li>
          <li class="link"><button class="btn">Contact Us</button></li>
        </ul>
      </nav>
      <div class="section__container header__container" id="home">
        <div class="header__image">
          <img src="assets/img/header.png" alt="header" />
        </div>
        <div class="header__content">
          <h4>Welcome to</h4>
          <h1 class="section__header">Paws & Whiskers</h1>
          <p>
            At Paws & Whiskers, we are dedicated to providing the best care for your pets. Schedule an appointment today and let us take care of your furry friends!
          </p>
          <div class="header__btn">
            <button class="btn">Book an Appointment</button>
          </div>
        </div>
      </div>
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
            <a href="#plans">Plans</a>
            <a href="#account">Account</a>
          </div>
        </div>
      </div>
      <div class="footer__bar">
        © 2024 Paws & Whiskers. All rights reserved.
      </div>
    </footer>';

}


?>