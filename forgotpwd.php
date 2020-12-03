<?php 

  session_start();

  include'connection.php';   
   
  $errors = "";

  if(isset($_SESSION['id'])){
      
       header("location: dashboard/dashboard.php");
      
  }
  if(isset($_POST['send'])){
    $email = mysqli_real_escape_string($link, $_POST['email']);

    $email_check = "SELECT * FROM `users` WHERE `email` ='$email'";
    $result = mysqli_query($link,$email_check);
    
    if (mysqli_fetch_assoc($result)){ 

      $otp_check = "SELECT * FROM `otp` WHERE `email` ='$email' LIMIT 1";
      $result = mysqli_query($link,$email_check);
      
      if (mysqli_fetch_assoc($result)){
          $delete_otp = "DELETE FROM otp WHERE email = '$email' LIMIT 100";
          mysqli_query($link,$delete_otp);    
      }   
  
          // Function to generate OTP 
          function generateNumericOTP($n) { 
            
            // Take a generator string which consist of 
            // all numeric digits 
            $generator = "1357902468"; 
          
            // Iterate for n-times and pick a single character 
            // from generator and append it to $result 
            
            // Login for generating a random character from generator 
            //	 ---generate a random number 
            //	 ---take modulus of same with length of generator (say i) 
            //	 ---append the character at place (i) from generator to result 
          
            $result = ""; 
          
            for ($i = 1; $i <= $n; $i++) { 
              $result .= substr($generator, (rand()%(strlen($generator))), 1); 
            } 
          
            // Return result 
            return $result; 
          } 
          
          // Main program 
          $n = 4; 
          $otp = generateNumericOTP($n); 

          $otp_query = "INSERT INTO otp (email, otp) VALUES ('$email', '$otp')";
          if(mysqli_query($link,$otp_query)){
            $_SESSION['email'] = $email;
          
            // $name = 'Expense Tracker';
            // $sender_email = 'kabirbatrakkbb@gmail.com';
            $_SESSION['subject'] = 'Login OTP';
            $_SESSION['body'] = "<p style='font-size:20px'>Your Login OTP is <span style='font-weight:bold'>".$otp."</span>.</p>";
          
            include'SendEmail/index.php';
            // $mail->addAddress($email);
            header("location: otppage.php");
            // if ($mail->send()) {
            //     header("location: otppage.php");
            // } else {
            //     $errors .="<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link); 
            // }

          } else {
            $errors .="<div class='alert alert-danger'>Not able to generate OTP at the moments - Please try again later.</div><br>".mysqli_error($link); 
          }
           
    } else {
        $errors .="<div class='alert alert-danger'>Invalid Email Address.</div><br>".mysqli_error($link); 
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
          <h1>Forgot Password?</h1>
          <div class="row">
        
           <label>Your Email Address</label>
          <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="Email">
           
          <button type="submit" name="send" class="btn btn-danger">Send</button>
              
       </form>
      </div>
      
</body>
</html>
