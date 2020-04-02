<?php include "includes/header.php";
?>
<?php
include('session.php');
?>
<?php
$month = [                  // extra feature for area chart
  1 => 'Jan',
  2 => 'Feb',
  3 => 'March',
  4 => 'April',
  5 => 'May',
  6 => 'June',
  7 => 'July',
  8 => 'Aug',
  9 => 'Sep',
  10 =>'Oct',
  11 =>'Nov',
  12 =>'Dec'
]; 
$query = "select * from transaction where due =0";                 // No of Paid
$result = mysqli_query($connection, $query);
$paid= mysqli_num_rows($result);
$query = "select * from transaction where due >0";                 // No of unpaid
$result = mysqli_query($connection, $query);
$unpaid= mysqli_num_rows($result);
$total = $paid+ $unpaid;                                           //total transactions.
$query = "select * from quotation";
$result = mysqli_query($connection, $query);
$quotation= mysqli_num_rows($result);
$query = "select * from customer";                                  //total customers.
$result = mysqli_query($connection, $query);
$customer= mysqli_num_rows($result);
$query = "select * from product where product_quantity < 4";       // Warning less Stock
$result = mysqli_query($connection, $query);
$less_Stock= mysqli_num_rows($result);
$invoice_sell = [
  1 => 0,
  2 => 0,
  3 => 0,
  4 => 0,
  5 => 0,
  6 => 0,
  7 => 0,
  8 => 0,
  9 => 0,
  10 =>0,
  11 =>0,
  12 =>0
];
$query_sells ="SELECT MONTH(date) as month, net_total from transaction where YEAR(date)=2020 ORDER BY MONTH(date) "; // getting areachart content part 1
$result = mysqli_query($connection,$query_sells);
while($row = mysqli_fetch_assoc($result)){
  $invoice_sell[$row['month']] +=$row['net_total'];
}
$quotation_sell = [
  1 => 0,
  2 => 0,
  3 => 0,
  4 => 0,
  5 => 0,
  6 => 0,
  7 => 0,
  8 => 0,
  9 => 0,
  10 =>0,
  11 =>0,
  12 =>0
]; 
$query_sells ="SELECT MONTH(date) as month, net_total from quotation where YEAR(date)=2020 ORDER BY MONTH(date) ";  // getting areachart content part 2
$result = mysqli_query($connection,$query_sells);
while($row = mysqli_fetch_assoc($result)){
  $quotation_sell[$row['month']] +=$row['net_total'];
}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Pie chart javascript Starting. -->
<script>
  google.charts.load('current', {                    // piechar script
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Paid', 'Number'],
      ['Paid Invoice', <?php echo $paid;?>],
      ['Unpaid Invoice', <?php echo $unpaid;?>],
      ['Quotation', <?php echo $quotation;?>],
    ]);
    var options = {
      title: 'Percentage of Paid, quotation given and Unpaid Invoices',
      is3D:true,  
      animation:{
        duration: 1000,
        easing: 'out',
      },
      pieHole: 0.4
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>
<!-- Pie chart javasccript Ending. -->
<!-- Area Chart javascript Starting. -->
<script>
  google.charts.load('current', {                    //areachart script
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      
      ['Month', 'Sales ₹', 'Quotation ₹'],
     <?php for($i=1;$i<=12;$i++){
        echo "['{$month[$i]}', $invoice_sell[$i], $quotation_sell[$i]],";
      }
      ?>
    ]);

    var options = {
      title: 'Company Performance',
      animation:{
        duration: 1000,
        easing: 'out',
      },
      hAxis: {
        title: 'Year 2020',
        titleTextStyle: {
          color: '#333'
        }
      },
      vAxis: {
        minValue: 0
      }
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<!-- Area Chart javascript Ending. -->
<!-- Bar chart Javascript Starting. -->
<script>
  google.charts.load('current', {                           // bar chart script
    packages: ['corechart', 'bar']
  });
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {
    var data = google.visualization.arrayToDataTable([
      ['Items', 'Quantity', ],

      <?php
      $query = "select * from product";
      $result = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($result)) { ?>
        <?php echo "['{$row['product_name']}' , {$row['product_quantity']}],"; ?>

      <?php } ?>
    ]);
    var options = {
      title: 'Quantity of all items in Inventory',
      animation:{
        duration: 1000,
        easing: 'out',
      },
      chartArea: {
        width: '50%'
      },
      hAxis: {
        title: 'Total Quantity',
        minValue: 0
      },
      vAxis: {
        title: 'Item'
      }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));

    chart.draw(data, options);
  }
</script>
<!-- bar chart javascript Ending. -->

<div id="wrapper">

  <!-- Navigation -->

  <?php include "includes/navigation.php" ?>


  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">


          <h1 class="page-header" style="font-size: 20px">Welcome <?php echo $_SESSION['login_user'];?>
                  </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-calculator fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'> Transactions <?php echo $paid."/".$unpaid;?></div>
                  <div>paid / unpaid </div>
                </div>
              </div>
            </div>
            <a href="transaction.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'>Quotation <br><?php echo $quotation; ?></div>
                  <div>&nbsp;</div>
                </div>
              </div>
            </div>
            <a href="quotation.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'>Customers<br><?php echo $customer; ?></div>
                  <div> teams/Org.</div>
                </div>
              </div>
            </div>
            <a href="customer.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'>Low Stock <br><?php echo $less_Stock;?></div>
                  <div>items</div>
                </div>
              </div>
            </div>
            <a href="product.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
      <!-- // calling Piechart -->
        <div class="col-lg-6">
          <div id="piechart" style="width: 900px; height: 520px;"></div>
        </div>
        <!-- // calling AreaChart -->
        <div class="col-lg-6">
          <div id="chart_div" style="width: 100%; height: 500px;"></div>
        </div>
      </div>
      <div class="row">
        <!-- // calling Barchart -->
        <div class="col-lg-12">
          <div id="chart_div1" style="width: 100%; height: 500px;"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/footer.php" ?>