<?php 
include("includes/config.php");
session_start();
session_destroy();
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
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" value="<?php echo isset($_POST['sign-in']) ? $email : '' ?>"/>
                            </div>
                            <span class="validator">
                                <?php echo isset($_POST['sign-in']) ? $email_error : '' ?>
                            </span>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <span class="validator">
                                <?php echo isset($_POST['sign-in']) ? $password_error : '' ?>
                            </span>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                <span class="validator">
                                    <?php echo isset($_POST['sign-in']) ? $checkbox_error : '' ?>
                                </span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="sign-in" id="signup" class="form-submit" value="Log In"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image flex-column h-100">
                        <figure><img src="images/slider-img.png" alt="sing up image"></figure>
                        <div>Don't have an account? <a href="signup.php">Sign Up</a></div>
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