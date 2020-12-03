<?php 
session_start();

include'../connection.php';

$errors = "";
$x = 1;
$_SESSION['errors_addexpense'] = null;
    
      $expense = mysqli_real_escape_string($link, $_POST['expense']);
      $price = mysqli_real_escape_string($link, $_POST['price']);
      $date = mysqli_real_escape_string($link, $_POST['date']);
      $category = mysqli_real_escape_string($link, $_POST['category']);
      $note = mysqli_real_escape_string($link, $_POST['note']);
    
      $tn = $_SESSION['table_name'];
      $limit_check = "SELECT * FROM users WHERE id ='".$_SESSION['id']."' LIMIT 1";
      $result = mysqli_query($link,$limit_check);
      $row = mysqli_fetch_assoc($result);
      $budget = $row['budget'];
      
      if(empty($expense)){ $errors .="<div class='alert alert-danger'>Enter expense.</div>"; $x = 0;}
      if(empty($price)){ $errors .="<div class='alert alert-danger'>Enter price.</div>"; $x = 0;}
      if(empty($date)){ $errors .="<div class='alert alert-danger'>Enter date.</div>"; $x = 0;}
      if($category == "Tap here"){ $errors .="<div class='alert alert-danger'>Enter category.</div>";$x = 0;}
      if($price > $budget){ $errors .="<div class='alert alert-danger'>Entered price is greater than monthly budget limit.</div>";$x = 0;} 
    
     if($x == 1){

       $insert_expense = "INSERT INTO $tn ( expense, price, category, note, date) VALUES ('$expense', '$price', '$category', '$note', '$date')";
       if(mysqli_query($link,$insert_expense)){
          $errors ="<div class='alert alert-success'>Added Successfully.</div>";
       } else {
          $errors ="<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link);
       }
          
     } else { echo "<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link);}
    

$_SESSION['errors_addexpense'] = $errors; 
 
?>