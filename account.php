<?php
include("includes/config.php");
include_once("includes/classes/Users.php");
session_start();
if (isset($_SESSION["user"])) {
    $isSignIn = true;
} else {
    $isSignIn = false;
    header("location: signup.php");
}
$user = unserialize($_SESSION["user"]);
$profile = strtoupper(substr($user->getUserName(), 0, 1));

$name_error = "";
$email_error = "";
$PhoneError = "";
$descriptionError = "";

if(isset($_POST["cancel"])){
    header("Location: work.php");
    exit();
}
if(isset($_POST["update"])){
    $newUsername = $_POST["username"];
    $newEmail = $_POST["email"];
    $newPhone = $_POST["phone"];
    $newRole = $_POST["role"];
    $newDesc = $_POST["about"];

    if($newUsername != $user->getUserName() 
    || $newEmail != $user->getEmail() 
    || $newPhone != $user->getPhoneNumber() 
    || $newRole != $user->getRole()
    || $newDesc != $user->getDescription()
    ){
        if(empty($newUsername)){
            $name_error = "please fill the name input!";
            
        }else if(empty($newEmail)){
            $email_error = "please fill the email input!";
            
        }else if($newEmail != $user->getEmail() && Users::verifyEmailExist($connection, $newEmail)){
            $email_error = "email already exist! please try another one!";

        }else if(strlen($newPhone) < 12){
            $phone_error = "please fill with your correct phone number";

        }else if(empty($newDesc)){
                $description_error = "collaborators need to know more about you!";

        }
        if(empty($name_error) && empty($email_error) && empty($phone_error) && empty($description_error)){
            $sql = "UPDATE Users 
            SET 
            Username = ?,
            Email = ?,
            PhoneNumber = ?,
            description = ?,
            Role = ?
            WHERE Email = ?;";
            $stmt = $connection->prepare($sql);
            $userEmail = $user->getEmail();
            $stmt->bind_param("ssssss", $newUsername, $newEmail, $newPhone, $newDesc, $newRole, $userEmail);
            if($stmt->execute()) {
                $user->setUserName($newUsername);
                $user->setEmail($newEmail);
                $user->setPhoneNumber($newPhone);
                $user->setRole($newRole);
                $user->setDescription($newDesc);
                $_SESSION["user"] = serialize($user);
                $_SESSION["success_message"] = "Your details has been updated successfully!";
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $stmt->error;
            }
        }
    } else {

    }
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <?php
        if (isset($_SESSION["success_message"])) {
            echo "
                <div class='alert container mt-4 alert-warning alert-dismissible fade show' role='alert'>" . 
                    $_SESSION["success_message"] . "
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
            ";
            unset($_SESSION["success_message"]); 
        }
        
    ?>
    <div class="container mt-5">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 text-center">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="profile-picture"><?php echo $profile ?></div>
                                <h5 class="user-name"><?php echo $user->getUserName() ?></h5>
                                <h6 class="user-email">
                                    <a href="" class="__cf_email__" data-cfemail="fa838f9193bab79b828d9f9696d4999597">
                                        <?php echo $user->getEmail() ?>
                                    </a>
                                </h6>
                            </div>
                            <div class="about">
                                <h5>About</h5>
                                <p>
                                    <?php echo $user->getDescription() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <form method="POST" action="" class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Username: </label>
                                    <input name="username" type="text" class="form-control" id="fullName" value="<?php echo $user->getUserName() ?>" placeholder="Enter full name"/>
                                </div>
                                <?php echo isset($_POST['update']) && !empty($name_error) ?
                                    "<div class='alert alert-danger' role='alert'>
                                        $name_error
                                    </div>" : ""
                                ?>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email :</label>
                                    <input name="email" type="email" class="form-control" id="eMail" value="<?php echo $user->getEmail() ?>" 
                                    placeholder="Enter email ID"/>
                                </div>
                                <?php echo isset($_POST['update']) && !empty($email_error) ?
                                    "<div class='alert alert-danger' role='alert'>
                                        $email_error
                                    </div>" : ""
                                ?>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $user->getPhoneNumber() ?>" placeholder="Enter phone number"/>
                                </div>
                                <?php echo isset($_POST['update']) && !empty($phone_error) ?
                                    "<div class='alert alert-danger' role='alert'>
                                        $phone_error
                                    </div>" : ""
                                ?>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">Change Role:</label>
                                    <select name="role" class="form-control form-select form-select-lg" aria-label=".form-select-lg example">
                                        <?php
                                            if($user->getRole() == 'Client'){
                                                echo "<option value='Client'>Client</option>
                                                <option value='Freelancer'>Freelancer</option>";
                                            }else {
                                                echo "<option value='Freelancer'>Freelancer</option>
                                                <option value='Client'>Client</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">About</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control" rows="6" placeholder="Tell us about yourself...">
                                        <?php echo $user->getDescription() ?>
                                    </textarea>
                                </div>
                                <?php echo isset($_POST['update']) && !empty($description_error) ?
                                    "<div class='alert alert-danger' role='alert'>
                                        $description_error
                                    </div>" : ""
                                ?>
                            </div>

                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right text-white">
                                    <input type="submit" name="cancel" value="cancel" class="btn btn-secondary" />
                                    <input type="submit" name="update" value="update" id="submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>





    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>



</body>
</body>

</html>