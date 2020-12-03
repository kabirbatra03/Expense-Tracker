<?php 

  session_start();

  include'connection.php';   
   
  $errors = "";

  if(isset($_SESSION['id'])){
      
       header("location: dashboard/dashboard.php");
      
  }


  if(isset($_POST['next-step'])){
      
      $email = mysqli_real_escape_string($link, $_POST['email']);
      $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($link, $_POST['lastname']);
      $password1 = mysqli_real_escape_string($link, $_POST['password1']);
      $password2 = mysqli_real_escape_string($link, $_POST['password2']);
      
      if(empty($email)){ $errors .="<div class='alert alert-danger'>Enter email</div>";}
      if(empty($firstname)){ $errors .="<div class='alert alert-danger'>Enter first name.</div>";}
      if(empty($lastname)){ $errors .="<div class='alert alert-danger'>Enter last name.</div>";}
      if(empty($password1)){ $errors .="<div class='alert alert-danger'>Enter password.</div>";}
      if(empty($password2)){ $errors .="<div class='alert alert-danger'>Enter password twice.</div>";}
      if($password1 != $password2){ $errors .="<div class='alert alert-danger'>Entered passwords doesn't match each other.</div>";} 
         
      $email_check = "SELECT * FROM `users` WHERE `email` ='$email' LIMIT 1";
      $result = mysqli_query($link,$email_check);
      
      if (mysqli_fetch_assoc($result)){
          
          $errors .="<div class='alert alert-danger'>This email already exits.</div>";

      } else if($errors == ""){
          
          $table_name = substr($email,0,-10);
          $insert = "INSERT INTO users (firstname, lastname, email, password, budget) VALUES ('$firstname', '$lastname', '$email', '$password1', '0')";
          $result = mysqli_query($link,$insert);
          
          $id = mysqli_insert_id($link);
          $table_name = $firstname.$lastname.$id;
          
          $creating_table = "CREATE TABLE $table_name (
                            expense_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            expense VARCHAR(100) NOT NULL,
                            price VARCHAR(100) NOT NULL,
                            category VARCHAR(100) NOT NULL,
                            note TEXT NULL,
                            date DATE NOT NULL
                            )";
          
          $insert2 = "UPDATE users SET table_name = '".$table_name."' WHERE id = '".$id."'";
          mysqli_query($link,$insert2);
          
          $table_success = mysqli_query($link,$creating_table);
          
              if ($result AND $table_success){
                  
                  $_SESSION['id'] = $id;
                  header("location:signup2.php");
                     
              } else { 
                  
                  $errors .="<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link); 
              }
          
      }
  }

?>


<!doctype html>
<html lang="en">
  <head>
 
    <title>Sign Up - FORM</title>
      
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
    <style>
    #message {
      display:none;
      color: #000;
      position: relative;
      margin-top: 10px;
      border-radius: 7px;    
    }

    #message p {
      padding: 0px 35px;
      font-size: 18px;
    }

    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    .invalid {
      color: crimson;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
    }
    </style>
    
    
  <body>
     <?php include'header.php';?>
        
     <div class="container" style="width:40%!important;min-width:330px!important">
            
       <form class="signup" method="post" autocomplete="off">
          <h1>Sign Up</h1>
          <?php echo $errors; ?>
          <div class="row">
            <div class="col col-lg-6">
              <label for="first-name">Enter First Name</label>    
              <input type="text" class="form-control" placeholder="First name" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : ''; ?>">
            </div>
            <div class="col-lg-6">
              <label for="last-name">Enter Last Name</label>    
              <input type="text" class="form-control" placeholder="Last name" name="lastname" id="lastname" value="<?= isset($lastname) ? $lastname : ''; ?>">
            </div>
          </div>
        
           <label for="exampleInputEmail1">Email Address</label>
          <input type="email" class="form-control" value="<?= isset($email) ? $email : ''; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email">
           
           <label for="exampleInputPassword1">Enter Password</label>
          <input type="password" class="form-control"  name="password1" id="password1" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          
           <div class='alert alert-danger' id="message">
              <h5>Password must contain the following:</h5>
              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
              <p id="number" class="invalid">A <b>number</b></p>
              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
           
            <label for="exampleInputPassword1">Re-Enter Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password2" placeholder="Password">
           
          <button type="submit" name="next-step" class="btn btn-primary" >Next Step</button>
              
       </form>
      </div>
      <script>
        var myInput = document.getElementById("password1");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
          document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
          document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }

          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }

          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }

          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }
        </script>
      
</body>
</html>
