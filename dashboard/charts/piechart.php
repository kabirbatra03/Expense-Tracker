<?php

$tn = $_SESSION['table_name'];

$array = array('Food & Drinks','Travel','Bills','Shopping','Health','Others');
$array_amount = array();

for($i = 0;$i <= 5;$i++){
    
   $transdate = date('Y-m-d', time());
   $c_month =  substr($transdate,5,-3);
    
   $fetching_date_wise = "SELECT * FROM $tn WHERE category = '".$array[$i]."' AND MONTH(date) ='".$c_month."' ";
   $result_date_wise = mysqli_query($link,$fetching_date_wise);
 
    $sum = 0;
    if(mysqli_query($link,$fetching_date_wise)){
       
        while($expense_montly = mysqli_fetch_assoc($result_date_wise)){

            $sum =  $sum + $expense_montly['price'];
        } 
    }
    
    $array_amount[$i] = $sum;
   
}



?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<canvas id="myChart2" width="600" height="600" style="padding:0px;"></canvas>
<script>
var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
  type: 'doughnut',
    data: {
        labels: ['Food & Drinks', 'Travel', 'Bills', 'Shopping', 'Health','Others',],
        datasets: [{
            label: '# of Votes',
            data: ["<?php echo $array_amount[0] ?>","<?php echo $array_amount[1] ?>","<?php echo $array_amount[2] ?>", "<?php echo $array_amount[3] ?>", "<?php echo $array_amount[4] ?>", "<?php echo $array_amount[5] ?>"],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        
    }
});
</script>