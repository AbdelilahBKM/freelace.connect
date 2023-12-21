<?php
    session_start();
    include("includes/config.php");
    if(isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        $phone_error = "";
        $role_error = "";
        $description_error = "";
        if(isset($_POST['finish'])){
            $phone = $_POST['tel'];
            $role = $_POST['role'];
            $description = $_POST['description'];
            if(strlen($phone) < 12){
                $phone_error = "please fill with your correct phone number";
            }else if($role == "nothing"){
                $role_error = "please select your role!";
            }else if(empty($description)){
                $description_error = "collaborators need to know more about you!";
            }
            if(empty($phone_error) && empty($role_error) && empty($description_error))
            {
                $user = new Users($name, $email, $password, $description,$phone, $role);
                if(Users::addUser($connection, $user, 'work.php')){
                    session_unset();
                    $_SESSION['user'] = serialize($user);
                    header("location: work.php");
                }
            }
        }

    }else {
        header("location: signup.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In - FREELANCE.CONNECT</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .form-header{
            font-size: 18px;
            width: 100%;
            text-align: start;
            margin: 10px 0;
        }
        .form-choice{
            font-size:  16px;
        }
        .validator {
            color: #FA8072;
            padding: 0 2px;
        }
    </style>
</head>
<body class="main">

    <div>

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <div class="form-header">
                            <h3 class="">Hello <?php echo $name ?>!</h3>
                            <p class="form-choice">we need more information about you</p>
                        </div>
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="tel"><i class="zmdi zmdi-phone"></i></label>
                                <input type="tel" name="tel" id="tel" placeholder="Your phone number" 
                                value="<?php echo isset($_POST['finish']) ? $phone : "+212" ?>"/>
                            </div>
                            <?php echo isset($_POST['finish']) && !empty($phone_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $phone_error
                            </div>" : ""
                            ?>
                            <select name="role" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="nothing" selected>Whate are you looking to do here?</option>
                                <option value="Client">Client</option>
                                <option value="Freelancer">Freelancer</option>
                            </select> 
                            <?php echo isset($_POST['finish']) && !empty($role_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $role_error
                            </div>" : ""
                            ?>
                            <div class="form-group">
                                <div>tell us more about yourself:</div>
                                <textarea class="form-control" name="description" id="description" rows="6" >
                                    <?php echo isset($_POST['finish']) ? $description : "" ?>
                                </textarea>
                            </div>
                            <?php echo isset($_POST['finish']) && !empty($description_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $description_error
                            </div>" : ""
                            ?>
                            <div class="form-group form-button" style="width: 22rem; font-size: 1.2rem;">
                                <input type="submit" name="finish" id="finish" class="form-submit" value="finish up"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image flex-column h-100">
                        <figure><img src="images/slider-img.png" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
