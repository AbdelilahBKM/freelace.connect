<?php
include("bd.php");

$instantCon = new Connection();

$connection = $instantCon->conn;
if($connection != null){
    include_once("includes/h-form.php");
}
?>