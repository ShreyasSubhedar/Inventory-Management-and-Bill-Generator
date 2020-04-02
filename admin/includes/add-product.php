<?php
include('../admin/session.php');
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Add New Product</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_name">Product Name</label>
          <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_category">Product ID</label>
          <input type="text" class="form-control" name="product_id" placeholder="Enter Product ID" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 ">
        <div class="form-group">
          <label for="product_image">Product Image</label> <small>Upload less than 5 MB</small>
          <input type="file" name="product_image" placeholder="choose file">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_category">Product Category</label>
          <input type="text" class="form-control" name="product_category" placeholder="Enter Category of Product" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="product_tags">Product Tags</label>
          <textarea class="form-control" name="product_tags" placeholder="Enter comma separated Product Tags" cols="50" rows="5" required></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="customer_billingAddress">Product Description</label>
          <textarea class="form-control " name="product_description" id="body1" minlength="100" placeholder="Enter Product Desciption" cols="50" rows="5" required></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 ">
        <div class="form-group">
          <label for="product_costPrice">Product Cost Price </label>
          <input type="number" class="form-control" name="product_costPrice" placeholder="Product Cost Price" required>
        </div>
      </div>
      <div class="col-lg-4 ">
        <div class="form-group">
          <label for="product_sellingPrice">Product Selling Price</label>
          <input type="number" class="form-control" name="product_sellingPrice" placeholder="Product Selling Price" required>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="customer_quantity">Product Quantity</label>
          <input type="number" class="form-control" name="product_quantity" placeholder="Product Quantity" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="btn btn-success btn-block " type="submit" name="add_newProduct" value="Add New Product">
        </div>
      </div>
    </div>
  </div>

</form>
<?php


if (isset($_POST['add_newProduct'])) {

  $product_name                = $_POST['product_name'];
  $product_id                  = $_POST['product_id'];
  $product_category            = $_POST['product_category'];
  $product_description         = $_POST['product_description'];
  $product_tags                = $_POST['product_tags'];
  $product_sellingPrice        = $_POST['product_sellingPrice'];
  $product_costPrice           = $_POST['product_costPrice'];
  $product_quantity =            $_POST['product_quantity'];
  $product_image               = $_FILES['product_image']['name'];
  $product_image_temp          = $_FILES['product_image']['tmp_name'];
  move_uploaded_file($product_image_temp, "../images/$product_image");
  $query = "INSERT INTO product (product_name , product_id , product_category , product_description , product_tags , product_sellingPrice , product_costPrice , product_quantity , product_image ) ";
  $query .= "VALUES('{$product_name}','{$product_id}','{$product_category}','{$product_description}','{$product_tags}','{$product_sellingPrice}','{$product_costPrice}','{$product_quantity}','{$product_image}') ";

  $add_product = mysqli_query($connection, $query);
  if (!$add_product) {
    echo mysqli_error($connection);
  }
  else{
    echo "product added. <a href='product.php'>View Product</a>>";
  }
}



?>