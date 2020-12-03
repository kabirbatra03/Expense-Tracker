
<?php

session_start();

include'connection.php';

if(isset($_COOKIE['id']) OR isset($_SESSION['id'])){
    
    header("location: dashboard/dashboard.php");
}

?>
<html lang="en">
  <head>
      
    <title>Expense Tracker</title>
  
  </head>
    
    <?php include'links.php'; ?>
    
  <body>
      
    <?php include'header.php'; ?>
    
    <div class="container-fluid image1 parallax">
        <div class="container tagline">
             <h1>Your Personal Finance Manager</h1>
             <h2>A new way to manage income and expenses.<br><a href="signup.php" id="join-now">JOIN NOW</a></h2>    
        </div>
    </div>
    <div class="container-fluid animation description" id="question1">
        <div class="container description">
            <h1>WHY CHOOSE US?</h1>
            <hr style="margin-right:42%;margin-left: 42%;position: relative;border:1px black solid;border-radius:15px;margin-top:-10px;margin-bottom:50px;"> <h2>Expense Tracker is complete website to track all your expenses bared by your pocket or bared by you & manage your personal finance. So that you can trace where your money goes as well as you can limit & plan accordingly.<br><a class="read-more" href="#">Read More</a> </h2>    
        </div> 
   </div> 
      
    <div class="image2 container-fluid parallax"></div>
    <div class="container-fluid info" id="question2">  
        <div class="container section">
           <div class="left intext">
               <h1>Know your<br>Spendings</h1>
               <p>Check weekly, monthly and<br> annual statistics.</p>
           </div> 
           <img class="art12" src="Images/art11.png">
           <div class="clear"></div>
        </div>    
           <div class="container section">
            <div class="right intext">
              <h1>Intuitive</h1>
              <p>View your spending tendecies<br> graphically.</p>      
            </div>
            <img class="art2" src="Images/art12.png">
            <img>
        </div>
        <div class="clear"></div>
        <div class="container section extra">
          <div class="left intext">
            <h1>Know the<br>Whole Story</h1>
            <p>Super easy to enter data<br> anytime anywhere.</p> 
          </div>
          <img class="art12" src="Images/art3.png">
          <img>    
        </div>
    </div>
    <div class="image3 parallax"></div>
   
    <?php include'footer.php'; ?>  
      
  </body>
</html>