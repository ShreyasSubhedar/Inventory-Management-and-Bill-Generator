<?php

if (isset($_GET['note_id']))
{
  $query = "select * from note where note_id='{$_GET['note_id']}'";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result))
  {
    $note_id                  = $row['note_id'];
    $note                     = $row['note'];
    $note_tags                = $row['note_tags'];
    
  }
  
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Edit Note</h3>
      </div>
    </div>
    
    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control " name="note" id="note" value="" placeholder="Type your note here" cols="50" rows="5" required><?php echo $note;?></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="note_tags">Note Tags</label>
                <textarea class="form-control" name="note_tags" value="" placeholder="Enter comma separated Note Tags" cols="50" rows="5" required><?php echo $note_tags;?></textarea>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="btn btn-success btn-block " type="submit" name="editNote" value="Edit Note">
        </div>
      </div>
    </div>
  </div>
</form>
<?php }?>
<?php

if (isset($_POST['editNote']))
{
    $note                     = $_POST['note'];
    $note_tags                = $_POST['note_tags'];

  $query = "UPDATE note SET note ='{$note}',note_tags = '{$note_tags}' WHERE note_id = '{$_GET['note_id']}'";
  $update_note = mysqli_query($connection, $query);
  if (!$update_note) 
  {
    echo mysqli_error($connection);
  }
  else
  {
    echo "note updated. <a href='note.php'> View Note </a>";
    header("Location: note.php");
  }
}

?>