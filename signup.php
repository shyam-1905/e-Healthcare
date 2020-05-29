<?php
include("includes/header.php");
include("includes/config.php");
include("includes/function.php");
$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname='';
$lastname='';
$email='';
$date='';
$password='';
$c_password='';
$image='';
if(isset($_POST['submit']))
{
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$email=$_POST['email'];
$date=$_POST['dob'];
$password=$_POST['password'];
$c_password=$_POST['cpass'];
$image=$_FILES['image']['name'];
$tmp_image=$_FILES['image']['tmp_name'];
$size_image=$_FILES['image']['size'];
$checkbox=isset($_POST['cbox']);
//echo $firstname."</br>".$lastname."</br>".$email."</br>".$date."</br>".$passwors."</br>". $c_password."</br>".$image."</br>". $checkbox;    
    
if(strlen($firstname)<3)
{
    $msg="<div class='error'>first name should contain 3 characters</div>";  
}
elseif(strlen($lastname)<3)
{
    $msg2="<div class='error'>last name should contain 3 characters</div>";  
}
else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
 $msg3="<div class='error'>enter valid email</div>";      
}
else if(email_exists($email,$con))
{
  $msg3="<div class='error'> email already exists</div>";  
}
else if(empty($date))
{
 $msg4="<div class='error'> please enter your date of birth</div>";  
}
else if(empty($password)) 
{
   $msg5="<div class='error'> please enter password </div>"; 
}
else if(strlen($password)<6)
{
  $msg5="<div class='error'>password must contain 6 elements</div>";   
}
    else if($password!==$c_password)
{
  $msg6="<div class='error'>password donot match</div>";   
}
else if($image=="")
{
 $msg7="<div class='error'>please upload image</div>"; 
}
else if($size_image>=10000000)
{
$msg7="<div class='error'>please upload image less than 1 MB</div>";
}
else if($checkbox=='')
{  $msg8="<div class='error'>please accept terms and conditions</div>"; 
}
else
{
$password=md5($password);
$img_ext=explode('.',$image);
$image_ext=$img_ext[1];
$image=rand(1,1000).rand(1,1000).time().".".$image_ext;   
if($image_ext=='jpg'|| $image_ext=='png' || $image_ext=='JPG')
{
  move_uploaded_file($tmp_image,"images/$image");
 mysqli_query($con,"INSERT INTO users(firstname,lastname,mail,DOB,password,img) 
VALUES('$firstname','$lastname','$email','$date','$password','$image')");
$msg9="<div class='success'><center>You are successfully registerd</center></div>";
    $firstname='';
$lastname='';
$email='';
$date='';
$password='';
$c_password='';
$image='';
}
else
{
$msg7="<div class='error'>please upload  correct image file</div>";        
}
}
}
?>
<title>sign up form</title>
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
        <div class="jumbotron" style="margin-top:20px;padding-top:20px;">
           <h3 align="center">sign up form</h3>
             <?php echo $msg9; ?>
            <form method="post" enctype="multipart/form-data">
            
                <div class="form-group">
                     <label> First name:</label>
                    <input type="text" name="fname" placeholder="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <?php echo $msg; ?>
                </div>
                <div class="form-group">
                     <label> Last name:</label>
                    <input type="text" name="lname" placeholder="last name" class="form-control" value="<?php echo $lastname; ?>">
                    <?php echo $msg2; ?>
                </div>
                <div class="form-group">
                     <label> Email:</label>
                    <input type="email" name="email" placeholder="enter your email" class="form-control" value="<?php echo $email; ?>">
                    <?php echo $msg3; ?>
                </div>
                <div class="form-group">
                     <label> Date of birth:</label>
                    <input type="date" name="dob" placeholder="enter your DOB" class="form-control" value="<?php echo $date; ?>">
                    <?php echo $msg4; ?>
                </div>
                <div class="form-group">
                     <label> Password:</label>
                    <input type="password" name="password" placeholder="password" class="form-control" value="<?php echo $password; ?>">
                    <?php echo $msg5; ?>
                </div>
                <div class="form-group">
                     <label> Re enter password:</label>
                    <input type="password" name="cpass" placeholder="re-enter password" class="form-control" value="<?php echo $c_password; ?>">
                    <?php echo $msg6; ?>
                </div>
                <div class="form-group">
                     <label> Profile image:</label><br>
                    <input type="file" name="image" value="<?php echo $image; ?>" />
                    <?php echo $msg7; ?>
                </div><br>
                 <div class="form-group">
            
                    <input type="checkbox" name="cbox" />I will agree all terms and conditions
                    <?php echo $msg8; ?>
                </div><br>
                    <center><input type="submit" value="submit" name='submit' class='btn btn-success'></center>
                <a href="login.php">already registered</a>
            </form>
                    
                    
                    
                    
           </div>
        </div>
    </div>
</body>