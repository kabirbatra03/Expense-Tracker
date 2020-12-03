<?php 

 
    $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['table_name'] = $row['table_name'];
    $_SESSION['budget'] = $row['budget'];
    $_SESSION['login_time'] = $row['login_time'];



?>
<link href="../home.css" type="text/css" rel="stylesheet">
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container">    
      <a class="navbar-brand" href="dashboard.php">Expen<span style="color:limegreen;font-weight: bold;font-family:'Montserrat', sans-serif;">$</span>e Tracker</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" id="menu-btn" >
       <span class="navbar-toggler-icon"></span>
      </button>   

      <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">Support</a>
            </li> 
            <li>
                <div class="btn-group">
                  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <?php  echo $_SESSION['firstname'] ?>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <div class="dropdown-divider"></div>  
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </div>    
            </li>        
         </ul>
      </div>
    </div>
</nav>

<style>  
        .container form h1{
           background-color:  #0ED31A;
           margin-bottom: 50px;
           font-size:250%;
           padding: 10px 20px;
            border-radius:8px;
        }
        .container form input{
          border-radius:10px;
          width: 100%;
          padding: 10px 20px;
          margin-bottom: 10px;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }
        .chart{
        position: relative;
        background: white;
        border: 1px solid #888;
        border-radius: 15px;
        padding: 40px;   
        }
        .chart h1{
           text-align: center;
           margin-bottom: 50px;
           font-size:50px;
        }
        .chart h4{
           text-align: center;
           
           font-size:20px;
        }
    
</style>










