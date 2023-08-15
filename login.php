<?php

include("connection.php");
include("functions.php");
include("session.php");

if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  die;
}


$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (!is_numeric($username)) {
    $uname_query = "SELECT * FROM user WHERE username = '$username' limit 1";
    $uname_result = mysqli_query($connection, $uname_query);
    if (mysqli_num_rows($uname_result) == 0) {
      $error_message = "No such user found";
    }
    if ($uname_result && mysqli_num_rows($uname_result) > 0) {
      $user_data = mysqli_fetch_assoc($uname_result);
      if ($user_data['password'] === $password) {
        $_SESSION['user_id'] = $user_data['user_id'];
        header("Location: dashboard.php");
        die;
      } else {
        $error_message = "Wrong password";
      }
    }
  } else {
    $error_message = "Please enter a valid username or password";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login Page</title>



  <?php include('elements/header_imports.php') ?>

</head>

<body onload=" if ('<?php echo $error_message; ?>' !== '') {  sendPopUpMessage('<?php echo $error_message; ?>') }">
  <div id="body-elements">


    <header>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">

          <!-- Navbar brand -->
          <?php include('elements/navbar_brand.php') ?>


          <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
              <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <button type="button" class="btn btn-outline-warning btn-block" onclick="window.location ='login.php' " data-mdb-ripple-color="orange">Log-in</button>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar -->
    </header>



    <main>
      <br>
      <section class="vh-100" style="background-color: #ffffff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="images/login/sidepic.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" width="75%" height="75%s" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                      <form method="post">

                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-skull-crossbones fa-2x me-3" style="color: #ff6219;"></i>

                          <span class="h1 fw-bold mb-0">Hello there</span>
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>


                        <div class="form-outline mb-4">
                          <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                          <label class="form-label" for="username">User Name</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                          <label class="form-label" for="password">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block " type="submit">Login</button>
                        </div>

                        <a class="small text-muted" href="#!">Forgot password?</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p>
                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="#!" class="small text-muted">Privacy policy</a>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <?php include('elements/footer.php')  ?>

  </div>


  <!-- PopUpMessage -->
  <div id="Popup_msg" class="popup_msg">
    <div class="popup_msg-content">

      <p id="popup_msg_Message"><?php echo $error_message; ?></p>
      <span class="popup_msg_close" onclick="close_PopUpMsg()">&times;</span>

    </div>
  </div>



  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="js/scripts.js"></script>


</body>

</html>