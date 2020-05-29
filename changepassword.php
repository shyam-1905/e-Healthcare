<?php
include("includes/header.php");
include("includes/config.php");
include("includes/function.php");

$id=$_GET['id'];
$msg='';
$msg2='';
$msg1='';
if(isset($_POST['submit']))
{
    $password=$_POST['pass'];
    $cpassword=$_POST['cpass'];
    if(empty($password))
    {
        $msg='<div class="error">please Enter New Password</div>';
    }
    else if(strlen($password)<6)
 {
    $msg="<div class='error'>password must be greater than 6 characters</div>";  
 }
    else if(empty($cpassword))
    {
        $msg='<div class="error">please Re-Enter New Password</div>';
    }
    else if($password!=$cpassword)
 {
     $msg2="<div class='error'> passwords does not match</div>";
 }
 else
 {
    $pass=md5($password);
    mysqli_query($con,"UPDATE users SET password='$pass' WHERE id='$id'");
    $msg1="<div class='success'>Password changed successfully</div>";
 }
}

?>
<title> change password page</title>
<style type="text/css">
#body-bg
    {
        background-color:sandybrown;
    }
    .box{
        border:1px solid gray;
        padding:20px;
        border-radius:5px;
        box-shadow:3px 3px 3px gray;
        background-color:lightpink;
    
    }
    .error
    {
        color: red;
    }
    .success
    {
        color:green;font-weight: bold;
    }
</style>

</head>
<body id="body-bg">
<div class="container" style="  padding-top:30px;background-color:white;margin-top:30px;width:1200px;height:640px; " >
<a href='navbar.html'><button class='btn btn-outline-danger' style='float:right'>BACK</button></a>
<div class='col-md-4 offset-md-4'>
<div class='box'>
<h2 align='center'>Change Password</h2>
<?php echo $msg1; ?>
<form method='post'>
    <div class='form-group'>
    <label>Enter New Password</label>
        <input type='password'name='pass' class='form-control' placeholder='enter new password'>
    <?php echo $msg; ?>
    </div>
<div class='form-group'>
    <label>Re-Enter New Password</label>
        <input type='password' name='cpass' class='form-control' placeholder=' re-enter new password'>
        <?php echo $msg2; ?>
    </div>
<center><button name='submit' class='btn btn-success'>Submit</button></center>

</form>
</div>
</div>
    </div>
     </body>
</html>
