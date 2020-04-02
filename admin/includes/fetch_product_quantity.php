<?php
include('../admin/session.php');
?>
<?php

$total_product = count($_POST["product_id"]);
$check_flag=$total_product;
for ($i = 1; $i <= $total_product; $i++)
{
    //this to
    if (trim($_POST["product_id"][$i - 1] != '')) {
      ${"product_id" . $i} = $_POST["product_id"][$i - 1];
    }
    if (trim($_POST["quantity"][$i - 1] != '')) {
      ${"quantity" . $i} = $_POST["quantity"][$i - 1];
    }

    $fetch_quantity_query = "select product_quantity from product where product_id='${'product_id' .$i}'";
    $fetch_quantity = mysqli_fetch_assoc(mysqli_query($connection, $fetch_quantity_query));
    $available_quantity=(int)$fetch_quantity["product_quantity"];
    if($available_quantity<${"quantity" . $i})
    {
        $check_flag = -1;
    }
  }
if($check_flag == -1)
{
    echo "Enough stocks not available";
}
else
{
    echo "OK...!";
}



/*
if(!empty($_POST['product_id_temp']))
{
    $product_id_temp =  $_POST['product_id_temp'];
}
if(!empty($_POST['quantity_temp']))
{
    $quantity_temp =  (int)$_POST['quantity_temp'];
}

$results = mysqli_query($connection, "SELECT * FROM product WHERE product_id=".$product_id_temp."");

$row = mysqli_fetch_assoc($results);
{
    $available_quantity=(int)$row["product_quantity"];
}


// echo out some json to send to the front end
if($available_quantity<$quantity_temp)
{
    echo "Enough stocks not available";
}
else
{
    echo "OK...!";
}
*/

?>