<?php 
    include("includes/classes/Users.php");
    $name_error = "";
    $email_error = "";
    $password_error = "";
    $repeat_password_error = "";
    $checkbox_error = "";
    
    
    if(isset($_POST['sign-up'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat-password'];
        
        if(empty($name)){
            $name_error = "please fill the name input!";
            
        }else if(empty($email)){
            $email_error = "please fill the email input!";
            
        }else if(empty($password)){
            $password_error = "please fill the password input!";
            
        }
        else if(Users::verifyEmailExist($connection, $email)){
            $email_error = "email already exist! please try signing in!";
        } else if(strlen($password) < 8){
            $password_error = "password input must be atleast 8 characters!";
            
        }else if(!preg_match('/[A-Z]+/', $password) || !preg_match('/[a-z]+/', $password) || !preg_match('/[0-9]+/', $password)){
            $password_error = "password must contain at least one uppercase letter, one lowercase letter and one number!";
            
        }else if($password !== $repeat_password){
            $repeat_password_error = "password doesn't match!";
        }
        if(!isset($_POST['agree-term'])){
            $checkbox_error = "you need to agree with the terms of service in order to proceed";
        }
        
        if(empty($name_error) && empty($email_error) && empty($password_error) && empty($repeat_password_error) && empty($checkbox_error)){
            
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $hashd_password = Users::hashPassword($password);
            $_SESSION['password'] = $hashd_password;
            header("Location: customize-profile.php");
            exit();
        }
        
    }
    if(isset($_POST['sign-in'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $email_error = "please fill the email input!";

        }else if(empty($password)){
            $password_error = "please fill the password input!";

        }else if(empty($_POST['agree-term'])){
            $checkbox_error = "you need to agree with the terms of service in order to proceed";

        }else{
            Users::authentificateUser($connection, $email, $password);
            $email_error = Users::$email_error;
            $password_error = Users::$password_error;
        }
        
        if(empty($email_error) && empty($password_error)){
            session_start();
            $sql = "SELECT * FROM Users where Email = '$email'";
            $result = mysqli_query($connection, $sql);
            if(!$result){
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }else {
                $row = mysqli_fetch_assoc($result);
                $userObject = new Users(
                    $row["UserName"], 
                    $row["Email"], 
                    $row["UserPassword"],
                    $row["description"],
                    $row["PhoneNumber"],
                    $row["Role"]
                );
                $_SESSION["user"] = serialize($userObject);
                header("Location: work.php");
            }
            
            exit();

        }
    }
?>