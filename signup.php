<?php 
include("config.php");
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up - FREELANCE.CONNECT</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
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
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" value="<?php echo isset($_POST['sign-up']) ? $name : '' ?>"/>
                            </div>
                            <?php echo isset($_POST['sign-up']) && !empty($name_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $name_error
                            </div>" : ""
                            ?>
                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" value="<?php echo isset($_POST['sign-up']) ? $email : '' ?>"/>
                            </div>
                            <?php echo isset($_POST['sign-up'])  && !empty($email_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $email_error
                            </div>" : ""
                            ?>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <?php echo isset($_POST['sign-up']) && !empty($password_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $password_error
                            </div>" : ""
                            ?>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="repeat-password" id="pass" placeholder="Repeat password"/>
                            </div>
                            <?php echo isset($_POST['sign-up']) && !empty($repeat_password_error) ?
                            "<div class='alert alert-danger' role='alert'>
                                $repeat_password_error
                            </div>" : ""
                            ?>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                <?php echo isset($_POST['sign-up']) && !empty($checkbox_error) ?
                                "<div class='alert alert-danger' role='alert'>
                                    $checkbox_error
                                </div>" : ""
                                ?>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="sign-up" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image flex-column h-100">
                        <figure><img src="images/slider-img.png" alt="sing up image"></figure>
                        <div>Already have an account? <a href="signin.php">Sign In</a></div>
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