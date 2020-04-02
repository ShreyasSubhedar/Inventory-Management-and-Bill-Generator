<?php
include('../admin/session.php');
?>

<div class="row no-gutters">
  <div class="col-lg-7 text-center">
    <h3><i>All Quotation Details</i></h3>
  </div>
  <div class="col-lg-4 justify-content-end">
    <div class="md-form active-cyan active-cyan-2 mb-3">
      <form method="GET" action="">
        <input class="form-control" type="text" placeholder="Search by Quotation ID | Date" name="find" aria-label="Search">
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
        <th scope="col">Quotation ID</th>
        <th scope="col">Customer ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer Team Name</th>
        <th scope="col"> Quotation Date</th>
        <th scope="col">PDF Invoice</th>
        <th scope="col">Delete Quotation</th>
      </tr>
    </thead>
    <tbody>

      <?php
      if (isset($_GET['Search'])) { // if search form is submitted
        $row_customer;
        //using like attribute in sql query
        $query_quotation = "select * from quotation where quotation_id like'%{$_GET['find']}%' or quote_id  like'%{$_GET['find']}%'";
        $result_quotation = mysqli_query($connection, $query_quotation);
        // if no results are found.
        $count = mysqli_num_rows($result_quotation);
        if ($count == 0)
          echo "<h4>No data found.</h4>";
        while ($row_quotation = mysqli_fetch_assoc($result_quotation)) {

      ?>
          <tr>
            <th scope="row"><?php echo $row_quotation['quotation_id']; ?></th>
            <td><?php echo $row_quotation['quote_id']; ?></td>
            <td><?php echo $row_quotation['customer_id']; ?></td>
            <?php
            $query_customer = "select * from customer where customer_id = " . $row_quotation['customer_id'];
            $result_customer = mysqli_query($connection, $query_customer);
            $row_customer = mysqli_fetch_assoc($result_customer);

            echo "<td>" . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'] . "</td>";
            echo "<td>" . $row_customer['customer_teamName'] . "</td>";
            ?>
            <td><?php echo $row_quotation['date']; ?></td>
            <td class="text-center"><a href="../admin/invoice/view_quotation.php?id=<?php echo $row_quotation['quotation_id']; ?>" class="btn btn-success btn-sm active" role="button" aria-pressed="true">View</a></td>
            <td class="text-center"><a href="../admin/quotation.php?tran_del_id=<?php echo $row_quotation['quotation_id']; ?>" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Delete</a></td>

          </tr>



        <?php }
      } else {  //  search form is not submitted.
        $row_customer;
        $query_quotation = "select * from quotation ";
        $result_quotation = mysqli_query($connection, $query_quotation);
        while ($row_quotation = mysqli_fetch_assoc($result_quotation)) {

        ?>
          <tr>
            <th scope="row"><?php echo $row_quotation['quotation_id']; ?></th>
            <td><?php echo $row_quotation['quote_id']; ?></td>
            <td><?php echo $row_quotation['customer_id']; ?></td>
            <?php
            $query_customer = "select * from customer where customer_id = " . $row_quotation['customer_id'];
            $result_customer = mysqli_query($connection, $query_customer);
            $row_customer = mysqli_fetch_assoc($result_customer);

            echo "<td>" . $row_customer['customer_firstName'] . " " . $row_customer['customer_lastName'] . "</td>";
            echo "<td>" . $row_customer['customer_teamName'] . "</td>";
            ?>
            <td><?php echo $row_quotation['date']; ?></td>
            <td class="text-center"><a href="../admin/invoice/view_quotation.php?id=<?php echo $row_quotation['quotation_id']; ?>" class="btn btn-success btn-sm active" role="button" aria-pressed="true">View</a></td>
            <td class="text-center"><a href="../admin/quotation.php?quot_del_id=<?php echo $row_quotation['quotation_id']; ?>" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Delete</a></td>

          </tr>



      <?php }
      } //closing bracket of while loop 
      ?>
    </tbody>
  </table>
</div>
<?php
if (isset($_GET['quot_del_id'])) {
  $query = "delete from quotation where quotation_id='{$_GET['quot_del_id']}'";
  $result = mysqli_query($connection, $query);
  $query = "delete from quotation2 where quotation_id='{$_GET['quot_del_id']}'";
  $result = mysqli_query($connection, $query);
  header("Location: quotation.php");
}
?>