<?php  

    session_start();

    include'../connection.php';

    if(isset($_COOKIE['id'])){

        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(!empty($_SESSION['id'])){

    } else {

        header("location:../login.php");
    }
    

?>

<!doctype html>
<html lang="en">
  <head>
    <?php include'../links.php'; ?>   
      
    <title>Dashboard</title>
   
  </head>
  <body> 
    <?php include'header2.php'; ?>

    <div class="container" style="padding:50px 2%;">
       
    
          
                
        
       <div class="row">
             <div class="col col-md-6">
                <?php include'charts/meter.php';?>
            </div>
             <div class="col-md-6">
             <?php include'addexpense.php';?>    
             <button type="button" class="btn btn-primary" id="alert" data-toggle="modal" data-target="#exampleModal" hidden>
              Launch demo modal
            </button>        
           </div>
        </div>
    </div>
      
 <div class="container" style="padding:50px 2%;">
      <hr style="position: relative;border:1px black solid;border-radius:15px;margin-top:-10px;margin-bottom:50px;">   
      <div class="row">
            <div class="col-md-6" >
                 <div class="chart">
                     <h1 style="margin-bottom:20px;font-size:270%;">Recently added</h1>
                     <div style="padding:0 0 60px 0;"><?php include'recentadded.php';?></div>
                     <a href="expenselist.php"><button type="button" href="expenselist.php" class="btn btn-warning">Watch all monthly expenses</button></a>

                </div>
            </div>  
          <div class="col-md-6">
                <div class="chart">
                    <h1 style="margin-bottom:10px">Category Ratio</h1>
                    <h4 style="margin-bottom:20px">( Current Month Expenses )</h4>
                    <?php include'charts/piechart.php';  ?> 
                </div>    
          </div>
      </div>
      <div class="chart" style="margin-top:50px;">
        <h1>Past Month Expenses </h1>  
        <?php include'charts/bargraph.php';  ?>
      </div>  
     
</div>

<?php
   if($_SESSION['budget'] > $_SESSION['budget_meter']){
      $insert_time = "UPDATE users SET login_time = false WHERE id ='".$_SESSION['id']."'";
      mysqli_query($link,$insert_time);
   }
   if($_SESSION['budget_meter'] >= $_SESSION['budget']){ 
            
       if(!$_SESSION['login_time']){
          echo '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row" style="margin:0 0px 20px 5xp">
                               <div class="col col-md-5" >
                                 <img src="../Images/alert5.jpg" style="width:300px;height:300px;border-radius:5px;text-align:center;">
                               </div>
                               <div class="col-md-7">
                                 <h1 style="color:crimson">Budget limit reached.</h1>
                                 <p>You have crossed your Budget limit. Please spend your money wisely.</p>
                                 <button type="button" id="close" class="btn btn-warning" data-dismiss="modal">OK. Got it!</button>   
                               </div>
                          </div>
                      </div>

                    </div>
                  </div>
                </div>';

                $insert_time = "UPDATE users SET login_time = true WHERE id ='".$_SESSION['id']."'";
                mysqli_query($link,$insert_time);   

            $expense = $_SESSION['budget_meter'];
            $budget = $_SESSION['budget'];

            // $name = 'Expense Tracker';
            // $sender_email = 'kabirbatrakkbb@gmail.com';
            $_SESSION['subject'] = 'Budget Limit Reached';
            $_SESSION['body'] = 
            '<div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row" style="margin:0 0px 20px 5xp">
                        <div class="col-md-7">
                          <h1 style="color:crimson">Budget limit reached.</h1>
                          <p style="font-size:20px">You have crossed your <span style="font-weight:bold;color:crimson;">Budget limit.</span> Please spend your money wisely.<p>
                          <p style="font-size:20px">Budget limit : $<span style="font-weight:bold;">'.$budget.'</span> </p>
                          <p style="font-size:20px">Your total expenses this month is $<span style="font-weight:bold;">'.$expense.'</span>.</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>';
        
            // $mail->addAddress($_SESSION['email']);
            include'../SendEmail/index.php';

            // if ($mail->send()) {
            //     echo 'done';
            // } else {
            //     echo 'email failed';
            // }
              
        }
   }
?>
    <script>

    $(document).ready(function(){

      var sum = "<?php echo $_SESSION['budget_meter'] ?>";
      var budget = "<?php echo  $_SESSION['budget'] ?>";     

            if (sum >= budget) {
                $('#alert').click(); 
            }

    });   
    
    </script>



</body>
</html>