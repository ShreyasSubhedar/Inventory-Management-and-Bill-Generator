<script>
function myFunc() {
         var billingAddress = document.getElementById('body11').value;
         document.getElementById('body21').value = "Same as billing address";
         document.getElementById('body22').value = "";
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
          <label for="customer_billingAddress1">Billing Address line 1</label>
          <input type="text" class="form-control " name="customer_billingAddress1" id="body11" placeholder="Enter Billing Address line 1(55)" maxlength="55" required>
        </div>
        <div class="form-group">
          <label for="customer_billingAddress2">Billing Address line 2</label>
          <input type="text" class="form-control " name="customer_billingAddress2" id="body12" placeholder="Enter Billing Address line 2(55)" maxlength="55" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_shippingAddress1">Shipping Address line 1 <small><a href=# onclick="javascript:myFunc()">Same?</a></small></label>
          <input type="text" class="form-control " name="customer_shippingAddress1" id="body21" placeholder="Enter Shipping Address line 1" maxlength="55" required>
        </div>
        <div class="form-group">
          <label for="customer_shippingAddress2">Shipping Address line 2 <small>(If same then keep this blank)</small></label>
          <input type="text" class="form-control " name="customer_shippingAddress2" id="body22" placeholder="Enter Shipping Address line 2" maxlength="55">
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
  $customer_billingAddress1 = $_POST['customer_billingAddress1'];
  $customer_billingAddress2 = $_POST['customer_billingAddress2'];
  $customer_shippingAddress1 = $_POST['customer_shippingAddress1'];
  $customer_shippingAddress2 = $_POST['customer_shippingAddress2'];
  $customer_teamName = $_POST['customer_teamName'];
  $customer_orgName = $_POST['customer_orgName'];
  $query = "INSERT INTO customer ( customer_firstname ,
  customer_lastname ,
  customer_email ,
  customer_phoneNo, 
  customer_billingAddress1, 
  customer_billingAddress2, 
  customer_shippingAddress1, 
  customer_shippingAddress2, 
  customer_teamName ,
  customer_orgName )";
  $query .= " VALUES('{$customer_firstname}','{$customer_lastname}','{$customer_email}','{$customer_phoneNo}','{$customer_billingAddress1}','{$customer_billingAddress2}','{$customer_shippingAddress1}','{$customer_shippingAddress2}', '{$customer_teamName}', '{$customer_orgName}') ";
  $create_user = mysqli_query($connection, $query);
  if (!$create_user) {
    echo mysqli_error($connection);
  }
  else{
  echo "Customer is Created: <a href='customer.php'> View User</a>";
  }
}
?>