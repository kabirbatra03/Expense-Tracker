<?php

session_start();

include'connection.php';

$errors = "";
    
if(isset($_SESSION['id'])){
    
    if(isset($_POST['next'])){
        
        $value = $_POST['budget'];
        $id = $_SESSION['id'];
    
        
        $query = "UPDATE users SET budget = '$value' WHERE id = '$id' LIMIT 1";
        
        if(mysqli_query($link,$query)){
            
            header("location: dashboard/dashboard.php");
            
        } else {
            
            $errors ="<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link); 
        }
        
    } 

} else {
    
    header("location: signup.php");
    
}

?>


<!doctype html>
<html lang="en">
  <head>
      
    <title>Sign Up - FORM</title>
  
  </head>
    
     <?php include'links.php'; ?>
    
  <body>

     <?php include'header.php'; ?>
      
     <div class="container" style="width:40%!important;min-width:330px!important">
       <form method="post">
          <h1 style="font-size:250%!important;">Set Monthly Budget</h1>
          <?php echo $errors; ?> 
          <div class="form-group">
            <div style="font-size:200%;text-align:center;" id="rangeValue"><span style="color:limegreen;font-weight: bold;font-family:'Montserrat', sans-serif;">$</span>450</div>
            <input type="range" class="form-control-range" name="budget" value="450" min="0" max="1000" onmousemove="rangeSlider(this.value)" onChange="rangeSlider(this.value)">
          </div>  
           
          <script>
              function rangeSlider(value){
                  document.getElementById('rangeValue').innerHTML = '<span style="color:limegreen;font-weight: bold;font-family:Montserrat, sans-serif;">$</span>' + value;  
              }
           </script>   
          <button type="submit" name="next" class="btn btn-primary" >Next</button>
          <button type="submit" href="#" class="btn btn-danger" >Back</button>     
       </form >
   </div>
      
</body>
</html>