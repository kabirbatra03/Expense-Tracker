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
      
    <title>Expense List</title>
      
  </head>
  <body> 
      
    <?php include'header2.php'; ?>

    <div class="container chart" style="padding:50px 2%;margin-top:50px">
     <div class="container">
         
     <?php if(isset($_SESSION['errors_delete'])){ echo $_SESSION['errors_delete']; $_SESSION['errors_delete'] ="";} ?>
     <h1 style="margin:0px!important">Monthly Expense</h1>
     
           
            <div style="margin-bottom:50px">
                    <form method="post" id="searchform"style="padding:0!important;border:0px;background:none;border-radius:0px;">
                        <div class="row">       
                           <div class="col col-md-3" style="">
                                <input class="form-control" name="month" id="month" type="month" placeholder="Select Date">           
                           </div>
                           <div class="col-md-2" style="">
                               <button type="submit" name="go" value="Add" class="btn btn-warning" style="margin:0px;padding:7px 0px!important;border-radius:7px!important" onMouseOver="this.style.background='#FDC10B'" onMouseOut="this.style.background='#FDC10B'" >Search!</button> 
                            </div>
                            <div class="col-md-4" style=""></div>
                            <div class="col-md-3" style="">
                                
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin:0px;padding:7px 0!important;background-color:crimson;border-radius:7px!important">Delete<i class="fas fa-trash-alt"  style="margin-left:5px;"></i></button>
                                
                                
                            </div>
                        </div>        
                    </form> 
            </div>
      
        
       <script>
            var d = new Date();
            var strDate = d.getFullYear() + "-" + (d.getMonth()+1);
            $("#month").attr("value", strDate); 
       
          
       </script>
 
        <?php include'display.php'; ?>
        
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
                          <form method="post" id="deleteform">

                            <label for="delete_id">Enter Delete ID</label>
                            <input type="text" name="delete_id" autocomplete="off" class="form-control" id="delete_id" placeholder="e.g. 10">

                             <button type="submit" name="deleteButton" id="deleteButton" class="btn btn-primary" style="margin:5px 0;background-color:crimson">Confirm Delete</button> 
    
                          </form>
                      </div>
                    </div>
                  </div>
                </div> 
      
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>  
     <script>
         
       $('#deleteform').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: $('#deleteform').serialize(),
                   
                    success: function(){
                        console.log("deleted");
                        $('form').trigger("reset");
                        window.location.reload();
                    }
                    
                    });});
         

              
      </script> 
 
</body>
</html>

