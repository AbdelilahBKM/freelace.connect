<?php
if(isset($_POST['submit'])){
    $name = $_POST('name');
    $email = $_POST('email');
    $password = $_POST('password');
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['passowrd'] = $password;
    header("Location:work.php");
}
?>