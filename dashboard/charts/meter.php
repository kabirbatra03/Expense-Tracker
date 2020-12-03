<?php
 $transdate = date('Y-m-d', time());
 $c_month =  substr($transdate,5,-3);
 $tn = $_SESSION['table_name'];

 $fetching_date_wise = "SELECT * FROM $tn WHERE MONTH(date) = '".$c_month."' ";

    $sum = 0;
    if($result_date_wise = mysqli_query($link,$fetching_date_wise)){
        
      
        while($expense_montly = mysqli_fetch_assoc($result_date_wise)){

            $sum =  $sum + $expense_montly['price'];
            
        } 
       
        $_SESSION['budget_meter'] = $sum;
    }
   

?>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script type="text/javascript">
    
  const dataSource = {
  chart: {
    lowerlimit: "0",
    upperlimit: "<?php echo $_SESSION['budget']; ?>",
    showvalue: "1",
    numberprefix: "$",
    theme: "fusion",
    showtooltip: "0"
  },
  colorrange: {
    color: [
      {
        minvalue: "0",
        maxvalue: "<?php echo $_SESSION['budget']/2; ?>",
        code: "#27AE60"
      },
      {
        minvalue: "<?php echo $_SESSION['budget']/2; ?>",
        maxvalue: "<?php echo $_SESSION['budget']*3/4; ?>",
        code: "#FFC533"
      },
      {
        minvalue: "<?php echo $_SESSION['budget']*3/4; ?>",
        maxvalue: "<?php echo $_SESSION['budget']; ?>",
        code: "#DC143C"
      }
    ]
  },
  dials: {
    dial: [
      {
        value: "<?php echo $_SESSION['budget_meter']; ?>"
      }
    ]
  }
};

FusionCharts.ready(function() {
  var myChart = new FusionCharts({
    type: "angulargauge",
    renderAt: "chart-container",
    width: "100%",
    height: "60%",
    dataFormat: "json",
    dataSource
  }).render();
});



</script>
<div class="chart" style="height:464px">
    
    <h1 style="margin-bottom:0px!important;background-color:#0ED31A ;font-size:250%;padding: 10px 20px;border-radius:8px;">Budget Meter</h1>
 
    <div id="chart-container"></div>
     <?php 
        if($_SESSION['budget_meter'] >= $_SESSION['budget']){

            echo"<div class='alert alert-danger'>You're very broke right now!.</div><br>";  
        } else {
            echo"<div class='alert alert-success'>Spend your money wisely!</div><br>";
        }
    ?>
</div>