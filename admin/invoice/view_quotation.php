
<?php
$connection = mysqli_connect("localhost", "root", "");

// Selecting Database
$db = mysqli_select_db($connection, "ProCure");

if (!isset($_SESSION)) {
    session_start(); // Starting Session
}

// Storing Session
$user_check = $_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql = mysqli_query($connection, "select username from login where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
if (!isset($login_session)) {
    mysqli_close($connection); // Closing Connection
    header('Location: ../index.php'); // Redirecting To Home Page
}

if(isset($_GET['id']))
{
$query_transaction = "select * from quotation where quotation_id = '{$_GET['id']}'";
$result = mysqli_query($connection, $query_transaction);
$row = mysqli_fetch_assoc($result);
$sub_total = $row['sub_total'];
$net_total = $row['net_total'];
$customer_id    = $row['customer_id'];
$date           = $row['date'];
$total_quantity = 0;
$gst            = $row['gst'];
$discount       = $row['discount'];
//$paid           = $row['paid'];
$order_id       = $row['quote_id'];
$invoice_id     = $row['quote_id'];
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
$pdf->SetTextColor(128, 128, 128);
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
    "Team " . $row_customer['customer_teamName'] . " (" . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'].")",
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
$query_transaction2 = "select * from quotation2 where quotation_id = '{$_GET['id']}'";
$result = mysqli_query($connection, $query_transaction2);
$total_product = mysqli_num_rows($result);
$i=0;
while ($row1 = mysqli_fetch_assoc($result)) {
    $i++;
    //All important computation :::::
    $query_product = "select * from product where product_id = '{$row1['product_id']}'";
    $result3 = mysqli_query($connection, $query_product);
    $row = mysqli_fetch_assoc($result3);
    $productName1 = $row['product_name'];
    $pos = strpos($productName1, ' ');
    // $productName1 = $productName1.substr($row['product_name'],15);
    $productPriceQuantity = ($row['product_sellingPrice']) * $row1['prod_quantity'];
    $gstPerProduct = (18 * floatval($productPriceQuantity)) / 100.00;
    $total_gst += $gstPerProduct;
    $totalPrice = ($productPriceQuantity + $gstPerProduct);
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
    $pdf->MultiCell(11, 10, $row1['prod_quantity'],0,"C");
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
    if (strlen($productName1) <= 40 )
        {$pdf->SetXY(5, $y + 15);
          $y = $y + 15;
        }
      else {
        $pdf->SetXY(5, $y + 20);
        $y=$y + 20;
      }
    $total_quantity+=$row1['prod_quantity'];
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
  $pdf->Line(5, $y + 13, 205, $y = $y + 13);
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
  $pdf->Output('', $row_customer['customer_teamName'] . " (#" . $invoice_id . ").pdf");
} else {
  echo "Not Found";
}