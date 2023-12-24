<?php
include("includes/classes/Users.php");
session_start();

if (isset($_SESSION["user"])) {
  $isSignIn = true;
} else {
  $isSignIn = false;
  header("location: signup.php");
}
$user = unserialize($_SESSION["user"]);
$profile = strtoupper(substr($user->getUserName(), 0, 1));
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Work - FREELANCE.CONNECT</title>

  <!-- bootstrap core css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/work.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
  <style>
    .material-symbols-outlined {
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="" />
            <span>
              freelance.connect
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="work.php">Work </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="category.php"> Category </a>
              </li>
            </ul>
            <div class="user_option">
              <?php
              if ($isSignIn) {
                echo "<a href='logout.php'>
                        <span>
                            Logout
                        </span>
                      </a>";
              } else {
                echo "<a href='signup.php'>
                        <span>
                            Get started
                        </span>
                      </a>";
              }
              ?>
            </div>
          </div>
          <div>
            <div class="custom_menu-btn ">
              <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
  <!-- MAIN -->
  <main class="container-fluid mt-4">
    <div class="row">
      <!-- profile wall -->
      <div class="col-md-2">
        <section class="border p-3">
          <div class="text-center">
            <div class="profile-picture"><?php echo $profile ?></div>
            <div class="mt-2"><?php echo "Hello " . $user->getUserName(). "!" ?></div>
            <button type="button" class="btn btn-info btn-sm mt-2">
              <a href="account.php">
              <div class="d-flex align-items-center text-white">
                  <span class="material-symbols-outlined">Edit</span>Edit Profile
                </div>
              </a>
            </button>
          </div>
          <hr>
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
              username: <br>
              <?php echo $user->getUserName() ?>
            </a>
            <a href="#" class="list-group-item list-group-item-action ">
              Email: <br>
              <?php echo $user->getEmail() ?>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              Phone: <br>
              <?php echo $user->getPhoneNumber() ?>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
            Role: <br>
            <?php echo $user->getRole() ?>
            </a>
          </div>
        </section>
      </div>
      <!-- end of profile wall -->

      <!-- freelance section -->
      <div class="col-md-8">

        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="career-search mb-60">
                <!-- Career Filter form -->
                <form action="" class="career-form mb-60">
                  <div class="row">
                    <div class="col-md-6 col-lg-3 my-3">
                      <div class="input-group position-relative">
                        <input type="text" class="form-control" placeholder="Enter Your Keywords" id="keywords" />
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                      <div class="select-container">
                        <select class="custom-select">
                          <option selected>Location</option>
                          <option value="1">Marrakesh</option>
                          <option value="2">Fes</option>
                          <option value="3">Jupiter</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                      <div class="select-container">
                        <select class="custom-select">
                          <option selected>Select Job Type</option>
                          <option value="1">Ui designer</option>
                          <option value="2">JS developer</option>
                          <option value="3">Web developer</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                      <input type="submit" value="Search" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit" />
                    </div>
                  </div>
                </form>
                <!-- End career Filter form -->

                <!-- Cards -->
                <div class="filter-result container">
                  <p class="mb-30 ff-montserrat">Total Project Openings : 89</p>
                  <!-- Project card -->
                  <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                    <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                      <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                        A
                      </div>
                      <div class="job-content">
                        <h5 class="text-center text-md-left">
                          Front End Developer
                        </h5>
                        <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                          <li class="mr-md-4 d-flex align-items-center justify-content-between">
                            <span class="material-symbols-outlined">
                              person
                            </span>&nbsp;by Abdelilah
                          </li>
                          <li class="mr-md-4 d-flex align-items-center justify-content-between">
                            <span class="material-symbols-outlined">
                              attach_money
                            </span>&nbsp;25/h
                          </li>
                          <li class="mr-md-4 d-flex align-items-center justify-content-between">
                            <span class="material-symbols-outlined">
                              calendar_month
                            </span>&nbsp;from 14-01-2024 to 14-02-2024
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="job-right my-4 flex-shrink-0">
                      <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light">Apply now</a>
                    </div>
                  </div>
                  <!-- End of project card -->
                </div>
              </div>
              <!-- End of Cards -->

              <!-- Pagination -->
              <!-- <nav aria-label="Page navigation">
          <ul class="pagination pagination-reset justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                <i class="zmdi zmdi-long-arrow-left"></i>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item d-none d-md-inline-block">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item d-none d-md-inline-block">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">8</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="zmdi zmdi-long-arrow-right"></i>
              </a>
            </li>
          </ul>
        </nav> -->
              <!-- end of Pagination -->
            </div>
          </div>
        </div>

        <!-- end freelance section -->

      </div>
    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>





  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>



</body>
</body>

</html>