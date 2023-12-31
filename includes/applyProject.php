<?php 
include_once("config.php");
include_once("classes/Users.php");
include_once("classes/Project.php");
session_start();

if (isset($_GET['project_id']) && isset($_GET['user_id'])) {
    $project_id = $_GET['project_id'];
    $user_id = $_GET['user_id'];
    if(Project::applyToProject($connection, $user_id, $project_id)){
        $_SESSION["success_message"] = "You have applied to the project!";
    }else {
        $_SESSION["danger_message"] = "Something went wrong!";
    }
}
header("Location: ../work.php");
?>