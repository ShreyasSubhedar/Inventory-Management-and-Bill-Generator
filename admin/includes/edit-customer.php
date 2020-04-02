<?php
if (isset($_GET['cust_id'])) {
  $query = "select * from customer where customer_id={$_GET['cust_id']}";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $customer_id =              $row['customer_id'];
    $customer_firstname =       $row['customer_firstName'];
    $customer_lastname =        $row['customer_lastName'];
    $customer_billingAddress =  $row['customer_billingAddress'];
    $customer_shippingAddress =  $row['customer_shippingAddress'];
    $customer_email =           $row['customer_email'];
    $customer_phoneNo =         $row['customer_phoneNo'];
    $customer_teamName =        $row['customer_teamName'];
    $customer_orgName =         $row['customer_orgName'];
  }
?>
  <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col col-lg-12 bg-success text-white text-center">
          <h3>Edit Existing Customer</h3>
        </div>
        <br>
      </div>
      <div class="row">
        <div class=col-lg-6>
          <div class="form-group">
            <label for="customer_firstname">Firstname</label>
            <input type="text" class="form-control" name="customer_firstname" value='<?php echo $customer_firstname; ?>' placeholder="Enter Firstname" required>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="customer_lastname">Lastname</label>
            <input type="text" class="form-control" name="customer_lastname" value='<?php echo $customer_lastname; ?>' placeholder="Enter Lastname" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="cutomer_email">Email</label>
            <input type="text" class="form-control" name="customer_email" value='<?php echo $customer_email; ?>' placeholder="Enter Email" required>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="cutomer_phoneNo">Phone Number</label>
            <input type="text" class="form-control" name="customer_phoneNo" value='<?php echo $customer_phoneNo; ?>' placeholder="Enter Phone Number" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="cutomer_teamName">Team Name</label>
            <input type="text" class="form-control" name="customer_teamName" value='<?php echo $customer_teamName; ?>' placeholder="Enter Team Name" required>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="cutomer_orgName">Organization Name</label>
            <input type="text" class="form-control" name="customer_orgName" value='<?php echo $customer_orgName; ?>' placeholder="Enter Organization/College Name" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="customer_billingAddress">Billing Address</label>
            <textarea class="form-control " name="customer_billingAddress" id="body1" placeholder="Enter Billing Address" required><?php echo $customer_billingAddress; ?></textarea>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="customer_shippingAddress">Shipping Address <small><a href=#>Same?</a></small></label>
            <textarea class="form-control " name="customer_shippingAddress" id="body2" placeholder="Enter Shipping Address" required><?php echo $customer_shippingAddress; ?></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <input class="btn btn-primary btn-block" type="submit" name="edit_customer" value="Submit Changes">
          </div>
        </div>
      </div>

  </form>

<?php } ?>


<?php
if (isset($_POST['edit_customer'])) {
  $customer_firstname =       $_POST['customer_firstname'];
  $customer_lastname =        $_POST['customer_lastname'];
  $customer_billingAddress =  $_POST['customer_billingAddress'];
  $customer_shippingAddress = $_POST['customer_shippingAddress'];
  $customer_email =           $_POST['customer_email'];
  $customer_phoneNo =         $_POST['customer_phoneNo'];
  $customer_teamName =        $_POST['customer_teamName'];
  $customer_orgName =         $_POST['customer_orgName'];
$query = "UPDATE customer SET customer_firstName = '{$customer_firstname}',customer_lastName = '{$customer_lastname}', customer_billingAddress = '{$customer_billingAddress}', customer_shippingAddress = '{$customer_shippingAddress}',customer_email = '{$customer_email}' ,customer_orgName='{$customer_orgName}',customer_phoneNo = '{$customer_phoneNo}', customer_teamName= '{$customer_teamName}' WHERE customer_id = {$_GET['cust_id']}";
$update_user = mysqli_query($connection, $query);
if (!$update_user) {
  echo mysqli_error($connection);
}else{
  header("Location: customer.php");
}
}

?>