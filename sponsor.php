<?php
session_start();
if(!isset($_SESSION['username']))
{
    echo "Unauthorised Page Usage Please Relogin to Access All the Page features;";
    header('location:login.html');
    
    
}

$sponsor=mysql_real_escape_string($_POST['sponsorid']);
$projectid=mysql_real_escape_string($_POST['projectid']);
$pledge=mysql_real_escape_string($_POST['pledgevalue']);


$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "project";
$httpStatusCode = 400;
$httpStatusMsg  = 'Incorrect Username or Password';
$protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

$connection=new mysqli($servername,$usernam,$password,$dbname);
if (!$connection) {
    die("Connection failed: " . $connection->connect_error);
} 

$sql="INSERT INTO sponsor(spon_id,project_id,spon_amt,spon_date_time) VALUES ('$sponsor','$projectid','$pledge',NOW())";
$sql2="UPDATE project Set amt_collected=amt_collected+$pledge where project_id='$projectid'";
if(!$connection->query($sql2))
{
    echo mysqli_error($connection);
    
}
if ($connection->query($sql) === TRUE) {
        $Success=200;
        $httpStatusMsg="Working";
        header($protocol.' '.$Success.' '.$httpStatusMsg);
        
        
 } 

    else {
    

    $Success=404;
    $httpStatusMsg="Not working";
    header($protocol.' '.$Success.' '.$httpStatusMsg);
    }

    







?>
