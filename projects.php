<?php
include_once("includes/config.php");
include_once("includes/classes/Users.php");
include_once("includes/classes/Project.php");
session_start();

if (isset($_SESSION["user"])) {
    $isSignIn = true;
} else {
    $isSignIn = false;
    header("location: signup.php");
}
$user = unserialize($_SESSION["user"]);
$profile = strtoupper(substr($user->getUserName(), 0, 1));
$userId = $user->getUserID($connection);
$collabProjects = Project::getCollabProjects($connection, $userId);

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Work - FREELANCE.CONNECT</title>

    <!-- bootstrap core css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/projects.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,200,0,-25" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 200,
                'GRAD' -25,
                'opsz' 20
        }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo.png" alt="" />
                        <span>
                            freelance.connect
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php"> About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="work.php">Work </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.php"> Category </a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <?php
                            if ($isSignIn) {
                                echo "<a href='logout.php'>
                        <span>
                            Logout
                        </span>
                      </a>";
                            } else {
                                echo "<a href='signup.php'>
                        <span>
                            Get started
                        </span>
                      </a>";
                            }
                            ?>
                        </div>
                    </div>
                    <div>
                        <div class="custom_menu-btn ">
                            <button>
                                <span class=" s-1">

                                </span>
                                <span class="s-2">

                                </span>
                                <span class="s-3">

                                </span>
                            </button>
                        </div>
                    </div>

                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>
    <?php
    if (isset($_SESSION["success_message"])) {
        echo "
                <div class='alert container mt-4 alert-warning alert-dismissible fade show' role='alert'>" .
            $_SESSION["success_message"] . "
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
            ";
        unset($_SESSION["success_message"]);
    }

    ?>
    <!-- MAIN -->
    <main class="container-fluid px-5 mt-5">
        <div class="row">
            <!-- sidebar -->
            <div class="col-lg-3 px-5">
                <div class="mb-4">
                    <div class="small mb-3">Search</div>
                    <div class="input-group">
                        <input placeholder="Search for..." type="text" class="form-control" />
                        <div class="input-group-append">
                            <button class="btn btn-secondary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-4 px-4">
                    <div class="small mb-3">Favorites</div>
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a href="#" class="nav-link active d-flex"><span class="material-symbols-outlined">
                                    overview_key
                                </span>&nbsp;Overview</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex"><span class="material-symbols-outlined">
                                    calendar_month
                                </span>&nbsp;Calendar</a>
                        </li>
                    </ul>
                </div>
                <div class="mb-4 px-4">
                    <div class="small mb-3">My Projects</div>
                    <ul class="nav flex-column nav-pills">
                        <?php
                        $user_id = $user->getUserID($connection);
                        $projects = Project::getUserProjects($connection, $user_id);
                        foreach ($projects as $project) {
                            $title = $project['Title'];
                            $project_id = $project['ProjectID'];
                            echo "<li class='nav-item'>
                                    <a href='myProject.php?projectid=$project_id' class='d-flex nav-link'>$title
                                    <span class='ml-auto align-self-center badge badge-secondary badge-pill'>0</span></a>
                                </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a href="create-project.php" class="nav-link"><i class="fa fa-fw fa-plus mr-2"></i>Add New Project</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end of sidebar -->

            <!-- projects -->
            <div class="col-lg-9">
                <!-- projects header -->
                <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                    <nav class="mr-auto d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active breadcrumb-item" aria-current="page">
                                <a href="projects.php"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="active breadcrumb-item" aria-current="page">
                                Projects Grid
                            </li>
                        </ol>
                    </nav>
                    <div role="toolbar" class="btn-toolbar">
                        <div role="group" class="btn-group">
                            <a href="create-project.php" id="tooltipAddNew" class="align-self-center btn btn-primary">
                                <i class="fa-fw fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end of projects header -->
                <!-- projects card -->
                <?php
                // Assuming $projects is an array of projects with their details fetched from the database
                foreach ($collabProjects as $project) {
                    $projectId = $project['ProjectID'];
                    $projectTitle = $project['Title'];
                    $status = $project['Status'];
                    $startDate = $project['StartDate'];
                    $endDate = $project['EndDate'];
                    $creator = $project['ProjectOwnerName'];

                    // Fetching collaborators for each project
                    $collaborators = Project::getCollabs($connection, $projectId);

                    // Displaying the project card
                    echo '<div class="card-columns">
        <div class="Card_custom-card--border_5wJKy card border border-primary shadow-sm">
            <div class="card-body border border-primary border-bottom-0 border-0">
                <span class="mb-2 badge badge-danger badge-pill">' . $status . '</span>
                <div class="mb-2">
                    <a href="#" class="mr-2 h3">' . $projectTitle . '</a>
                </div>
                <span>Created by: ' . $creator . '<br />' . $startDate . '</span>
            </div>
            <div class="card-footer">
                Participants:
            </div>
            <div class="card-footer d-flex">';

                    // Displaying collaborators
                    echo '<div class="avatar-image avatar-small" title="' . $user->getUserName() . '">' . strtoupper(substr($user->getUserName(), 0, 1)) . '</div>';
                    foreach ($collaborators as $collaborator) {
                        echo '<div class="avatar-image avatar-small" title="' . $collaborator . '">' . strtoupper(substr($collaborator, 0, 1)) . '</div>';
                    }

                    echo '</div>
            <div class="d-flex card-footer">
                <span class="align-self-center">' . $endDate . '</span>
                <div class="align-self-center ml-auto btn-group">
                    <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-link btn-sm">
                        <span class="material-symbols-outlined">
                            settings
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>';
                }
                ?>
                <!-- <div class="card-columns">
                    <div class="Card_custom-card--border_5wJKy card border border-primary shadow-sm">
                        <div class="card-body border border-primary border-bottom-0 border-0">
                            <span class="mb-2 badge badge-danger badge-pill">Close</span>
                            <div class="mb-2">
                                <a href="#" class="mr-2 h3">Project name here</a>
                            </div>
                            <span>Created by: admin name here <br />start date here</span>
                        </div>
                        <div class="card-footer">
                            Participants:
                        </div>
                        <div class="card-footer d-flex">
                            <div class="avatar-image avatar-small po" title="Alice">A</div>
                            <div class="avatar-image avatar-small" title="John">J</div>
                            <div class="avatar-image avatar-small" title="Bob">B</div>
                        </div>
                        <div class="d-flex card-footer">
                            <span class="align-self-center">Due date here</span>
                            <div class="align-self-center ml-auto btn-group">
                                <button type="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-link btn-sm">
                                    <span class="material-symbols-outlined">
                                        settings
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- end of projects card -->

                <!-- pagination  -->
                <!-- <div class="d-flex justify-content-center">
                    <nav class aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-fw fa-angle-left"></i></span><span class="sr-only">Previous</span></a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next"><span aria-hidden="true"><i class="fa fa-fw fa-angle-right"></i></span><span class="sr-only">Next</span></a>
                            </li>
                        </ul>
                    </nav>
                </div> -->
                <!-- end of pagination -->
            </div>
        </div>
    </main>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Activate Bootstrap dropdown
            $('.dropdown-toggle').dropdown();
        });
    </script>



</body>
</body>

</html>