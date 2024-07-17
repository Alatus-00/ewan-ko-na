<?php

include 'predefined-functions.php'

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <title>Paws & Whiskers Veterinary Appointment System</title>
  </head>
  <body>
<?php
callHeader()
?>
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

    <section class="section__container about__container" id="about">
      <div class="about__image">
        <img class="about__bg" src="assets/img/dot-bg.png" alt="bg" />
        <img src="assets/img/about.png" alt="about" />
      </div>
      <div class="about__content">
        <h2 class="section__header">Our Story</h2>
        <p class="section__description">
          At Paws & Whiskers, we believe in compassionate and comprehensive care for every pet. Our experienced team is committed to ensuring your pets live healthy and happy lives.
        </p>
        <div class="about__grid">
          <div class="about__card">
            <span><i class="ri-heart-line"></i></span>
            <div>
              <h4>Compassionate Care</h4>
              <p>
                We treat every pet as if they were our own, providing loving and attentive care.
              </p>
            </div>
          </div>
          <div class="about__card">
            <span><i class="ri-shield-check-line"></i></span>
            <div>
              <h4>Fully Certified</h4>
              <p>
                Our clinic is fully certified, ensuring the highest standards of veterinary care.
              </p>
            </div>
          </div>
          <div class="about__card">
            <span><i class="ri-user-heart-line"></i></span>
            <div>
              <h4>Experienced Vets</h4>
              <p>
                Our team of experienced veterinarians is dedicated to providing the best care for your pets.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container class__container" id="services">
      <h2 class="section__header">Our Services</h2>
      <p class="section__description">
        We offer a wide range of veterinary services to meet the needs of your pets, including routine check-ups, emergency care, and specialized treatments.
      </p>
      <div class="class__grid">
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/service-1.jpg" alt="service" />
          <div class="class__content">
            <h4>Routine Check-ups</h4>
            <p>Regular health assessments for your pets.</p>
          </div>
        </div>
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/service-2.jpg" alt="service" />
          <div class="class__content">
            <h4>Emergency Care</h4>
            <p>Immediate care for urgent health issues.</p>
          </div>
        </div>
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/service-3.jpg" alt="service" />
          <div class="class__content">
            <h4>Surgical Procedures</h4>
            <p>Expert surgical care for various conditions.</p>
          </div>
        </div>
        <div class="class__card">
          <img src="assets/img/dot-bg.png" alt="bg" class="class__bg" />
          <img src="assets/img/service-4.jpg" alt="service" />
          <div class="class__content">
            <h4>Dental Care</h4>
            <p>Comprehensive dental services for pets.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container trainer__container" id="vets">
      <h2 class="section__header">Our Veterinarians</h2>
      <p class="section__description">
        Meet our team of dedicated and experienced veterinarians, committed to providing the highest level of care for your pets.
      </p>
      <div class="trainer__grid">
        <div class="trainer__card">
          <img src="assets/img/vet-1.jpg" alt="vet" />
        </div>
        <div class="trainer__card">
          <div class="trainer__content">
            <h4>Dr. Sarah Johnson</h4>
            <h5>Chief Veterinarian</h5>
            <hr />
            <p>
              With over 15 years of experience, Dr. Johnson specializes in small animal care and surgery.
            </p>
            <div class="trainer__socials">
              <a href="#"><i class="ri-facebook-fill"></i></a>
              <a href="#"><i class="ri-google-fill"></i></a>
              <a href="#"><i class="ri-instagram-line"></i></a>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer__card">
          <img src="assets/img/vet-2.jpg" alt="vet" />
        </div>
        <div class="trainer__card">
          <div class="trainer__content">
            <h4>Dr. Mark Lee</h4>
            <h5>Emergency Care Specialist</h5>
            <hr />
            <p>
              Dr. Lee is known for his expertise in emergency and critical care, ensuring your pets are in safe hands.
            </p>
            <div class="trainer__socials">
              <a href="#"><i class="ri-facebook-fill"></i></a>
              <a href="#"><i class="ri-google-fill"></i></a>
              <a href="#"><i class="ri-instagram-line"></i></a>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer__card">
          <img src="assets/img/vet-3.jpg" alt="vet" />
        </div>
        <div class="trainer__card">
          <div class="trainer__content">
            <h4>Dr. Emily Davis</h4>
            <h5>Dental Care Specialist</h5>
            <hr />
            <p>
              Dr. Davis focuses on dental health, ensuring your pets maintain healthy teeth and gums.
            </p>
            <div class="trainer__socials">
              <a href="#"><i class="ri-facebook-fill"></i></a>
              <a href="#"><i class="ri-google-fill"></i></a>
              <a href="#"><i class="ri-instagram-line"></i></a>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </div>
          </div>
        </div>
        <div class="trainer__card">
          <img src="assets/img/vet-4.jpg" alt="vet" />
        </div>
        <div class="trainer__card">
          <div class="trainer__content">
            <h4>Dr. James Smith</h4>
            <h5>General Practitioner</h5>
            <hr />
            <p>
              Dr. Smith provides comprehensive care for a wide range of pet health needs.
            </p>
            <div class="trainer__socials">
              <a href="#"><i class="ri-facebook-fill"></i></a>
              <a href="#"><i class="ri-google-fill"></i></a>
              <a href="#"><i class="ri-instagram-line"></i></a>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php
    
    callFooter()
    
    ?>

    <script>
      const menuBtn = document.getElementById('menu-btn');
      const navLinks = document.getElementById('nav-links');

      menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('nav__open');
      });
    </script>
  </body>
</html>
