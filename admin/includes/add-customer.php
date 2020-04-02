<script>
function myFunc() {
         var billingAddress = document.getElementById('body1').value;
         document.getElementById('body2').value = "Same as billing address";
      }
</script>
<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Add New Customer</h3>
      </div>
      <br>
    </div>
    <div class="row">
      <div class=col-lg-6>
        <div class="form-group">
          <label for="customer_firstname">Firstname</label>
          <input type="text" class="form-control" name="customer_firstname" placeholder="Enter Firstname" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_lastname">Lastname</label>
          <input type="text" class="form-control" name="customer_lastname" placeholder="Enter Lastname" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="cutomer_email">Email</label>
          <input type="text" class="form-control" name="customer_email" placeholder="Enter Email" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="cutomer_phoneNo">Phone Number</label>
          <input type="text" class="form-control" name="customer_phoneNo" placeholder="Enter Phone Number" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="cutomer_teamName">Team Name</label>
          <input type="text" class="form-control" name="customer_teamName" placeholder="Enter Team Name" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="cutomer_orgName">Organization Name</label>
          <input type="text" class="form-control" name="customer_orgName" placeholder="Enter Organization/College Name" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_billingAddress">Billing Address</label>
          <textarea class="form-control " name="customer_billingAddress" id="body1" placeholder="Enter Billing Address" required></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_shippingAddress">Shipping Address <small><a href=# onclick="javascript:myFunc()">Same?</a></small></label>
          <textarea class="form-control " name="customer_shippingAddress" id="body2" placeholder="Enter Shipping Address" required></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="btn btn-primary btn-block" type="submit" name="add_customer" value="Add Customer">
        </div>
      </div>
    </div>


  </div>


</form>
<?php
if (isset($_POST['add_customer'])) {
  $customer_firstname = $_POST['customer_firstname'];
  $customer_lastname = $_POST['customer_lastname'];
  $customer_email = $_POST['customer_email'];
  $customer_phoneNo = $_POST['customer_phoneNo'];
  $customer_billingAddress = $_POST['customer_billingAddress'];
  $customer_shippingAddress = $_POST['customer_shippingAddress'];
  $customer_teamName = $_POST['customer_teamName'];
  $customer_orgName = $_POST['customer_orgName'];
  $query = "INSERT INTO customer ( customer_firstname ,
  customer_lastname ,
  customer_email ,
  customer_phoneNo, 
  customer_billingAddress, 
  customer_shippingAddress, 
  customer_teamName ,
  customer_orgName )";
  $query .= " VALUES('{$customer_firstname}','{$customer_lastname}','{$customer_email}','{$customer_phoneNo}','{$customer_billingAddress}','{$customer_shippingAddress}', '{$customer_teamName}', '{$customer_orgName}') ";
  $create_user = mysqli_query($connection, $query);
  if (!$create_user) {
    echo mysqli_error($connection);
  }
  else{
  echo "Customer is Created: <a href='customer.php'> View User</a>";
  }
}
?>