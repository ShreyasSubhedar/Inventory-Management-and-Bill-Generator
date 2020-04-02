<?php

if (isset($_GET['prod_id'])) {
  $query = "select * from product where product_id='{$_GET['prod_id']}'";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $product_name                = $row['product_name'];
    $product_id                  = $row['product_id'];
    $product_category            = $row['product_category'];
    $product_description         = $row['product_description'];
    $product_tags                = $row['product_tags'];
    $product_sellingPrice        = $row['product_sellingPrice'];
    $product_costPrice           = $row['product_costPrice'];
    $product_quantity            = $row['product_quantity'];
    $product_image               = $row['product_image'];
  }
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Edit Product</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_name">Product Name</label>
          <input type="text" class="form-control" name="product_name" value="<?php echo $product_name;?>" placeholder="Enter Product Name" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_category">Product ID</label>
          <input type="text" class="form-control" name="product_id"  readonly value="<?php echo $product_id;?>" placeholder="Enter Product ID" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 ">
          <div class="form-group">
            <img width="150"  height="150" src="../images/<?php echo $product_image; ?>" alt="img">
          <div class="form-group">
          <label for="product_image">Product Image</label> <small>Upload less than 5 MB</small>
          <input type="file" name="product_image" placeholder="choose file">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_category">Product Category</label>
          <input type="text" class="form-control" name="product_category" value="<?php echo $product_category;?>" placeholder="Enter Category of Product" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_tags">Product Tags</label>
          <textarea class="form-control" name="product_tags" placeholder="Enter comma separated Product Tags" cols="50" rows="5" required><?php echo $product_tags;?></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_billingAddress">Product Description</label>
          <textarea class="form-control " name="product_description" id="body1" minlength="100" placeholder="Enter Product Desciption" cols="50" rows="5" required><?php echo $product_description;?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 ">
        <div class="form-group">
          <label for="product_costPrice">Product Cost Price </label>
          <input type="number" class="form-control" name="product_costPrice" value="<?php echo $product_costPrice;?>" placeholder="Product Cost Price" required>
        </div>
      </div>
      <div class="col-lg-4 ">
        <div class="form-group">
          <label for="product_sellingPrice">Product Selling Price</label>
          <input type="number" class="form-control" name="product_sellingPrice" value="<?php echo $product_sellingPrice;?>" placeholder="Product Selling Price" required>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="customer_quantity">Product Quantity</label>
          <input type="number" class="form-control" name="product_quantity"  value="<?php echo $product_quantity;?>" placeholder="Product Quantity" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="btn btn-success btn-block " type="submit" name="editProduct" value="Edit Product">
        </div>
      </div>
    </div>
  </div>
<?php }?>
</form>
<?php
if (isset($_POST['editProduct'])) {
  $product_name                = $_POST['product_name'];
  $product_id                  = $_POST['product_id'];
  $product_category            = $_POST['product_category'];
  $product_description         = $_POST['product_description'];
  $product_tags                = $_POST['product_tags'];
  $product_sellingPrice        = $_POST['product_sellingPrice'];
  $product_costPrice           = $_POST['product_costPrice'];
  $product_quantity            = $_POST['product_quantity'];
  $product_image               = $_FILES['product_image']['name'];
  $product_image_temp          = $_FILES['product_image']['tmp_name'];
  move_uploaded_file($product_image_temp, "../images/$product_image");

  if (empty($product_image)) {
    $query = "SELECT * FROM product WHERE product_id = '{$product_id}'";
    $select_image = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_image)) {
      $product_image = $row['product_image'];
    }
  }
  $query = "UPDATE product SET product_name ='{$product_name}',product_quantity ='{$product_quantity}',product_category = '{$product_category}',product_description ='{$product_description}',product_tags = '{$product_tags}',product_sellingPrice ='{$product_sellingPrice}',product_costPrice = '{$product_costPrice}',product_image = '{$product_image}' WHERE product_id = '{$_GET['prod_id']}'";
  $update_product = mysqli_query($connection, $query);
  if (!$update_product) {
    echo mysqli_error($connection);
  }
  else{
    header("Location: product.php");
  }
}
?>