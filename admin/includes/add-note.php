<?php
include('../admin/session.php');
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="ui">
    
    <div class="row">
      <div class="col col-lg-12 bg-success text-white text-center">
        <h3>Add New Note</h3>
      </div>
    </div>
    
    
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control " name="note" id="note" placeholder="Type your note here" minlength="40" cols="50" rows="5" required></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="note_tags">Note Tags</label>
                <textarea class="form-control" name="note_tags" placeholder="Enter comma separated Note Tags" cols="50" rows="5" required></textarea>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="btn btn-success btn-block " type="submit" name="add_newNote" value="Add New Note">
        </div>
      </div>
    </div>
  </div>

</form>
<?php


if (isset($_POST['add_newNote'])) {

  $note                     = trim($_POST['note']);
  $note_tags                = trim($_POST['note_tags']);

  $query = "INSERT INTO note (note , note_tags ) ";
  $query .= "VALUES('{$note}','{$note_tags}') ";

  $add_note = mysqli_query($connection, $query);
  if (!$add_note) {
    echo mysqli_error($connection);
  }
  else{
    echo "note added. <a href='note.php'> View Note </a>";
  }
}



?>