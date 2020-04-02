<?php
include('../admin/session.php');
?>

<div class="row no-gutters">
  <div class="col-lg-7 text-center">
    <h3><i>All Transaction Details</i></h3>
  </div>
  <div class="col-lg-4 justify-content-end">
    <div class="md-form active-cyan active-cyan-2 mb-3">
      <form method="GET" action="">
        <input class="form-control" type="text" placeholder="Search by OrderID | InVoiceID" name="find" aria-label="Search">
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
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Order ID</th>
        <th scope="col">Invoice ID</th>
        <th scope="col">Customer ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer Team Name</th>
        <th scoope="col">Payment Due</th>
        <th scope="col">PDF Invoice</th>
        <th scope="col">Delete Transaction</th>
        <th scope="col"> Payment Done?</th>
      </tr>
    </thead>
    <tbody>

      <?php
      if (isset($_GET['Search'])) { // if search form is submitted
        //using like attribute in sql query
        $row_customer;
        $query_transaction = "select * from transaction where transaction_id like'%{$_GET['find']}%' or invoice_id  like'%{$_GET['find']}%' or order_id  like'%{$_GET['find']}%'";
        $result_transaction = mysqli_query($connection, $query_transaction);
        // if no results are found.
        $count = mysqli_num_rows($result_transaction);
        if ($count == 0)
          echo "<h4>No data found.</h4>";
        while ($row_transaction = mysqli_fetch_assoc($result_transaction)) {

      ?>
          <tr>
            <th scope="row"><?php echo $row_transaction['transaction_id']; ?></th>
            <td><?php echo $row_transaction['order_id']; ?></td>
            <td><?php echo $row_transaction['invoice_id']; ?></td>
            <td><?php echo $row_transaction['customer_id']; ?></td>
            <?php
            $query_customer = "select * from customer where customer_id = " . $row_transaction['customer_id'];
            $result_customer = mysqli_query($connection, $query_customer);
            $row_customer = mysqli_fetch_assoc($result_customer);

            echo "<td>" . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'] . "</td>";
            echo "<td>" . $row_customer['customer_teamName'] . "</td>";
            ?>
            <td><?php echo "₹ " . $row_transaction['due'] . " /-"; ?></td>
            <td class="text-center"><a href="../admin/invoice/view_invoice.php?id=<?php echo $row_transaction['transaction_id']; ?>" class="btn btn-success btn-sm active" role="button" aria-pressed="true">View</a></td>
            <td class="text-center"><a href="../admin/transaction.php?tran_del_id=<?php echo $row_transaction['transaction_id']; ?>" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Delete</a></td>
            <td class="text-center"><a href="../admin/transaction.php?tran_paid_id=<?php echo $row_transaction['transaction_id']; ?>" class="btn btn-warning btn-sm active" role="button" aria-pressed="true">Paid.</a></td>
          </tr>



        <?php }
      } else {   // search form is not submitted.
        $row_customer;
        $query_transaction = "select * from transaction ";
        $result_transaction = mysqli_query($connection, $query_transaction);
        while ($row_transaction = mysqli_fetch_assoc($result_transaction)) {

        ?>
          <tr>
            <th scope="row"><?php echo $row_transaction['transaction_id']; ?></th>
            <td><?php echo $row_transaction['order_id']; ?></td>
            <td><?php echo $row_transaction['invoice_id']; ?></td>
            <td><?php echo $row_transaction['customer_id']; ?></td>
            <?php
            $query_customer = "select * from customer where customer_id = " . $row_transaction['customer_id'];
            $result_customer = mysqli_query($connection, $query_customer);
            $row_customer = mysqli_fetch_assoc($result_customer);

            echo "<td>" . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'] . "</td>";
            echo "<td>" . $row_customer['customer_teamName'] . "</td>";
            ?>
            <td class="text-danger"><?php echo "₹ " . $row_transaction['due'] . " /-"; ?></td>
            <td class="text-center"><a href="../admin/invoice/view_invoice.php?id=<?php echo $row_transaction['transaction_id']; ?>" target="_blank" class="btn btn-success btn-sm active" role="button" aria-pressed="true">View</a></td>
            <td class="text-center"><a href="../admin/transaction.php?tran_del_id=<?php echo $row_transaction['transaction_id']; ?>" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Delete</a></td>
            <td class="text-center"><a href="./transaction.php?source=edit-transaction&tran_id=<?php echo $row_transaction['transaction_id'];?>" class="btn btn-warning btn-sm active" role="button" aria-pressed="true">Edit</a></td>

          </tr>



      <?php }
      } //closing bracket of while loop 
      ?>
    </tbody>
  </table>
</div>
<?php
if (isset($_GET['tran_del_id'])) {
  $query = "delete from transaction where transaction_id='{$_GET['tran_del_id']}'";
  $result = mysqli_query($connection, $query);
  $query = "delete from transaction2 where transaction_id='{$_GET['tran_del_id']}'";
  $result = mysqli_query($connection, $query);
  header("Location: transaction.php");
}
if (isset($_GET['tran_paid_id'])) {
  $query = "update  transaction SET  due = 0 where transaction_id= '{$_GET['tran_paid_id']}'";
  $result = mysqli_query($connection, $query);
  header("Location: transaction.php");
}
?>