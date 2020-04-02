<?php
include('session.php');
?>


<?php include "includes/header.php" ?>
<div id="wrapper">
  <!-- Navigation -->
  <?php include "includes/navigation.php" ?>

  <div id="page-wrapper">

    <div class="container-fluid">


      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <small>Notes Panel</small>
          </h1>
          <?php if (isset($_GET['source'])) {

            $source = $_GET['source'];
          } else
            $source = '';
          switch ($source) {
            case "add-note":
              include "includes/add-note.php";
              break;
            case "edit-note":
              include "includes/edit-note.php";
              break;
            default:
              include "includes/view_all_notes.php";
              break;
          }


          ?>
        </div>
      </div>
      <!-- /.row -->
      <?php
      daleteCategories();
      ?>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/footer.php" ?>