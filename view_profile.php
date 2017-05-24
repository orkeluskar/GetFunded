<?php
session_start();
  $username=mysql_real_escape_string($_SESSION['username']);
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
<?php
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

    $connection=connect();
    $userid=mysql_real_escape_string($_GET['id']);
    
    $sql="Select project_id,status,p_title from project WHERE owner_id='$userid'";

    $sql2 = "SELECT P.project_id, P.p_title,  P.`status` FROM project as P, sponsor as S WHERE S.project_id = P.project_id AND S.spon_id='$userid'";
    
    $result=$connection->query($sql);

    $result2=$connection->query($sql2)
    
    
    ?>

<script>
    
    function followuser()
    {   
        var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
    if (this.readyState ===4) {
        if(this.status===400){
        alert("Some Error Occured While Following");
    }
        if(this.status==200)
        {
            
            alert("User Followed Sucessfully");
            

            
        }
        if(this.status===404)
        {
            alert("You Already Follow this User");
            
        }
        
            
            }
  };    
        xhttp.open("POST", "social.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //var param= "username"+"="+document.getElementById("username").value+"&"+"password"+"="+document.getElementById("password").value+"&"+"FirstName"+"="+document.getElementById("fname").value+"&"+"LastName"+"="+document.getElementById("lname").value;
        var param="followerid"+"="+ <?php echo json_encode($username)?>+"&"+"followedid"+ "="+<?php echo json_encode($userid)?>;
        xhttp.send(param);
        
        } 
     
    
     
 
    
  function unfollow()
  {
        var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
    if (this.readyState ===4) {
        if(this.status===400){
        alert("Some Error Occured While UnFollowing");
    }
        if(this.status==200)
        {
            
            alert("User UnFollowed Sucessfully");
            

            
        }
     
        
            
            }
  };    
        xhttp.open("POST", "social.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //var param= "username"+"="+document.getElementById("username").value+"&"+"password"+"="+document.getElementById("password").value+"&"+"FirstName"+"="+document.getElementById("fname").value+"&"+"LastName"+"="+document.getElementById("lname").value;
        var param="followerid"+"="+ <?php echo json_encode($username)?>+"&"+"deleteuser"+ "="+<?php echo json_encode($userid)?>;
        xhttp.send(param);
        
        } 
      
      
      
      
      
      
      
  
        
        
        
        
    
    
    
</script>
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
    <div class="row">
        <div class="col-2">
            <h3>User name:    </h3> <?php echo $userid ?>  
            <button class="btn-info" onclick="followuser()">Follow</button><br><br> 
            <button class="btn-info" onclick="unfollow()">Un-follow</button><br>
        </div>

        <div class="col-8">
            <div class="row">
                <div class="col">
                    <h4>Projects added by <?php echo $userid?> :</h4>
                    <table class="table">
                        <tr>
                            <th>Project Id</th>
                            <th>Project Name</th>
                            <th>Project Status</th>
                        </tr>  
                        
                   <?php     
                    while($row=$result->fetch_assoc())
                    { ?>
                        <tr>
                            <td> <a href="view_project.php?id=<?php echo $row['project_id']?>"> <?php echo $row['project_id']?></a></td>
                        <td><?php echo $row['p_title']?></td>
                        <td><?php echo $row['status']?></td>
                        </tr>
                        
                    <?php }?>
                        
                    </table>
                    
                    
                    
                   
                </div>
            </div>
            <br><br>

            <div class="row">
                <div class="col">
                    <h4>Projects pledged by <?php echo $userid?>:</h4>
                    <table class="table">
                        <tr>
                            <th>Project Id</th>
                            <th>Project Name</th>
                            <th>Project Status</th>
                        </tr>  
                        
                   <?php     
                    while($row2=$result2->fetch_assoc())
                    { ?>
                        <tr>
                            <td> <a href="view_project.php?id=<?php echo $row2['project_id']?>"> <?php echo $row2['project_id']?></a></td>
                        <td><?php echo $row2['p_title']?></td>
                        <td><?php echo $row2['status']?></td>
                        </tr>
                        
                    <?php }?>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>