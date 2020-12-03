<?php
session_start();

include'connection.php';

$errors = "";

if(isset($_COOKIE['id']) OR isset($_SESSION['id'])){
    
    header("location: dashboard/dashboard.php");
}


if(isset($_POST['submit'])){
  
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    
    if(empty($email)){ $errors .="<div class='alert alert-danger'>Enter email</div>"; }
    if(empty($password)){ $errors .="<div class='alert alert-danger'>Enter password.</div>"; }
    
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link,$check_email);
    if($row = mysqli_fetch_assoc($result)){

        if($errors == "" && $row['id']){

            if($password == $row['password']){

                $_SESSION['id'] = $row['id'];

                header("location: dashboard/dashboard.php");

            } else { 
                $errors .="<div class='alert alert-danger'>Incorrect Password.</div>";
                echo mysqli_error($link); 

            }

          } 
        
       } else {  $errors .="<div class='alert alert-danger'>You haven't signed up yet!</div>";}

    } 

?>
<!doctype html>
<html lang="en">
  <head>
 
    <title>Login</title>
  
  </head>
    
     <?php include'links.php'; ?>
    
  <body>
     <?php include'header.php';?>
        
     <div class="container" style="width:35%!important;min-width:350px!important">
            
      <form class="login" method="post" autocomplete="off">
          <h1>Login</h1> 
          <?php echo $errors; ?>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">

          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <div class="row">
            <div class="col"><a href="signup.php" class="psw" >Create account </a></div>
            <div class="col"><a href="forgotpwd.php" class="psw" > Login with OTP</a></div>  
         </div>
      </form>
                 
      </div>
      
</body>
</html>
