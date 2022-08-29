 <!-- this is for topbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../home.php" class="nav-link">Spareparts</a>
    </li>
    <?php
    if($_SESSION['user_type'] == 'admin'){ ?>
      <li>
        
      </li>
    <?php } ?>
    <li>
      <a class="nav-link" href="../logout.php" role="button">Logout</a>
    </li>
  </ul>
</nav>
  <!-- /.navbar -->
