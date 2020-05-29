<?php
include("includes/header.php");
include("includes/config.php");
include("includes/function.php");
session_start();
if(logged_in())
{
    header("location:login.php");
}
$email=$_SESSION['mail'];

$result=mysqli_query($con,"SELECT id,firstname,lastname,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
$firstname=$retrive['firstname'];
$lastname=$retrive['lastname'];
$image=$retrive['img'];
//print_r($retrive);
?>

<title> profile page</title>
<style type="text/css">
#body-bg
    {
        background-color:sandybrown;
    }
</style>

</head>
<body id="body-bg">
<div class="container" style="  padding-top:20px;background-color:white;margin-top:20px;width:1200px;height:640px; " >
<h2><center>welcome<?php echo ucfirst($firstname)." ".ucfirst($lastname) ?></center></h2>
    <a href='logout.php'><button class="btn btn-outline-success" style="float:right;">logout</button><br></a>
    <center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail' style='width:350px;'></center>
    </div>
     </body>
</html>
