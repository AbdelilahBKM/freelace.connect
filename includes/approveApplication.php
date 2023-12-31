<?php
session_start();
include("classes/bd.php");
if (isset($_GET['userid']) && isset($_GET['appid']) && isset($_GET['projectid'])) {

    $instantCon = new Connection();
    $connection = $instantCon->conn;
    $userId = $_GET['userid'];
    $applicationId = $_GET['appid'];
    $projectId = $_GET['projectid'];
    if ($connection != null) {
        // logic here
        // create collaboration
        $sql = "INSERT INTO projectcollaborators(ProjectID, UserID)
        VALUES(?, ?);";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $userId);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            // delete Application
            $sql = "DELETE FROM applications WHERE ApplicationID = $applicationId ;";
            if (mysqli_query($connection, $sql)) {
                $_SESSION["success_message"] = "Applicant added to your Project!";
                header("location: ../myProject.php?projectid=" . $projectId);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                $_SESSION["danger_message"] = "Something went Wrong!";
                header("location: ../myProject.php?projectid=". $projectId );
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            $_SESSION["danger_message"] = "Something went Wrong!";
            header("location: ../myProject.php?projectid=". $projectId );
            exit();
        }
    }
} else {
    header("location: ../work.php");
}
