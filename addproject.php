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
                    <input type="text" name="usersearch" id="usersearch"" class="form-control" placeholder="Search">
                        <button  type = "submit" class="btn btn-info ">
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

<div class="container" style="display:flex; justify-content:center; width:500px; margin-top:20px; background-color:ghostwhite;">
        <form action = "project_after_upload.php" enctype="multipart/form-data" method="POST"> 
        

        <fieldset class="form-group">
            <div class="form-group">
                <legend>View previous projects? <a href="projectlist.html">Past projects</a></legend>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <input name="project_title" class="form-control" type="text" placeholder="Project Title" required/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="description">Project description: </label><br>
                <textarea rows="4" cols="50" name="description"  required>
                </textarea>
                 
            </div>
        </fieldset>


        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="category">Category: </label><br>
                <select class="form-control" name="category">
                    <option value="Tech">Tech</option>
                    <option value="Art">Art</option>
                    <option value="Music">Music</option>
                    <option value="Automotive">Automotive</option>
                    <option value="Food">Food</option>
                </select>
            </div>
        </fieldset>


        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="category">Tags: </label><br>
                <select class="form-control" name="tags">
                    <option value="jazz">Jazz</option>
                    <option value="keybaord">Keyboard</option>
                    <option value="rock">Rock</option>
                    <option value="cars">Cars</option>
                    <option value="hip-hop">Hip-hop</option>
                </select>
            </div>
        </fieldset>


        <fieldset class="form-group">
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input name="minamt" class="form-control" min=10 type="number" placeholder="minimum amount" required/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input name="maxamt" class="form-control" min=10 type="number" placeholder="maximum amount" required/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="enddate"> Pledge end date: </label>
                <input name="enddate" class="form-control" type="date" placeholder="End of pledge" required/><br>
                <label class="form-group" for="enddate"> Pledge end time: </label>

                <input name="pledgehour"  min=00 max=23 type="number" placeholder="hh" required/>

                <input name="pledgeminnute"  min=00 max=59 type="number" placeholder="mm" required/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="projcompletion"> Project completion: </label>
                <input name="projcompletion" class="form-control" type="date" placeholder="project completion" required/><br>

                <label class="form-group" for="enddate"> Project completion time: </label>
                <input name="completionhour"  min=00 max=23 type="number" placeholder="hh" required/>

                <input name="completionminnute"  min=00 max=59 type="number" placeholder="mm" required/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="projcompletion"> Project Cover image: </label>
                <input name="projectimage" id="projectimage" class="form-control" type="file"/>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <input class="btn btn-success btn-block" name="submit" class="form-control" type="submit">
                 
            </div>
        </fieldset>
                  
                   
                   


    </form>
</div>




<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
