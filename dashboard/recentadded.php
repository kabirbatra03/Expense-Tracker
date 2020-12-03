<?php 

  echo'<div style="height:390px">
         <table class="table" id="myTable" style="border:1px #99A3A4 solid;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Expense</th>
              <th scope="col">($)</th>   
            </tr>
          </thead>
          <tbody>';

        $tn = $_SESSION['table_name'];  
        $query = "SELECT expense,date,price,note FROM $tn ORDER BY date DESC";

        $fake_display = true;
        $count_rows = 0;

        if($result3 = mysqli_query($link,$query)){

                while($item = mysqli_fetch_assoc($result3)) {
                     
                    $fake_display = false;
             //       echo $count_rows;
                    if($count_rows < 8){
                     echo'<tr>
                              <th scope="col">'.$item['date'].'</th>
                              <td scope="col">'.$item['expense'].'</br>'.$item['note'].'</td>
                              <td scope="col">'.$item['price'].'</td>   
                            </tr>';
                        
                    }
                    ++$count_rows;
                    
                } 
            
                
               if($fake_display){
                   
                    for($f = 1;$f <= 15;$f++){
                        echo'<tr>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>   
                            </tr>'; 
                    }     
               }
        } 
   
    echo'</tbody></table></div>'; 

?>


 



