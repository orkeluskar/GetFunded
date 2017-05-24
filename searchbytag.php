<?php

session_start();
if(!(isset($_SESSION['username'])) && empty($_SESSION['username']))
{
    echo "UnAuthorised Page Usage, Please Login from Main Page to continue";
    die();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/jquery.validate.min.js"></script>
  <title>GetFunded</title>

</head>

<body>

<div class="container">
            <a class="brand" style="display: flex; justify-content: center; margin-top:10px;" href="user-wall.php">
                <img src="images/1_Primary_logo_on_transparent_377x63.png" style="height:30px;">
            </a>
</div> <!--container-->


    <nav class="navbar navbar-inverse bg-primary navbar-toggleable-sm">
    
            
            
        <button class="navbar-toggler navbar-toggler-right" type="button" 
            data-toggle="collapse" data-target="#getFundedNavMenu" aria-controls="getFundedNavMenu"
            aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="getFundedNavMenu">

            <div class="nav navbar-nav mr-auto">
                <a class="nav-item nav-link active" href="user-wall.php">Home</a>
                <a class="nav-item nav-link" href="#">Explore</a>
            </div> <!-- navbar -->  
            
            <div class="nav navbar-nav mr-2"> 
                <form method="post" action="searchprojects.php" class="nav-item form-inline">
                    <input type="text" name="usersearch" id="usersearch" class="form-control" placeholder="Search" required/>
                        <button type="submit" class="btn btn-info ">
                            <img src="images/698956-icon-111-search-128.png" style="width:16px">
                        </button>
                </form>

                <div class="dropdown">
                    <a class= "nav-item nav-link dropdown-toggle" data-toggle="dropdown" href="#">Account</a> 
                    
                    <div class="dropdown-menu-right dropdown-menu" >
                        

                            <a class="dropdown-item" href="project_stats.php">Project stats</a>
                            <a class="dropdown-item" href="searchbytag.php">Search by tag</a>
                            <a class="dropdown-item" href="list_projects.php">Project list</a>
                            <a class="dropdown-item" href="projects_pledged.php">Project pledged</a>
                            <a class="dropdown-item" href="project_complete.php">complete a project?</a>
                            <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </div> <!--dropdown-->

            </div>
        </div> <!-- collapse -->

        
    </nav>

<div class="container">

    <br>
    <h2 style="display:flex; justify-content:center;" class="text-muted">Search by tag</h2>
    <div style="display:flex; justify-content:center;">
        <form method="post" action="tagresult.php" >
        <fieldset  class="form-group">
                        <input type="text" name="usertag" id="usertag" class="form-group" placeholder="Search" required/>
                            <button type="submit" class="btn btn-info ">
                                <img src="images/698956-icon-111-search-128.png" style="width:16px">
                            </button>
        </fieldset>
        </form>
    </div>

</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>