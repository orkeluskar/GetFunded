<?php
session_start();
if(!isset($_SESSION['username']))
{
    Echo "Unauthorised Page Usage Please Relogin to Access All the Page features;";
    header('location:login.html');
    
    
}


function connect()
{
    
     $servername = "localhost";
     $usernam = "root";
     $password = "";
     $dbname = "project";
     $connection = new mysqli($servername,$usernam,$password,$dbname);
     //Check if the connection is established
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

return $connection;
    
    
    
    
}

$ownerid=$_SESSION['username'];
$connection1=connect();

$sql="select L.project_id,M.aver,L.p_title from (select project_id,p_title from project where owner_id='$ownerid')L join (Select r_project_id,avg(rating) as aver from rating group by r_project_id)M where M.r_project_id=L.project_id";
$result=$connection1->query($sql);

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
                <form class="nav-item form-inline">
                    <input name="usersearch" id="usersearch" class="form-control" placeholder="Search">
                        <button class="btn btn-info ">
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
    <h2 style="display:flex; justify-content:center;" class="text-muted">Project statistics</h2>

    <table class="table table-hover">
        <tr class="text-danger">
            <th>Project id</th>
            <th>Project name</th>
            <th>status</th>
            <th>Rating</th>
        </tr>
<?php while($row=$result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['project_id']?></td> <!--project id-->
            <td><?php echo $row['p_title']?></td> <!--project name-->
            <td><?php echo $row['aver']?></td>
        </tr>
<?php } ?>
       

    </table>

</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>