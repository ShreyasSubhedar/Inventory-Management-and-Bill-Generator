<?php
include('../admin/session.php');
?>

<div class="row no-gutters">
    <div class="col-lg-7 text-center">
        <h3><i>All Notes</i></h3>
    </div>
    <div class="col-lg-4 justify-content-end">
        <div class="md-form active-cyan active-cyan-2 mb-3">
            <form method="GET" action="">
                <input class="form-control" type="text" placeholder="Search by notes | tags " name="find" aria-label="Search">
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
        $query = "select * from note where note like '%{$_GET['find']}%' or note_tags like '%{$_GET['find']}%' ";
        // if no results are found.
        $result = mysqli_query($connection, $query);
        $i = 1;
        $count = mysqli_num_rows($result);
        if ($count == 0)
            echo "<h4>No data found.</h4>";

        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row['note_id'])) {
                $note_id                  = $row['note_id'];
            }
            $note                     = $row['note'];
            $note_tags                = $row['note_tags'];
    ?>
            <div class="col-lg-3 ">
                <form>
                    <div class="card border-right-0">
                        <div class="card-body">
                                <div  class = "h-100 d-inline-block bg-info"  style = "width: 120px;">
                                    <?php echo substr($note,0,70) ; ?>...
                            </div>
                            <div class="btn-group d-flex col">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a class="btn btn-success flex-fill" href="./note.php?source=edit-note&note_id=<?php echo $note_id; ?>"> Edit </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn btn-warning flex-fill text-white" href="./note.php?source=view-notes&note_del_id=<?php echo $note_id; ?>"> Delete </a>
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
        $query = "select * from note";
        $result = mysqli_query($connection, $query);
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row['note_id'])) {
                $note_id                  = $row['note_id'];
            }
            $note                     = $row['note'];
            $note_tags                = $row['note_tags'];
        ?>
            <div class="col-lg-3 ">
                <form>
                    <div class="card border-right-0">
                        <div class="card-body">
                            <span class="pull-right"><?php echo substr($note,0,70); ?>...</span>
                        </div>
                        <div class="btn-group d-flex col">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="btn btn-success flex-fill" href="./note.php?source=edit-note&note_id=<?php echo $note_id; ?>"> Edit </a>
                                </div>
                                <div class="col-lg-6">
                                    <a class="btn btn-warning flex-fill text-white" href="./note.php?source=view-notes&note_del_id=<?php echo $note_id; ?>"> Delete </a>
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
if (isset($_GET['note_del_id'])) {
    $query = "delete from note where note_id='{$_GET['note_del_id']}'";
    $result = mysqli_query($connection, $query);
    header("Location: note.php");
}
?>