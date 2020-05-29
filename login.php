<?php
include("includes/header.php");
include("includes/config.php");
include("includes/function.php");
session_start();
$msg='';$msg2='';$email='';
if(isset($_POST['submit']))
{
    $email=$_POST['mail'];
    $password=$_POST['pass'];

    if(empty($email))
    {
        $msg='<div class="error">please enter your email</div>';
    }
    else if(empty($password))
    {
        $msg2='<div class="error">please enter your password</div>';
    }
   else if (email_exists($email,$con))
   {
    $pass=mysqli_query($con,"SELECT password FROM users WHERE mail='$email'"); 
    $pass_w=mysqli_fetch_array($pass);
    $dpass=$pass_w["password"];
    $password=md5($password);
    if($password!==$dpass)
    {
     $msg2='<div class="error">password is wrong</div>';   
    }
       else
       {
           $_SESSION['mail']=$email;
            header("location:home2.html");
       }
   }
   else
   {
     $msg='<div class="error"> email doesnot exists</div>';  
   }
}

?>
<title>login form</title>
<style type="text/css">
    body{
    margin: 0;
    padding: 0;
    background: url('123.jpg');
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}
    .error
    {
        color:red;
    }
    .jumbotron
    {
        width:320px;
    height: 420px;
    background:#000;
    color:#fff;
    top:50%;
    left:50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    }
    
    .avator{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position:absolute;
    top: -50px;
    left:100px;
    }
    h1{
    margin: 0;
    padding: 40 30 30px;
    text-align: center;
    font-size: 22px;
    }
</style>
</head>
<body id='body-bg'>
    <div class="container">
    <div class="login-form colmd-4 offset-md-4">
    <div class='jumbotron' style='margin-top:50px;padding-top:20px;padding-bottom:10px;'>
        <img src="images/avator.png" class="avator">
        <h1 align='center'>Login form</h1>
        <form method="post">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="mail" class="form-control" value="<?php echo $email; ?>" />
            <?php echo $msg; ?>
            </div>
            <div class="form-group">
            <label>Password:</label>
            <input type="password" name="pass" class="form-control"/>
                <?php echo $msg2; ?>
            </div>
            <div class="form-group">
            
            <input type="checkbox" name="check" />&nbsp;keep me logged in
            </div>
            <div class="form-group">
                <center><input type='submit' name="submit" value="login" class="btn btn-success"/></center>
            </div>
            <center> <a href="forgot.php">FORGOT PASSWORD?</a></center>
        </form>
    
        </div>
        </div>
    </div>
</body>
</html>