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
?>

<html lang="en">
    
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>GetFunded</title>
</head>
<?php
     $connection=connect();
     $httpStatusCode = 400;
     $httpStatusMsg  = 'Username Already taken';
     $protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

$projectid=mysql_real_escape_string($_GET['id']);

$sql="Select *,timestampdiff(DAY, pledge_start_date, pledge_end_date) as days from project  where project_id='$projectid'";
$result=$connection->query($sql);
if($result->num_rows == 0)
{
echo "Error While getting the project";
die();

}
$row=$result->fetch_assoc();


$sql1="Select count(*) as counter from sponsor where project_id='$projectid'";
$result1=$connection->query($sql1);
if($result1->num_rows == 0)
{
echo "Error While getting the project";
die();
}
$row1=$result1->fetch_assoc();

$sqlcomment="Select discuss_user_id,comment,commend_date FROM discuss WHERE discuss_project_id='$projectid'";
$resultcomment=$connection->query($sqlcomment);



?>

<script>
    
    function test()
    {   
          var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if(this.status===404){
                alert(this.responseText);
                                             }
            if(this.status===200)
            {
            
            alert(this.responseText);
            window.location.reload(true);
            

            
                    }
         
            }
  };    
        xhttp.open("POST", "sponsor.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var param= "sponsorid"+"="+ <?php echo json_encode($_SESSION['username']); ?>+"&"+"pledgevalue"+"="+document.getElementById("pledge").value+"&"+"projectid"+"="+<?php echo json_encode($projectid);?>;
        var a=<?php echo json_encode($row['max_amt']); ?>;
        var b=<?php echo json_encode($row['amt_collected']); ?>;
        console.log(a);
        console.log(b);
        console.log(parseInt(document.getElementById("pledge").value));
       
        if(parseInt(a) < parseInt(document.getElementById("pledge").value)+parseInt(b))
        {
            alert ("The pledge you have entered  makes project exceed maximum amount it can collect,Please choose a lesser value");
            return false;
            
        }
    
    xhttp.send(param);
        
        } 
        
</script>


<script>
    function like1()
    {
    <?php
    $connection1=connect();
    $username=$_SESSION['username'];
    $sql2 = "INSERT INTO `like` (like_project_id,like_user_id,like_date) VALUES ('$projectid','$username',NOW())";
    if($connection1->query($sql2) === TRUE)
    {
        $result='1';
       }
 else {
 $result='0';         
 $error=mysqli_error($connection1);
 
 
 }
    
?>    
        
        
        
        if(<?php echo json_encode($result);?> ==='1')
        {
            alert("Project followed Sucessfully");
        }
        else
        {
            alert("There was Some error while following project,Please Try Again");
            
        }
        
        
        
        }
        
 function commentadd()
 {    
      var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
    if (this.readyState ===4) {
        if(this.status===400){
        alert(this.responseText);
    }
        if(this.status==200)
        {
            
            alert("Comment added Successfully");
            window.location.reload(true);

            
        }
        
            
            }
  };    
        xhttp.open("POST", "discuss.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var param= "projectid"+"="+ <?php echo json_encode($projectid); ?>+"&"+"discussid"+"="+<?php echo json_encode($username);?>+"&"+"commenttext"+"="+document.getElementById("comment").value;
        //var param= "username"+"="+document.getElementById("username").value+"&"+"password"+"="+document.getElementById("password").value+"&"+"FirstName"+"="+document.getElementById("fname").value+"&"+"LastName"+"="+document.getElementById("lname").value;
        xhttp.send(param);
        
        } 
     
    
     
 
    
    
    
  
 </script>

<body>

<div class="container">
            <a class="brand" style="display: flex; justify-content: center; margin-top:10px;" href="#">
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
                <a class="nav-item nav-link active" href="index.html">Home</a>
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


<br>

<div class="container">


    <?php
    
    $image = "SELECT file_path FROM project_cover_image WHERE pci_project_id='$projectid'";

    $resultimage = $connection->query($image);

    $rowimage=$resultimage->fetch_assoc();

    ?>
    
    <h2 id="top">Project title </h2>
    <h3>Project description</h3><br>
    <h2><?php echo $row['p_description'];?>
    <div class="row">
        <div class="col-sm-8 mr-auto">
            <div class="row">
                
                <img class="col-12" style="height:60%;" src = "<?php echo $rowimage['file_path']; ?>" >

            </div> <!-- inner row -->
            <br>
            <br>
            
        </div> <!-- col-8 -->

        <div class="col-3 form-group">
            <h3>By User: <a href="view_profile.php?id=<?php echo $row['owner_id']?>"><?php echo $row['owner_id'] ;?> </a></h3><hr>
            <p><?php echo $row['amt_collected'] ."  "."pledged out of"."  ";?><?php echo $row['max_amt'];?></p>
            
            <p> <?php echo $row1['counter']." "."Backers for this project";?></p>
            <p> <?php echo $row['days'] ." "."days to go";?></p>
            <button class="btn-info" onclick="like1()">Like</button><br><br>
            
                
                <div class="input-group">
                    
                    <?php if($row['status']==='complete' || $row['amt_collected']===$row['max_amt']){
                        echo "Project is either complete or not taking any more pledges";
                    }
                    else{?>
                    <span class="input-group-addon">$</span>
                    <input id="pledge" name="minamt" class="form-control" value=10 min=10 type="number" placeholder="min 10$"/>
                <button class="btn btn-success" onclick="test()">Pledge?</button>
                </div>
            <?php } ?>
            
        </div><!-- col-4 -->
    </div> <!-- row -->
</div><!--container-->


    <nav class="navbar sticky-top navbar-light bg-faded navbar-toggleable-sm" style="display: flex;
    justify-content:center;">
    
            <div class="nav navbar-nav ">
                <a class="nav-item nav-link active" href="#about">About</a>
                <a class="nav-item nav-link" href="#updates">Updates</a>
            
                <a class= "nav-item nav-link" href="#cmt">Comments</a>
                <a class="nav-item nav-link" href="#faqs">FAQs</a> 
                <a class="nav-item nav-link" href="#top">Top of the page</a> 
            </div>
        
    </nav>


<div class="container" style="margin-top:10px;">
        <hr>
        <div id="about">
            <h2 >About</h2>
            <p> Full description:</p>
            <p>
               <?php echo $row['p_description']; ?>
            </p>
        </div>

        <hr>
        <div id="updates">
            
            
            <h2 >Updates</h2>
            
            <?php

            $cnt = 1;
            $sql="Select * from `update` where project_id='$projectid'";
            $result=$connection->query($sql);

            
           ?>
            
            <?php while($row=$result->fetch_assoc()){?>
 
            <p>Update <?php echo $cnt;?></p><br>
            <p>
            <?php 
                $cnt = $cnt + 1;
                if($row['data_type']==='text'){
            
             echo $row['data'];
            }
            if($row['data_type']==='video')
            {
               ?>
              <video width="500" height="300" controls>
                <source src="<?php echo $row['data']?>" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                
            <?php }?>
                
            <?php if($row['data_type']==='image'){
                ?>
                <img src="<?php echo $row['data']?>" alt="Smiley face" height="300" width="500">
                
            <?php } ?>
            
                
           <?php } ?>
            
            
             
            
            </p>

            
        </div>
        
        
   

        <hr>
        <div id="cmt" class="form-group">
            <h2 >Comments</h2> <br><br>
            <?php
            while($row=$resultcomment->fetch_assoc())
            { ?>
            <h6>><i>User <?php echo $row['discuss_user_id']?>  Commented: "<?php echo htmlspecialchars($row['comment'])?>"  on <?php echo $row['commend_date']?></i></h6><br>
              
            
            <?php 
            
            }
            ?>
            
            <form class="form-group"  >
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                    <input type="button" class="btn btn-success" name="comment" value="comment" onclick="commentadd()">
                </div>
                
            </form>
        </div>

        <hr>
        <div id="faqs">
            <h2 >FAQs</h2>
            <ol>
                <li>
                    <p> Project is gonna complete in time?</p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
                </li>

                <li></li>

                <li></li>
            </ol>
            
        </div>
</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
?>