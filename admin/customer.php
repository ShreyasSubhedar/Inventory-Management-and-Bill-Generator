<?php
include('session.php');
?>

<?php include "includes/header.php" ?>
<div id="wrapper">
  <?php insert_category(); ?>
  <script>

  </script>
  <!-- Navigation -->
  <?php include "includes/navigation.php" ?>

  <div id="page-wrapper">

    <div class="container-fluid">


      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <small> Customer Panel <?php #echo $_SESSION['username'];
                                    ?></small>
          </h1>
          <?php if (isset($_GET['source'])) {

            $source = $_GET['source'];
          } else
            $source = '';
          switch ($source) {
            case "add-customer":
              include "includes/add-customer.php";
              break;
            case "edit-customer":
              include "includes/edit-customer.php";
              break;
            case "2":
              echo "2 ";
              break;
            default:
              include "includes/view_all_customers.php";
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