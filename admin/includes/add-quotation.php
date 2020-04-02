<?php
include('../admin/session.php');
?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- ../admin/invoice/invoice_generation.php -->
<form action="../admin/invoice/quotation_generation.php" target="_blank" method="post" name="add_quotation_form" id="add_quotation_form" enctype="multipart/form-data"  onsubmit="return confirm('Confirm to add this quotation');">
  <div class="ui">
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Add New Quotation</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_id">Customer Name</label>
          <div class="cool">
          <select name="customer_id" id="customer_id" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
              <option value="">Select Customer.....</option>
              <?php
              $query = "SELECT * FROM customer";
              $select_customer = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($select_customer)) {
                $cust_id = $row['customer_id'];
                $cust_first_name = $row['customer_firstName'];
                $cust_last_name = $row['customer_lastName'];
                $cust_team_name = $row['customer_teamName'];
                echo "<option value='" . $cust_id . "' >" . $cust_first_name . " " . $cust_last_name . " (" . $cust_team_name . ")</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" name="date" value="" placeholder="Enter date" required>
        </div>
      </div>
    </div>

    <!--for that magic-->
    <table class="table table-striped table-hover" id="dynamic_field">
      <tr>
        <td class="text-center">
          <div class="col-lg-12">
            <label for="product_id">Product:</label>
            <select name="product_id[]" class="form-control" required>
              <option value="">- Select -</option>
              <?php
              // Fetch product
              $sql_product = "SELECT * FROM product where product_quantity>0";
              $product_data = mysqli_query($connection, $sql_product);
              while ($row = mysqli_fetch_assoc($product_data))
              {
                $pro_id = $row['product_id'];
                $pro_name = $row['product_name'];
                //$pro_Quantity = (int)$row['product_quantity'];

                // Option
                echo "<option value='" . $pro_id . "' >ID : " . $pro_id . " (" . $pro_name . ")</option>";
              }
              ?>
            </select>
          </div>
        </td>
        <td class="text-center">
          <div class="col-lg-12">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity[]" min="1" placeholder="Enter quantity of Product" required>
          </div>
        </td>
        <td class="text-center">
          <button type="button" name="add_field" id="add_field" class="btn btn-success">Add More</button>
        </td>
      </tr>
    </table>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="gst">GST</label>
            <input type="text" class="form-control" name="gst" value="18" placeholder="Enter gst in %" required>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" class="form-control" name="discount" value="0" placeholder="Enter discount" required>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="paid">Paid Amount</label>
            <input type="text" name="paid" class="form-control" placeholder="Enter paid amount" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <input class="btn btn-success btn-block " type="submit" name="add_newQuotation" id="add_newQuotation" value="Add New Quotation">
          </div>
        </div>
        <div id="err" class="col-lg-6">
        </div>
      </div>
    </div>
  </div>
</form>
<!--scripts to add new fields-->
<script>
  $(document).ready(function()
  {
    var i = 1;
    $('#add_field').click(function() 
    {
      i++;
      var my_php_code = "<?php $sql_product = "SELECT * FROM product where product_quantity>0";
                          $product_data = mysqli_query($connection, $sql_product);
                          while ($row = mysqli_fetch_assoc($product_data)) {
                            $pro_id = $row['product_id'];
                            $pro_name = $row['product_name'];
                            echo "<option value='" . $pro_id . "' >" . $pro_id . "=" . $pro_name . "</option>";
                          } ?>"
      $('#dynamic_field').append('<tr id="row' + i + '"><td class="text-center"><label for="product_id">Product id</label><select name="product_id[]" class="form-control" required><option value="">- Select -</option>' + my_php_code + '</select></td><td class="text-center"><label for="quantity">Quantity</label><input type="number" class="form-control" name="quantity[]" min="1" placeholder="Enter quantity of Product" required></td><td class="text-center"><button type="button" name="remove" onclick="return confirm("Are you sure you want to delete this item?")"; id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function(){
      if(confirm('Are you sure you want to remove this item?'))
      {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
      }

    });
  });
</script>
