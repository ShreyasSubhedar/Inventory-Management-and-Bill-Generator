<?php
include('session.php');
?>


<?php include "includes/header.php" ?>
            <div id="wrapper">
        <?php insert_category();?>
        <script>

        </script>  
                <!-- Navigation -->
            <?php include "includes/navigation.php"?>

                <div id="page-wrapper">
                    
                    <div class="container-fluid">

                
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                            <h1 class="page-header">
                                <small>Product Panel</small>
                            </h1>
                          <?php if(isset($_GET['source'])){

                            $source=$_GET['source'];
                          }
                          else
                          $source='';
                                switch($source){
                                case "add-product":
                                    include "includes/add-product.php";
                                break;
                                case "edit-product":
                                    include "includes/edit-product.php";
                                break;
                                default:
                                include "includes/view_all_products.php";
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

        <?php include "includes/footer.php"?>