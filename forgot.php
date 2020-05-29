<?php
include("includes/header.php");
include("includes/config.php");
include("includes/function.php");
$msg='';
$msg1='';
$msg2='';
$msg3='';
$msg4='';
$email='';
$date='';
$password='';
$cpassword='';
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$date=$_POST['dob'];
$password=$_POST['pass'];
$cpassword=$_POST['cpass'];
if(empty($email))
{
    $msg="<div class='error'>please enter your email</div>";
}
else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $msg="<div class='error'>please enter valid email</div>"; 
}
 else if(empty($date))
 {

    $msg2="<div class='error'>please enter your date of birth</div>";
 }
 else if(empty($password))
 {

    $msg3="<div class='error'>please enter your password</div>";
 }
 else if(strlen($password)<6)
 {
    $msg3="<div class='error'>password must be greater than 6 characters</div>";  
 }
 else if(empty($cpassword))
 {

    $msg4="<div class='error'>please re-enter your password</div>";
 }
 else if($password!=$cpassword)
 {
     $msg4="<div class='error'> passwords does not match</div>";
 }
else if(email_exists($email,$con))
{
    $result=mysqli_query($con,"SELECT DOB FROM users WHERE mail='$email'");
    $retrive=mysqli_fetch_array($result);
    $DOB=$retrive['DOB'];
    if($date==$DOB)
    {
        $pass=md5($password);
        mysqli_query($con,"UPDATE users SET password='$pass'");
        $msg1="<div class='success'>password changed successfully</div>"; 
    }
    else
    {
        $msg2="<div class='error'>please enter your  correct date of birth</div>";
    }
}
else
{
    $msg="<div class='error'> email not exist</div>";
}

}





?>
<title>forgot password</title>
</head>
<style type="text/css"> 

#body-bg
{
    background: url("images/Screenshot (9).png") center no-repeat fixed }
    .error
    {
        color: red;
    }
    .success
    {
        color:green;font-weight: bold;
    }
</style>
<body id="body-bg">
    <div class="container">
       <div class="login-form col-md-4 offset-md-4">
        <div class="jumbotron" style="margin-top:20px;padding-top:20px;padding-bottom:30px;">
           <h3 align="center">forgot password</h3>
           <center><?php echo $msg1; ?></center> 
            <form method="post">
            <div class="form-group">
                <label>Email : </label>
                <input type="email" class="form-control" value="<?php echo $email;?>" name="email"placeholder="enter your email">
                <?php echo $msg; ?>  
            </div>
               
                <div class="form-group">
                    <label>Date of Birth : </label>
                <input type="date" class="form-control"  value="<?php echo $date;?>" name='dob'> 
                <?php echo $msg2; ?> 
            </div>
                <div class="form-group">
                <label>New Password </label>
                <input type="password" class="form-control"   value="<?php echo $password;?>"name="pass"placeholder="enter your new password">
                <?php echo $msg3; ?>            
            </div>
                
                       <div class="form-group">
                                  <label>Re-Enter Password </label>
                <input type="password" class="form-control" value="<?php echo $cpassword;?>" name="cpass"placeholder=" re-enter your new password">
                <?php echo $msg4; ?> 
            </div>
               <center> <button class='btn btn-success' name='submit'>Submit</button></center>
                  <br>
                  <center>
                      <a href='login.php'>back</a>
                  </center>  
                    
            </form>      
           </div>
        </div>
    </div>
</body>