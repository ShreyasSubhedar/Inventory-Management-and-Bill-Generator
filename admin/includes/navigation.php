<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" style="font-size: 50px; font-family: Times New Roman" href="index.php"> <strong>ProCure.</strong> </a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php #echo $_SESSION['username'];
                                                                                            ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
        </li>

    </li>
    <li class="divider"></li>
    <li>
      <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
    </li>
  </ul>
  </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li>
        <a href="index.php"><i class="fa fa-fw fa-dashboard fa-2x"></i><span style="font-size: 150%">Dashboard</span></a>
      </li>

      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#postdropdown"><i class="fa fa-fw fa-cubes fa-2x"></i> <span style="font-size: 150%">Product</span> <i class="fa fa-fw fa-caret-right fa-2x"></i></a>
        <ul id="postdropdown" class="collapse">
          <li>
            <a href="./product.php?source=add-product"><span style="font-size: 150%"> Add New Product</span> </a>
          </li>
          <li>
            <a href="./product.php?source=view-all-products"><span style="font-size: 150%"> View All Product</span> </a>
          </li>

        </ul>
      </li>

      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#Customerdropdown"><i class="fa fa-users fa-2x"></i> <span style="font-size: 150%">Customers</span> <i class="fa fa-fw fa-caret-right fa-2x"></i></a>
        <ul id="Customerdropdown" class="collapse">
          <li>
            <a href="./customer.php?source=add-customer"><span style="font-size: 150%">Add New Customer</span></a>
          </li>
          <li>
            <a href="./customer.php?source=view-all-customers"><span style="font-size: 150%">View All Customers</span></a>
          </li>
        </ul>
      </li>

      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#Transactiondropdown"><i class="fa fa-dollar fa-2x"></i><span style="font-size: 150%"> Transactions</span><i class="fa fa-fw fa-caret-right fa-2x"></i></a>
        <ul id="Transactiondropdown" class="collapse">
          <li>
            <a href="./transaction.php?source=add-transaction"><span style="font-size: 150%">Add New Transaction</span> </a>
          </li>
          <li>
            <a href="./transaction.php?source=view-all-transactions"><span style="font-size: 150%"> View All Transactions </span> </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#Quotationdropdown"><i class="fa fa-file-text fa-2x"></i><span style="font-size: 150%"> Quotation</span><i class="fa fa-fw fa-caret-right fa-2x"></i></a>
        <ul id="Quotationdropdown" class="collapse">
          <li>
            <a href="./quotation.php?source=add-quotation"><span style="font-size: 150%"> Add New Quotation</span> </a>
          </li>
          <li>
            <a href="./quotation.php?source=view-all-quotations"><span style="font-size: 150%"> View All Quotations </span> </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#Notesdropdown"><i class="fa fa-fw fa-briefcase fa-2x"></i><span style="font-size: 150%"> Notes</span><i class="fa fa-fw fa-caret-right fa-2x"></i></a>
        <ul id="Notesdropdown" class="collapse">
          <li>
            <a href="./note.php?source=add-note"><span style="font-size: 150%">Add New Note</span> </a>
          </li>
          <li>
            <a href="./note.php?source=view-all-notes"><span style="font-size: 150%"> View All Notes </span> </a>
          </li>
        </ul>
      </li>
    </ul>

  </div>
  <!-- /.navbar-collapse -->
</nav>