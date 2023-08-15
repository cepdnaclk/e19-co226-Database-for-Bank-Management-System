<?php
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Welcome</title>

  <?php include('elements/header_imports.php') ?>


</head>

<body>

  <!--Main Navigation-->
  <header>
    <style>
      #intro {
        background-image: url("images/welcome_bg.jpg");
        height: 100vh;

      }

      /* Height for devices larger than 576px */


      .navbar .nav-link {
        color: #fff !important;
      }

      .feature-card img {
        height: 200px;
        object-fit: cover;
      }

      .about-section {
        margin-top: 50px;
        margin-bottom: 50px;
      }

      .about-section img {
        width: 100%;
        height: auto;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark  fixed-top">
      <div class="container-fluid">

        <!-- Navbar brand -->
        <?php $navbar_brand = 'white';
        include('elements/navbar_brand.php') ?>


        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars " style="color: #ffffff"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">

            </li>
            <li class="nav-item">
              <a class="nav-link" href="#features">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->


    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
          <div class="text-white">
            <h1 class="mb-3 display-1">WELCOME</h1>
            <h5 class="mb-4 ">Treasure Island Banking Service</h5>
            <?php
            if (!isset($_SESSION['user_id'])) {
              echo '<button type="button" class="btn btn-warning btn-rounded btn-block " onclick="window.location =\'login.php\' " data-mdb-ripple-color="orange"><font style="color: black;" >Log-in</font> </button>';
            } else {
              echo '<button type="button" class="btn btn-warning btn-rounded btn-block " onclick="window.location =\'dashboard.php\' " data-mdb-ripple-color="orange"><font style="color: black;" >Dashboard</font> </button>';
            };
            ?>

          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->


  <!-- Features Section -->
  <section id="features" class="container py-5">
    <h2 class="text-center mb-5">Features</h2>
    <div class="row">
      <!-- feature 1 -->
      <div class="col-md-4 mb-4">
        <div class="card feature-card">
          <img src="images/index/transfer.jpeg" class="card-img-top" alt="feature">
          <div class="card-body">
            <h5 class="card-title">Money Transferring</h5>
            <p class="card-text">Transfer money to any account with few clicks!</p>
          </div>
        </div>
      </div>
      <!-- feature 2 -->
      <div class="col-md-4 mb-4">
        <div class="card feature-card">
          <img src="images/index/tr_his.png" class="card-img-top" alt="feature">
          <div class="card-body">
            <h5 class="card-title">Transaction History</h5>
            <p class="card-text">View the transaction history of all of your accounts in one place!</p>
          </div>
        </div>
      </div>
      <!-- feature 3 -->
      <div class="col-md-4 mb-4">
        <div class="card feature-card">
          <img src="images/index/view_info.jpg" class="card-img-top" alt="feature">
          <div class="card-body">
            <h5 class="card-title">View Data</h5>
            <p class="card-text">View your information on accounts, loans, user details.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>About</h2>
          <p>Welcome to Treasure Island Banking Service, where we turn financial management into a pirate's treasure hunt. Treasure Island Banking Service combines modern technology with the thrill of a treasure hunt. We provide a full suite of financial tools designed to make banking efficient, secure, and even exciting. Our system facilitates straightforward account management, secure transactions, and effective loan management.</p>
          <p>Our treasure map navigates through the vast ocean of financial management with ease and confidence. Our treasure? A banking service that not only meets but surpasses your expectations.</p>
          <p>Embark on this adventure with us. Welcome aboard, matey!</p>
        </div>
        <div class="col-md-6">
          <img src="images/index/about.png" alt="About">
        </div>
      </div>
    </div>
  </section>

  <?php include('elements/footer.php') ?>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="js/scripts.js"></script>
</body>

</html>