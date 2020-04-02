<?php
include('../admin/session.php');
?>
<div class="row no-gutters">
<div class="col-lg-7 text-center">
  <h3><i>All Cusomters</i></h3>
</div>
<div class="col-lg-4 justify-content-end">
  <div class="md-form active-cyan active-cyan-2 mb-3">
    <form method="GET" action="">
      <input class="form-control" type="text" placeholder="Search by customer Name | ID | team" name="find" aria-label="Search">
  </div>
</div>
<div class="col-1">
  <div class="md-form active-cyan active-cyan-2 mb-3">
    <div class="form-group">
      <input class="btn btn-success " type="submit" name="Search" value="Search">
      </form>
    </div>
  </div>
</div>
</div>
<div class="row no-gutters">
  <?php
  if (isset($_GET['Search'])) { // if search form is submitted
          //using like attribute in sql query
    $query = "select * from customer where customer_id like '%{$_GET['find']}%' or customer_firstName like '%{$_GET['find']}%' or customer_lastName like '%{$_GET['find']}%' or customer_teamName like '%{$_GET['find']}%'";
    $result = mysqli_query($connection, $query);
          // if no results are found.
    $count = mysqli_num_rows($result);
    if($count==0)
    echo "<h4>No data found.</h4>";
    while ($row = mysqli_fetch_assoc($result)) {
      $customer_id = $row['customer_id'];
      $customer_firstname =       $row['customer_firstName'];
      $customer_lastname =        $row['customer_lastName'];
      $customer_email =           $row['customer_email'];
      $customer_phoneNo =         $row['customer_phoneNo'];
      $customer_teamName =        $row['customer_teamName'];
      $customer_orgName =         $row['customer_orgName'];
  ?>
      <div class="col-lg-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="text-center">User Profile<span class="glyphicon glyphicon-user pull-right"></span></h4>
          </div>
          <div class="panel-body text-center">
            <p class="lead">
              <strong><?php echo $customer_firstname, " ", $customer_lastname; ?></strong>
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item liitem"><strong>Phone:</strong>
              <span class="pull-right"><?php echo $customer_phoneNo; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>Email:</strong>
              <span class="pull-right"><?php echo $customer_email; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>Team:</strong>
              <span class="pull-right"><?php echo $customer_teamName; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>College:</strong>
              <span class="pull-right"><?php echo $customer_orgName; ?></span>
            </li>
            <li class="list-group-item liitem  d-flex justify-content-between align-items-center">
              <div class="row">
                <a href="./customer.php?source=view-customer&cus_del_id=<?php echo $customer_id; ?>" onclick="return confirm('Do you really want to delete this customer?');">
                  <div class="col-lg-5 text-center">
                    <img src="../images/box-4x.png" class="d-flex" alt="delete">
                  </div>
                </a>
                <a href="./customer.php?source=edit-customer&cust_id=<?php echo $customer_id; ?>">
                  <div class="col-lg-5 text-center">
                    <img src="../images/pencil-4x.png" class="d-flex" alt="delete">
                  </div>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    <?php }
  } else { //  search form is not submitted.
    $query = "select * from customer";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $customer_id = $row['customer_id'];
      $customer_firstname =       $row['customer_firstName'];
      $customer_lastname =        $row['customer_lastName'];
      $customer_email =           $row['customer_email'];
      $customer_phoneNo =         $row['customer_phoneNo'];
      $customer_teamName =        $row['customer_teamName'];
      $customer_orgName =         $row['customer_orgName'];
    ?>
      <div class="col-lg-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="text-center">User Profile<span class="glyphicon glyphicon-user pull-right"></span></h4>
          </div>
          <div class="panel-body text-center">
            <p class="lead">
              <strong><?php echo $customer_firstname, " ", $customer_lastname; ?></strong>
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item liitem"><strong>Phone:</strong>
              <span class="pull-right"><?php echo $customer_phoneNo; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>Email:</strong>
              <span class="pull-right"><?php echo $customer_email; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>Team:</strong>
              <span class="pull-right"><?php echo $customer_teamName; ?></span>
            </li>
            <li class="list-group-item liitem"><strong>College:</strong>
              <span class="pull-right"><?php echo $customer_orgName; ?></span>
            </li>
            <li class="list-group-item liitem  d-flex justify-content-between align-items-center">
              <div class="row">
                <a href="./customer.php?source=view-customer&cus_del_id=<?php echo $customer_id; ?>" onclick="return confirm('Do you really want to delete this customer?');">
                  <div class="col-lg-5 text-center">
                    <img src="../images/box-4x.png" class="d-flex" alt="delete">
                  </div>
                </a>
                <a href="./customer.php?source=edit-customer&cust_id=<?php echo $customer_id; ?>">
                  <div class="col-lg-5 text-center">
                    <img src="../images/pencil-4x.png" class="d-flex" alt="delete">
                  </div>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
  <?php }
  } ?>
</div>
<?php
if (isset($_GET['cus_del_id'])) {
  $query = "delete from customer where customer_id={$_GET['cus_del_id']}";
  $result = mysqli_query($connection, $query);
  header("Location: customer.php");
}
?>