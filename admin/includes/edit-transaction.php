<?php
$allDue;
if (isset($_GET['tran_id']))
{
  $query = "select * from transaction where transaction_id='{$_GET['tran_id']}'";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result))
  {
    $order_id                  = $row['order_id'];
    $due                     = $row['due'];
    $date               = $row['date'];
   $allDue =$due; 
  }
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Edit Transaction</h3>
      </div>
    </div>
    
    
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="note">Transaction Date</label>
                <input type="text" class="form-control " name="note" id="note" value="<?php echo $date;?>" readonly >
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="note">Order ID</label>
                <input type="text" class="form-control " name="note" id="note" value="<?php echo $order_id;?>" readonly >
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="note">Payment Due</label>
                <input type="text" class="form-control " name="note" id="note" value="<?php echo $due;?>" readonly >
            </div>
        </div>
    </div>
  <div class="container"> 
    <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
        <input type="number" class="form-control " placeholder="Enter paid amount by customer "name="due" min="0" max="<?php echo $due;?>"  >
        </div> 
    </div>
      <div class="col-lg-6">
        <div class="form-group">
          <input class="btn btn-warning btn-block " type="submit" name="editTrans" value="Make Changes">
        </div>
      </div>
  </div>
  </div>
</form>
<?php }?>
<?php

if (isset($_POST['editTrans']))
{
    $due   = (int)$allDue -  $_POST['due'];
    $query ="select paid from transaction where transaction_id = '{$_GET['tran_id']}'";
    $paid_result = mysqli_query($connection, $query);
    $paid_row = mysqli_fetch_assoc($paid_result);
    $paid= $paid_row['paid'];
    $paid += $_POST['due'];
  $query = "UPDATE transaction  SET due = '{$due}', paid = '{$paid}' where transaction_id ='{$_GET['tran_id']}'";
  $update_note = mysqli_query($connection, $query);
  if (!$update_note) 
  {
    echo mysqli_error($connection);
  }
  else
  {
    echo "transaction updated. <a href='note.php'> View Note </a>";
    header("Location: transaction.php");
  }
}

?>