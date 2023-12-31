<?php
session_start();
include("classes/bd.php");
if (isset($_GET['id']) && isset($_GET['appid'])) {

    $instantCon = new Connection();
    $connection = $instantCon->conn;
    $userId = $_GET['id'];
    $applicationId = $_GET['appid'];
    if ($connection != null) {
        // logic here
        // delete Application
        $sql = "DELETE FROM applications WHERE ApplicationID = $applicationId ;";
        if (mysqli_query($connection, $sql)) {
            $_SESSION["success_message"] = "Application removed!";
            echo "session is set";
            header("location: ../myProject.php?projectid=" . $projectId);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            $_SESSION["danger_message"] = "Something went Wrong!";
            header("location: ../myProject.php?projectid=". $projectId );
        }
    } else {
        header("location: ../work.php");
    }
}
?>