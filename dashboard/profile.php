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

     $errors="";

    if(isset($_POST['editButton'])){

       $update = "UPDATE users SET firstname = '".$_POST['edit_first']."', lastname = '".$_POST['edit_last']."', email = '".$_POST['edit_email']."', password = '".$_POST['edit_pswd']."', budget = '".$_POST['edit_budget']."' WHERE id = '".$_SESSION['id']."'";

       $update_budget = "UPDATE users SET budget = '".$_POST['edit_budget']."' WHERE id = '".$_SESSION['id']."'";

       if(mysqli_query($link,$update_budget)){
           
          $errors ="<div class='alert alert-success'>Details Updated Successfully!</div>".mysqli_error($link);
          $insert_time = "UPDATE users SET login_time = false WHERE id ='".$_SESSION['id']."'";
          mysqli_query($link,$insert_time); 

       }

       if(mysqli_query($link,$update)){
           
           $errors ="<div class='alert alert-success'>Details Updated Successfully!</div>".mysqli_error($link);
            
       } else {
           
           $errors ="<div class='alert alert-danger'>There are some errors - Please try gain later.</div>";
       }

    }

   
?>

<!doctype html>
<html lang="en">
  <head>
    <?php include'../links.php'; ?>   
      
    <title>Expense List</title>
      
  </head>
  <body> 
      
    <?php include'header2.php'; ?>

    <div class="container chart" style="padding:50px 2%;margin-top:50px">
     <div class="container">
     <?php if(isset($_POST['editButton'])){ echo $errors; $errors="";}?>    
     <h2 style="margin-bottom:0px!important;text-align:left;">Profile Settings</h2>
     
           
            <div style="margin:30px 0">
                <h4 style="margin-bottom:20px!important;text-align:left;">Basics</h4> 
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td style="text-align:right!important"><?php echo $_SESSION['firstname'];?><span> </span><?php echo $_SESSION['lastname'];?></td>
                    </tr>
                    <tr>
                      <td>Email Address</td>
                      <td style="text-align:right!important"><?php echo $_SESSION['email'];?></td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td style="text-align:right!important"><?php echo $_SESSION['password'];?></td>
                    </tr>
                  </tbody>
                 </table> 

                 <h4 style="margin-bottom:20px!important;text-align:left;">Preferences</h4>   
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Budget Limit</td>
                      <td style="text-align:right!important"><span>$</span><?php echo $_SESSION['budget'];?></td>
                    </tr>  
                  </tbody>
                 </table>  
            </div>
            <button type="button" class="btn btn-warning" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit<i class="fas fa-edit" style="margin-left:5px;"></i></button> 
               
        
      </div>
    </div>
      
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Expense</h5>
                        <button style="width:50px;padding:0px 0px;margin:5px"type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form method="post" id="editform">
                              
                            <label for="edit_first">First Name</label>
                            <input type="text" value="<?php echo $_SESSION['firstname'];?>" name="edit_first" autocomplete="off" class="form-control" id="edit_first">
                              
                            <label for="edit_last">Last Name</label>
                            <input type="text" value="<?php echo $_SESSION['lastname'];?>" name="edit_last" autocomplete="off" class="form-control" id="edit_last" >
                              
                            <label for="edit_email">Email</label>
                            <input type="text" value="<?php echo $_SESSION['email'];?>" name="edit_email" autocomplete="off" class="form-control" id="edit_email" >
                              
                            <label for="edit_pswd">Password</label>
                            <input type="text" value="<?php echo $_SESSION['password'];?>" name="edit_pswd" autocomplete="off" class="form-control" id="edit_pswd">
                              
                            <label for="edit_budget">Budget Limit</label>
                            <input type="text" value="<?php echo $_SESSION['budget'];?>" name="edit_budget" autocomplete="off" class="form-control" id="edit_budget">

                             <button type="submit" name="editButton" id="editButton" class="btn btn-primary" style="margin:5px 0;background-color:crimson">Confirm Edit</button> 
                              
                              
    
                          </form>
                      </div>
                    </div>
                  </div>
                </div> 
 
</body>
</html>


