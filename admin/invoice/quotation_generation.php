<?php
  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
  $connection = mysqli_connect("localhost", "root", "");

  // Selecting Database
  $db = mysqli_select_db($connection, "ProCure");
  if(!isset($_SESSION)) 
  { 
      session_start();// Starting Session
  } 

  // Storing Session
  $user_check=$_SESSION['login_user'];
  // SQL Query To Fetch Complete Information Of User
  $ses_sql=mysqli_query($connection, "select username from login where username='$user_check'");
  $row = mysqli_fetch_assoc($ses_sql);
  $login_session =$row['username'];
  if(!isset($login_session))
  {
    mysqli_close($connection); // Closing Connection
    header('Location: ../index.php'); // Redirecting To Home Page
  }
?>


<?php
  if (isset($_POST['add_newQuotation']))
  {

    $total_product = count($_POST["product_id"]);
    $check_flag=$total_product;
    $quantiy_error_msg="";
    for ($i = 1; $i <= $total_product; $i++)
    {
      //this to
      if (trim($_POST["product_id"][$i - 1] != '')) {
        ${"product_id" . $i} = $_POST["product_id"][$i - 1];
      }
      if (trim($_POST["quantity"][$i - 1] != '')) {
        ${"quantity" . $i} = (int)$_POST["quantity"][$i - 1];
      }

      $fetch_quantity_query = "select * from product where product_id='${'product_id' .$i}'";
      $fetch_quantity = mysqli_fetch_assoc(mysqli_query($connection, $fetch_quantity_query));
      $available_quantity=(int)$fetch_quantity["product_quantity"];
      $fetch_product_name = $fetch_quantity["product_name"];
      if($available_quantity<${"quantity" . $i})
      {
        $check_flag = -1;
        $quantiy_error_msg .="'.$fetch_product_name.' => Demand:'${"quantity" . $i}' Available:'$available_quantity' '.PHP_EOL.'";
      }
    }
    if($check_flag == -1)
    {
        echo "<script type='text/javascript'>alert('$quantiy_error_msg')</script>";
        header('Location: ../quotation.php?source=add-quotation'); // Redirecting To Add quotation page
    }
    else
    {
      //$total_product = count($_POST["product_id"]);
      $sub_total = 0;
      $net_total = 0;
      $customer_id    = $_POST['customer_id'];
      $date           = date("d-m-Y", strtotime($_POST['date']));
      $total_quantity = 0;
      for ($i = 1; $i <= $total_product; $i++)
      {
        //this to
        if (trim($_POST["product_id"][$i - 1] != ''))
        {
          ${"product_id" . $i} = $_POST["product_id"][$i - 1];
        }
        if (trim($_POST["quantity"][$i - 1] != ''))
        {
          ${"quantity" . $i} = $_POST["quantity"][$i - 1];
          $total_quantity += $_POST["quantity"][$i - 1];
        }

        $fetch_price_and_quantity_query = "select product_sellingPrice, product_quantity from product where product_id='${'product_id' .$i}'";
        $result = mysqli_query($connection, $fetch_price_and_quantity_query);
        $fetch_price_and_quantity = mysqli_fetch_assoc($result);
        $sub_total += (float)($fetch_price_and_quantity['product_sellingPrice'] * ${"quantity" . $i});
        
      }

      $gst            = $_POST['gst'];
      $discount       = $_POST['discount'];
      $paid           = $_POST['paid'];
      $net_total = (float)$sub_total * (($gst + 100) / 100) - $discount;

      //fetching next order id for appending to order_id and invoice_id
      $next_tid_query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'ProCure' AND TABLE_NAME = 'quotation'";
      $next_tid_fetch = mysqli_fetch_assoc(mysqli_query($connection, $next_tid_query));
      $next_tid = $next_tid_fetch['AUTO_INCREMENT'];
      $order_id = 'QT' . str_replace('-', '', $date) . $next_tid;
      $invoice_id = 'PC' . date("Y", strtotime($date)) . $next_tid;
      $due = $net_total - $paid;

      //now add data to quotation table
      $date_ymd = date("Y-m-d", strtotime($date));
      $add_quotation_query = "insert into quotation (quote_id,customer_id,date,sub_total,gst,discount,net_total) ";
      $add_quotation_query .= "values('$order_id','$customer_id','$date_ymd','$sub_total','$gst','$discount','$net_total')";
      $add_quotation = mysqli_query($connection, $add_quotation_query);
      if (!$add_quotation)
      {
        echo mysqli_error($connection);
      }
      else
      {
        //add data to quotation2 table which has product
        $no_error = 1;
        for ($i = 1; $i <= $total_product; $i++)
        {
          $add_quotation2_query = "insert into quotation2 values('$next_tid','${"product_id" .$i}','${"quantity" .$i}')";
          $add_quotation2 = mysqli_query($connection, $add_quotation2_query);
          if (!$add_quotation2)
          {
            echo mysqli_error($connection);
            $no_error = 0;
          }
        }
        if ($no_error == 1)
        {
          // echo "Quotation added. <a href='quotation.php'>View Quotation</a>>";
        }
      }
    }
  }
?>

<?php
require('../fpdf.php');
// Header of Procure PDF :-
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAuthor("ProCure Ltd.");
$pdf->SetSubject("Invoice");
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFont('');
$pdf->Image('ProCure (1x3 inch) Logo.png', 8, 10, -300);
$pdf->SetY(14);
$pdf->Cell(39);

$pdf->write(1.5, "Contact us: +91-9623850747 || marketing.procure@gmail.com");
$pdf->Ln();
$pdf->SetY(15);
$pdf->Cell(39);
$pdf->Write(6.5, "Pro.Cure Services Pvt. Ltd., ");
$pdf->SetFont('Arial', 'I', 7);
$pdf->SetTextColor(0, 0, 0);
$pdf->Write(6.6, "Address: Pimpri Chinchwad, Pune, Maharashtra (India) - 411033");
$pdf->SetY(12);
$pdf->Image('dooted_box.png', 160, 10, 45, 10);
$pdf->SetXY(5, 6);
$pdf->Cell(158);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFont('');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(11.4);
$pdf->Cell(148.8);
$pdf->Cell(47, 7, 'Quotation # ' . $invoice_id, 0, 0, 'C');
$pdf->Line(5, 25, 205, 25);
// Header ends.
// TODO Order ID and Billing address and shipping address...........
$pdf->SetXY(10, 30);
$order_details = array(
    "Quotation ID: " . $order_id,
    "Quotation Date: " . $date,
    // "Invoice No: " . $invoice_id,
    // "Invoice Date: " . date("d-m-Y"),
    "GST: 27AADPD5951A1Z7"
);
for ($i = 0; $i < 3; $i++) {
    if ($i == 0) {
        $pdf->SetFont('Arial', 'B', 8);
    } else {
        $pdf->SetFont('');
    }
    $pdf->Write(0.7, $order_details[$i]);
    $pdf->Ln(4);
}
$query_customer = "select * from customer where customer_id = '{$customer_id}'";
$result23 = mysqli_query($connection, $query_customer);
$row_customer = mysqli_fetch_assoc($result23);
$BaddressLine1 = $row_customer['customer_billingAddress1'];
$BaddressLine2 = $row_customer['customer_billingAddress2'];
$billing_address = array(
    "Billing Address:",
    "Team " . $row_customer['customer_teamName'] . " " . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'],
    $BaddressLine1,
    $BaddressLine2,
    $row_customer['customer_phoneNo']
);
$pdf->SetXY(55, 25.6);
for ($i = 0; $i < 5; $i++) {
    $pdf->SetXY(60, $pdf->getY() + 4);
    if ($i == 0) {
        $pdf->SetFont('Arial', 'B', 8);
    } else {
        $pdf->SetFont('');
    }
    $pdf->Write(0.7, $billing_address[$i]);
}
$SaddressLine1 = $row_customer['customer_shippingAddress1'];
$SaddressLine2 = $row_customer['customer_shippingAddress2'];

$pdf->SetXY(110, 25.6);
$shipping_address = array(
    'Shipping Address:',
    $SaddressLine1,
    $SaddressLine2,
    "",
    ""
    
);

for ($i = 0; $i < 5; $i++) {
    $pdf->SetXY(140, $pdf->getY() + 4);
    if ($i == 0) {
        $pdf->SetFont('Arial', 'B', 8);
    } else {
        $pdf->SetFont('');
    }
    $pdf->Write(0.7, $shipping_address[$i]);
}
    // Order ID and Billing address and shipping address END.


    $pdf->Line(5, $pdf->GetY() + 6, 205, $pdf->GetY() + 6);
    # TABLE .....................
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5, $pdf->GetY() + 12);
    $pdf->Cell(18, 10, "Sr. No.", 0, 0, "C");
    $pdf->Cell(45, 10, "Product", 0, 0, "C");
    $pdf->Cell(45, 10, "Title", 0, 0, "C");
    $pdf->Cell(11, 10, "Qty.", 0, 0, "C");
    $pdf->Cell(24, 10, "Price", 0, 0, "C");
    $pdf->Cell(24, 10, "GST (18.0%)", 0, 0, "C");
    $pdf->Cell(26, 10, "    Total (Rs)", 0, 1, "C");
    $pdf->SetX(5);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $total_gst = 0.00;
    for($i=1;$i<=$total_product;$i++)
    {
      //All important computation :::::
      $query= "select * from product where product_id = '${'product_id' .$i}'";
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_assoc($result);
      $productName1 = $row['product_name'];
      $pos = strpos($productName1, ' ');
      // $productName1 = $productName1.substr($row['product_name'],15);
      $productPriceQuantity = ($row['product_sellingPrice'])* ${"quantity" . $i} ;
      $gstPerProduct = (18*floatval($productPriceQuantity))/100.00;
      $total_gst+=$gstPerProduct;
      $totalPrice = ($productPriceQuantity+$gstPerProduct);
      //IMportant computation ends ::::
      $pdf->SetFont('Arial', '', 10);
      $pdf->MultiCell(18, 10, $i, 0, "C");
      $pdf->SetXY($x + 18, $y);
      $x = $x + 18;
      $col2 = "" . $row['product_category'] . " Part \n(Product Code: " . $row['product_id'] . ")";
      $pdf->MultiCell(45, 5, $col2, 0);
      $pdf->SetXY($x + 45, $y);
      $x = $x + 45;
      $pdf->SetFont('Arial', 'B', 10);
      if ($pos == true and strlen($productName1)>20) {
        $pdf->MultiCell(45, 5, $productName1, 0, "L");
      } else {
        $pdf->MultiCell(45, 10, $productName1, 0, "L");
      }
      $pdf->SetXY($x + 45, $y);
      $x = $x + 45;
      $pdf->SetFont('Arial', '', 10);
      $pdf->MultiCell(11, 10, ${"quantity" . $i}, 0,"C");
      $pdf->SetXY($x + 11, $y);
      $x = $x + 11;
      $pdf->MultiCell(24, 10, number_format($productPriceQuantity, 2), 0, "C");
      $pdf->SetXY($x + 24, $y);
      $x = $x + 24;
      $pdf->MultiCell(24, 10, number_format($gstPerProduct, 2), 0, "C");
      $pdf->SetXY($x + 24, $y);
      $x = $x + 24;
      $pdf->MultiCell(26, 10, number_format($totalPrice, 2), 0, "R");
      // next Row   ....   ....
      $x = 5;
      if (strlen($productName1) <= 40)
        {$pdf->SetXY(5, $y + 15);
          $y = $y + 15;
        }
      else {
        $pdf->SetXY(5, $y + 20);
        $y=$y + 20;
      }
      
    }

    // Final Row................
    $x = 68;
    $pdf->SetXY($x, $y);
  
    $pdf->MultiCell(45, 10, "Total", 0, "L");
    $pdf->SetXY($x + 45, $y);
    $x = $x + 45;
    $pdf->MultiCell(11, 10, $total_quantity, 0, "C");
    $pdf->SetXY($x + 11, $y);
    $x = $x + 11;
    $pdf->SetFont('Arial', 'B', 10);
  
    $pdf->MultiCell(24, 10, number_format($sub_total, 2), 0, "C");
    $pdf->SetXY($x + 24, $y);
    $x = $x + 24;
    $pdf->MultiCell(24, 10, number_format($total_gst, 2), 0,  "C");
    $pdf->SetXY($x + 24, $y);
    $x = $x + 24;
    $pdf->MultiCell(26, 10, number_format($net_total, 2), 0, "R");
     // Final Row END ....................

    // LumSum ...................
    $x = 113;
    $y = $y + 12;
    $pdf->SetXY($x, $y);
    $pdf->SetFillColor(143, 188, 143);
    $pdf->SetFont('Arial', 'B', 12);
  
    $pdf->Cell(45, 7, "GRAND TOTAL", 0, 0, "C", TRUE);
    $pdf->SetXY($x + 45, $y);
    $x = $x + 45;
    $pdf->Cell(40, 7, "Rs " . number_format($net_total, 2), 0, 0, "R", TRUE);
  

    // LumSum END...............
    $pdf->Line(5,$y+13,205,$y=$y+13);
    # TABLE END.

    $pdf->SetXY(5, $y + 5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(72, 72, 72);
    $pdf->MultiCell(90, 5, "Bank Details for Direct Deposit:\nA/C Name -Shubhaang Sangamnath Digge\nA/C No. - 098501511556\nIFSC Code- ICIC0000985");
  
    $pdf->SetXY(177, $y + 5);
    $pdf->Image("stamp.png", 175, $y = $y + 5, -200);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(0, "For Procure");
    $pdf->SetXY(168, $y + 24);
    $pdf->Write(0, "Authorized Signatory");
    $pdf->SetFont('Arial', 'I', 8);
    $impY = (280 - $y) / 2;
    $pdf->SetXY(65, $y + $impY);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Write(0, "**This is a computer generated Quotation No signature required.**");
    $pdf->Image("ProCure (1x3 inch) Logo.png", 165, 253, -350);
    $pdf->SetXY(164, 265.5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->MultiCell(50, 5, "     THANK YOU!\nfor shopping with us.");
     # FOOTER 
    $pdf->Output('I',$row_customer['customer_teamName']." ".$invoice_id . ".pdf");
  

?>