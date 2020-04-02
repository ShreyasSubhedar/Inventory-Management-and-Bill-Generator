<?php
if (isset($_GET['cust_id'])) {
  $query = "select * from customer where customer_id={$_GET['cust_id']}";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $customer_id =              $row['customer_id'];
    $customer_firstname =       $row['customer_firstName'];
    $customer_lastname =        $row['customer_lastName'];
    $customer_billingAddress1 =  $row['customer_billingAddress1'];
    $customer_billingAddress2 =  $row['customer_billingAddress2'];
    $customer_shippingAddress1 =  $row['customer_shippingAddress1'];
    $customer_shippingAddress2 =  $row['customer_shippingAddress2'];
    $customer_email =           $row['customer_email'];
    $customer_phoneNo =         $row['customer_phoneNo'];
    $customer_teamName =        $row['customer_teamName'];
    $customer_orgName =         $row['customer_orgName'];
  }
?>

<script>
function myFunc() {
         var billingAddress = document.getElementById('body11').value;
         document.getElementById('body21').value = "Same as billing address";
         document.getElementById('body22').value = "";
      }
</script>

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
            <input type="text" class="form-control" name="customer_phoneNo" value='<?php echo $customer_phoneNo; ?>' maxlength="55" placeholder="Enter Phone Number" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="cutomer_teamName">Team Name</label>
            <input type="text" class="form-control" name="customer_teamName" value='<?php echo $customer_teamName; ?>' maxlength="55" placeholder="Enter Team Name" required>
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
            <label for="customer_billingAddress1">Billing Address line 1</label>
            <input type="text"  class="form-control " name="customer_billingAddress1" id="body11" placeholder="Enter Billing Address line 1 max(55)" maxlength="55" value="<?php echo $customer_billingAddress1; ?>" required>
          </div>
          <div class="form-group">
            <label for="customer_billingAddress2">Billing Address line 2</label>
            <input type="text"  class="form-control " name="customer_billingAddress2" id="body12" placeholder="Enter Billing Address line 2 (max55)" maxlength="55" value="<?php echo $customer_billingAddress2; ?>" required>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="customer_shippingAddress1">Shipping Address line 1 <small><a onclick="javascript:myFunc()">Same?</a></small></label>
            <input type="text"  class="form-control " name="customer_shippingAddress1" id="body21" placeholder="Enter Shipping Address line 1 max(55)" maxlength="55" value="<?php echo $customer_shippingAddress1; ?>" required>
          </div>
          <div class="form-group">
            <label for="customer_shippingAddress2">Shipping Address line 2 <small>(If same then keep this blank)</small></label>
            <input type="text"  class="form-control " name="customer_shippingAddress2" id="body22" placeholder="Enter Shipping Address line 2 max(55)" maxlength="55" value="<?php echo $customer_shippingAddress2; ?>">
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
  $customer_billingAddress1 =  $_POST['customer_billingAddress1'];
  $customer_billingAddress2 =  $_POST['customer_billingAddress2'];
  $customer_shippingAddress1 = $_POST['customer_shippingAddress1'];
  $customer_shippingAddress2 = $_POST['customer_shippingAddress2'];
  $customer_email =           $_POST['customer_email'];
  $customer_phoneNo =         $_POST['customer_phoneNo'];
  $customer_teamName =        $_POST['customer_teamName'];
  $customer_orgName =         $_POST['customer_orgName'];
  $query = "UPDATE customer SET customer_firstName = '{$customer_firstname}',customer_lastName = '{$customer_lastname}', customer_billingAddress1 = '{$customer_billingAddress1}', customer_billingAddress2 = '{$customer_billingAddress2}', customer_shippingAddress1 = '{$customer_shippingAddress1}', customer_shippingAddress2 = '{$customer_shippingAddress2}', customer_email = '{$customer_email}' , customer_orgName='{$customer_orgName}', customer_phoneNo = '{$customer_phoneNo}', customer_teamName= '{$customer_teamName}' WHERE customer_id = {$_GET['cust_id']}";
  $update_user = mysqli_query($connection, $query);
if (!$update_user) {
  echo mysqli_error($connection);
}else{
  header("Location: customer.php");
}
}

?>