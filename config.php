<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "freelancedb";

$con = mysqli_connect($servername, $db_username, $db_password, $db_name);
if($con->connect_error){
    die("Connection failed: " . $conn->connect_error);

}else {
    include_once("includes/h-form.php");
    
}
?>