<?php
include_once("includes/config.php");
include("includes/classes/Project.php");
session_start();

if (isset($_SESSION["user"])) {
    $isSignIn = true;
} else {
    $isSignIn = false;
    header("location: signup.php");
}
$user = unserialize($_SESSION["user"]);
$profile = strtoupper(substr($user->getUserName(), 0, 1));
if (isset($_POST["add-project"])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $collaborators = $_POST['collaborators'];
    $budget = $_POST['budget'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];   
    $ownerID = $user->getUserId($connection); 

    $Project = new Project($ownerID, $title, $description, $category, $budget, $collaborators, $startDate, $endDate);
    if($Project::saveToDatabase($connection, $Project)){
        $_SESSION["success_message"] = "project created successfuly!";
        header("Location: projects.php");
        exit();
    }
}

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
                        <li class="nav-item">
                            <a href="#" class="d-flex nav-link">Analytics Redesign
                                <span class="ml-auto align-self-center badge badge-secondary badge-pill">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="d-flex nav-link">New Website
                                <span class="ml-auto align-self-center badge badge-secondary badge-pill">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="d-flex nav-link">Chart for Newsletter
                                <span class="ml-auto align-self-center badge badge-secondary badge-pill">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-fw fa-plus mr-2"></i>Add New Project</a>
                        </li>
                    </ul>
                </div>
                <div class="mb-4 px-4">
                    
                </div>
            </div>
            <!-- end of sidebar -->

            <div class="col-lg-9">
                <div class="container mt-5 py-3">
                    <h2>Add New Project</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="1">Web Developement</option>
                                <option value="2">UI/UX Design</option>
                                <option value="3">Game Design</option>
                                <option value="4">SEO Marketing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="collaborators">Number of Collaborators</label>
                            <input type="number" class="form-control" id="collaborators" name="collaborators" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="budget">Budget</label>
                            <input type="number" class="form-control" id="budget" name="budget" min="0.01" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" name="add-project" value="create" class="btn btn-primary px-4 py-2" />
                        </div>
                    </form>
                </div>
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