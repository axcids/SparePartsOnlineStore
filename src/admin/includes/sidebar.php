<?php
if($_SESSION['user_type'] == 'admin'){
  $title = 'Admin Control Panel';
}elseif($_SESSION['user_type'] == 'provider'){
  $title = 'Provider Control Panel';
}

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link"><span class="brand-text font-weight-light ml-3"><?php echo $title ?></span></a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link">
            <i class="fa fa-th" aria-hidden="true"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <?php if($_SESSION['user_type'] == 'admin'){ ?>
        <li class="nav-item">
          <a href="users.php" class="nav-link">
            <i class="fa fa-users" aria-hidden="true"></i>
            <p>Users</p>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="products.php" class="nav-link">
            <i class="fa fa-car" aria-hidden="true"></i>
            <p>Products</p>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a href="orders.php" class="nav-link">
            <i class="fa fa-archive" aria-hidden="true"></i>
            <p>Orders</p>
          </a>
        </li>
        <?php if($_SESSION['user_type'] == 'admin'){ ?>
        <li class="nav-item">
          <a href="messages.php" class="nav-link">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <p>Messages</p>
          </a>
        </li>
        <?php } ?>
        <!-- TO ADD MORE ITEMS, START HERE -->
      </ul>
    </nav>
  </div>
</aside>
