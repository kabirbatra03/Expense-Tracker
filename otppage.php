<?php 

  session_start();

  include'connection.php';   
   
  $email = $_SESSION['email'];

  $errors = "";

  if(isset($_SESSION['id'])){
      
       header("location: dashboard/dashboard.php");
      
  }
  
  if(isset($_POST['enter'])){

    $entered_otp = mysqli_real_escape_string($link, $_POST['otp']);

    $query = "SELECT * FROM otp WHERE email = '$email'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    
    if($row['otp'] === $entered_otp){

      $query = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($link,$query);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $row['id'];

      header("location: dashboard/dashboard.php");

    } else {
        $errors .="<div class='alert alert-danger'>Incorrect Password.</div>";

    }
    
  }

?>


<!doctype html>
<html lang="en">
  <head>
 
    <title>Forgot Password</title>
      
    <style>
        body{
             background: #007bff;
             background: linear-gradient(to right, #0062E6, #33AEFF);
        }
        
        .container form h1{
           text-align: center;
           margin-bottom: 50px;
           font-size:50px;
        }
        .container form button{
           width: 100%;
           border-radius:50px;
           border: 1px solid #ccc;
           margin-top:10px;
           padding: 10px 10px;

        }
        .container form button:hover{
            background-color: black;
            color:white;
            border: 1px solid dodgerblue;  
        }


        .container form label{
           padding-left: 10px;
        }    

        .container form input{
          border-radius:50px;
          width: 100%;
          padding: 20px 20px;
          margin-bottom: 10px;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }


    </style>   
  
  </head>
    
     <?php include'links.php'; ?>
    
  <body>
     <?php include'header.php';?>
        
     <div class="container" style="width:40%!important;min-width:330px!important">
            
       <form class="signup" method="post" autocomplete="off">
          <?php echo $errors; ?>
          <h1>Enter OTP</h1> 
          <h3>Please check your entered email to get OTP.</h3>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="otp" placeholder="e.g. 1234">
           
          <button type="submit" name="enter" class="btn btn-danger">Enter</button>
              
       </form>
      </div>
      
</body>
</html>
