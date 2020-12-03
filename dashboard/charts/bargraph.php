<?php 

$array = array();

$array_month_int = array();
   
for($i = 0;$i <= 5;$i++){
    
    $transdate = date('Y-m-d', time());
    $c_month =  substr($transdate,5,-3);    
    $c_month = $c_month - $i;
    $array_month_int[$i] = $c_month;
    
    switch ($c_month) {
      case 1:
        $month_label = "January";
        break;
      case 2:
         $month_label = "February";
        break;
      case 3:
        $month_label = "March";
        break;
      case 4:
         $month_label = "April";
        break;
      case 5:
        $month_label = "May";
        break;
      case 6:
        $month_label = "June";
        break;
      case 7:
        $month_label = "July";
        break;
      case 8:
        $month_label = "August";
        break;
      case 9:
        $month_label = "September";
        break;          
      case 10:
        $month_label = "October";
        break;
      case 11:
        $month_label = "November";
        break;
      case 12:
        $month_label = "December";
        break;
   }
    
   $array[$i] = $month_label;       
}


$tn = $_SESSION['table_name'];

$array_amount = array();

for($i = 0;$i <= 5;$i++){
    
   $fetching_date_wise = "SELECT * FROM $tn WHERE MONTH(date) = '".$array_month_int[$i]."' ";

    $sum = 0;
    if($result_date_wise = mysqli_query($link,$fetching_date_wise)){
        
      
        while($expense_montly = mysqli_fetch_assoc($result_date_wise)){

            $sum =  $sum + $expense_montly['price'];
        } 
    }
    $array_amount[$i] = $sum;
   
}






?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<canvas id="myChart" width="200" height="100"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["<?php echo $array[5] ?>","<?php echo $array[4] ?>","<?php echo $array[3] ?>", "<?php echo $array[2] ?>", "<?php echo $array[1] ?>", "<?php echo $array[0] ?>"],
        datasets: [{
            label: '# of Expense',
            data: ["<?php echo $array_amount[5] ?>","<?php echo $array_amount[4] ?>","<?php echo $array_amount[3] ?>", "<?php echo $array_amount[2] ?>", "<?php echo $array_amount[1] ?>", "<?php echo $array_amount[0] ?>"],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>