<?php
        
  echo'<table class="table" id="myTable" >
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Delete ID</th>
                  <th scope="col">Expense</th>
                  <th scope="col">Category</th>  
                  <th scope="col" style="text-align:right!important">Price($)</th>   
                </tr>
              </thead>
              <tbody>';  

      

            if(isset($_POST['month'])){

                $month = substr($_POST['month'],5);
                $year = substr($_POST['month'],0,5);   

                echo mysqli_error($link);

                $tn = $_SESSION['table_name'];
                $fetching_date_wise = "SELECT * FROM $tn WHERE MONTH(date) = '$month' and YEAR(date) = '$year'";
                if($result_date_wise = mysqli_query($link,$fetching_date_wise)){

                    while($expense_montly = mysqli_fetch_assoc($result_date_wise)){

                         echo'<tr>
                                  <th scope="col">'.$expense_montly['date'].'</th>
                                  <td scope="col">'.$expense_montly['expense_id'].'</td> 
                                  <td scope="col">'.$expense_montly['expense'].'</br>'.$expense_montly['note'].'</td>
                                  <td scope="col">'.$expense_montly['category'].'</td> 
                                  <td scope="col" style="text-align:right!important">'.$expense_montly['price'].'</td>   
                                </tr>';
                   }
               }

            }
      
           
//           else {
//            
//            $transdate = date('Y-m-d', time());
//            $month = substr($transdate,5,-3);
//            $year = substr($transdate,0,4);
//
//            echo mysqli_error($link);
//
//            $tn = $_SESSION['table_name'];
//            $fetching_date_wise = "SELECT * FROM $tn WHERE MONTH(date) = '$month' and YEAR(date) = '$year'";
//            $result_date_wise = mysqli_query($link,$fetching_date_wise);
//
//                while($expense_montly = mysqli_fetch_assoc($result_date_wise)){
//
//                     echo'<tr>
//                              <th scope="col">'.$expense_montly['date'].'</th>
//                              <td scope="col">'.$expense_montly['expense_id'].'</td> 
//                              <td scope="col">'.$expense_montly['expense'].'</br>'.$expense_montly['note'].'</td>
//                              <td scope="col">'.$expense_montly['category'].'</td> 
//                              <td scope="col" style="text-align:right!important">'.$expense_montly['price'].'</td>   
//                            </tr>';
//                }
//        }

          echo'</tbody></table>'; 



?>    




