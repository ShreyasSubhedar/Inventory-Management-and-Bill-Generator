<?php
include('../admin/session.php');
?>

<div class="row no-gutters">
  <div class="col-lg-7 text-center">
    <h3><i>All Products</i></h3>
  </div>
  <div class="col-lg-4 justify-content-end">
    <div class="md-form active-cyan active-cyan-2 mb-3">
      <form method="GET" action="">
        <input class="form-control" type="text" placeholder="Search by product name | tags " name="find" aria-label="Search">
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
<div class="row">
  <?php
  if (isset($_GET['Search'])) { // if search form is submitted
   //using like attribute in sql query
    $query = "select * from product where product_name like '%{$_GET['find']}%' or product_tags like '%{$_GET['find']}%' ";
            // if no results are found.
    $result = mysqli_query($connection, $query);
    $i = 1; 
    $count = mysqli_num_rows($result);
    if($count==0)
      echo "<h4>No data found.</h4>";
    while ($row = mysqli_fetch_assoc($result)) {
      $product_name                = $row['product_name'];
      $product_id                  = $row['product_id']; 
      $product_category            = $row['product_category'];
      $product_description         = substr($row['product_description'], 0, 100);
      $product_tags                = $row['product_tags'];
      $product_sellingPrice        = $row['product_sellingPrice'];
      $product_costPrice           = $row['product_costPrice'];
      $product_quantity            = $row['product_quantity'];
      $product_image               = $row['product_image'];
  ?>
      <div class="col-lg-3 ">
        <form>
          <div class="card border-right-0">
            <h5 class="card-title bg-info text-white p-2 text-uppercase"> <?php echo $product_name;  ?> </h5>

            <div class="card-body">
              <span>
                <img src="../images/<?php echo $product_image; ?>" height="100" width="100  alt=" phone" class="img-fluid mb-2 rounded"></span>
              <span class="pull-right"><?php echo $product_description; ?>...</span>
              <h6> &#8377; <?php echo $product_sellingPrice;  ?>

                <h6 class="badge badge-success"> <?php echo $product_quantity . "  "; ?><i class="fa fa-bar-chart"> </i> </h6>
            </div>
            <div class="btn-group d-flex col">
              <div class="row">
                <div class="col-lg-6">
                  <a class="btn btn-success flex-fill" href="./product.php?source=edit-product&prod_id=<?php echo $product_id; ?>"> Edit </a></div>
                <div class="col-lg-6">
                  <a class="btn btn-warning flex-fill text-white" href="./product.php?source=view-product&pro_del_id=<?php echo $product_id; ?>"> Delete </a>
                </div>
              </div>
            </div>


          </div>
        </form>
      </div>
      <?php if ($i % 4 == 0)
        echo "&nbsp<hr>";
      $i++; ?>
    <?php
    }
  } else { //  search form is not submitted.
    $query = "select * from product";
    $result = mysqli_query($connection, $query);
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $product_name                = $row['product_name'];
      $product_id                  = $row['product_id'];
      $product_category            = $row['product_category'];
      $product_description         = substr($row['product_description'], 0, 100);
      $product_tags                = $row['product_tags'];
      $product_sellingPrice        = $row['product_sellingPrice'];
      $product_costPrice           = $row['product_costPrice'];
      $product_quantity            = $row['product_quantity'];
      $product_image               = $row['product_image'];
    ?>
      <div class="col-lg-3 ">
        <form>
          <div class="card border-right-0">
            <h5 class="card-title bg-info text-white p-2 text-uppercase"> <?php echo $product_name;  ?> </h5>

            <div class="card-body">
              <span>
                <img src="../images/<?php echo $product_image; ?>" height="100" width="100  alt=" phone" class="img-fluid mb-2 rounded"></span>
              <span class="pull-right"><?php echo $product_description; ?>...</span>
              <h6> &#8377; <?php echo $product_sellingPrice;  ?>

                <h6 class="badge badge-success"> <?php echo $product_quantity . "  "; ?><i class="fa fa-bar-chart"> </i> </h6>
            </div>
            <div class="btn-group d-flex col">
              <div class="row">
                <div class="col-lg-6">
                  <a class="btn btn-success flex-fill" href="./product.php?source=edit-product&prod_id=<?php echo $product_id; ?>"> Edit </a></div>
                <div class="col-lg-6">
                  <a class="btn btn-warning flex-fill text-white" href="./product.php?source=view-product&pro_del_id=<?php echo $product_id; ?>"> Delete </a>
                </div>
              </div>
            </div>


          </div>
        </form>
      </div>
      <?php if ($i % 4 == 0)
        echo "&nbsp<hr>";
      $i++; ?>
  <?php
    }
  }
  ?>





</div>


<?php
if (isset($_GET['pro_del_id'])) {
  $query = "delete from product where product_id='{$_GET['pro_del_id']}'";
  $result = mysqli_query($connection, $query);
  header("Location: product.php");
}
?>