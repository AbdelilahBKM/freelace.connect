<?php
include_once("Users.php");
class Project
{
    private $userID;
    private $title;
    private $description;
    private $category;
    private $status;
    private $budget;
    private $collaborators;
    private $startDate;
    private $endDate;

    public function __construct($userID, $title, $description, $category, $budget, $collaborators, $startDate, $endDate)
    {
        $this->userID = $userID;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->status = "Open";
        $this->budget = $budget;
        $this->collaborators = $collaborators;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    // Method to save/update project to the database
    public static function saveToDatabase($connection, $Project)
    {
        $query = "INSERT INTO Projects (Title, Description, category, Collaborators, Budget, StartDate, EndDate, UserID) 
              VALUES ('$Project->title', 
              '$Project->description', 
              '$Project->category', 
              $Project->collaborators, 
              $Project->budget, 
              '$Project->startDate', 
              '$Project->endDate', 
              $Project->userID
              );";

        if (mysqli_query($connection, $query)) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
            return false;
        }
    }
    public static function getNumberOfOpenProjects($connection, $userId)
    {
        $query = "SELECT COUNT(*) AS OpenProjects FROM Projects WHERE Status = 'Open'AND UserID <> $userId";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['OpenProjects'];
        } else {
            return 0;
        }
    }
    
    public static function getAllOpenProjects($connection, $userId)
    {
        $query = "SELECT * FROM Projects WHERE Status = 'Open' AND UserID <> $userId;";
        $result = mysqli_query($connection, $query);

        $projects = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
        }

        return $projects;
    }
    public static function getUserProjects($connection, $userId){
        $query = "SELECT * FROM projects WHERE UserID = $userId;";
        $result = mysqli_query($connection, $query);
        $projects = [];
        if($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
        }
        return $projects;
    }
    public static function applyToProject($connection, $UserID, $ProjectID)
    {
        $sql = "INSERT INTO Applications(ProjectID, UserID)
        VALUES(?, ?);";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $ProjectID, $UserID);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            return false;
        }
    }
    public static function checkIfUserApplied($connection, $userID, $projectID)
    {
        $sql = "SELECT * FROM Applications WHERE UserID = ? AND ProjectID = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $userID, $projectID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_num_rows($result) > 0;
    }
    public static function checkIfUserApproved($connection, $userID, $projectID){
        $sql = "SELECT * FROM projectcollaborators WHERE ProjectID = ? AND UserID = ?;";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $userID, $projectID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_num_rows($result) > 0;
    }
    public static function getProjectApplicants($connection, $project_id, $user_id){
        $applicants = []; // Initialize an empty array to store results
    
        $sql = "SELECT u.UserID, u.Username, u.Email, u.PhoneNumber, a.ApplicationID, a.ApplicationDate
                FROM users u, applications a
                WHERE a.ProjectID = $project_id AND u.UserID != $user_id
                ORDER BY a.ApplicationDate;";
        $result = mysqli_query($connection, $sql);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $applicants[] = $row; 
            }
    
            // Free result set
            mysqli_free_result($result);
        } else {
            echo "Error executing the query: " . mysqli_error($connection);
        }
    
        return $applicants;
    }
    

    public function getUserID()
    {
        return $this->userID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function getCollaborators()
    {
        return $this->collaborators;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    // Setters
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    public function setCollaborators($collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
}
