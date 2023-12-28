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
        $query = "SELECT * FROM Projects WHERE Status = 'Open' AND UserID <> $userId";
        $result = mysqli_query($connection, $query);

        $projects = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
        }

        return $projects;
    }
    public static function applyToProject($connection, $UserID, $Project)
    {
        $ProjectID = $Project['ProjectID'];
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


    public static function displayProjectCard($connection, $project, $userId)
    {
        $title = $project['Title'];
        $userID = $project['UserID'];
        $budget = $project['Budget'];
        $startDate = $project['StartDate'];
        $endDate = $project['EndDate'];
        $userName = Users::getUserNameById($connection, $userID);
        $profile = strtoupper(substr($userName, 0, 1));
        $formattedStartDate = date('M d, Y', strtotime($startDate));
        $formattedEndDate = date('M d, Y', strtotime($endDate));

        if (isset($_POST["apply-now"])) {
            if (Project::applyToProject($connection, $userId, $project)) {
                $_SESSION["success_message"] = "You have applied to the project!";
                header("Location: " . $_SERVER['PHP_SELF']);
            } else {
                $_SESSION["danger_message"] = "Something went wrong!";
            }
        }
        if(Project::checkIfUserApplied($connection, $userId, $project)){
            
        }

        $html = "<div class='job-box d-md-flex align-items-center justify-content-between mb-30'>
        <div class='job-left my-4 d-md-flex align-items-center flex-wrap'>
            <div class='img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex'>
                $profile
            </div>
            <h5 class='text-center text-md-left'>$title</h5>
            <div class='job-content ml-3'>
                <ul class='d-md-flex flex-wrap text-capitalize ff-open-sans'>
                    <li class='mr-md-4 d-flex align-items-center justify-content-between'>
                        <span class='material-symbols-outlined'>person</span>&nbsp;by $userName
                    </li>
                    <li class='mr-md-4 d-flex align-items-center justify-content-between'>
                        <span class='material-symbols-outlined'>attach_money</span>&nbsp;$budget
                    </li>
                    <li class='mr-md-4 d-flex align-items-center justify-content-between'>
                        <span class='material-symbols-outlined'>calendar_month</span>&nbsp;$formattedStartDate to $formattedEndDate
                    </li>
                </ul>
            </div>
        </div>
        <form method='POST' class='job-right my-4 flex-shrink-0'>
            <input type='submit' name='apply-now' value='apply now' class='btn d-block w-100 d-sm-inline-block btn-light' />
        </form>
    </div>";

        echo $html;
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
