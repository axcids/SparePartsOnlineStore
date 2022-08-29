<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';
require 'dashboard.php';
?>
<div class="content-wrapper pt-3">
    <?php if($_SESSION['user_type'] == 'provider'){ ?>
      <div class="content-header">
      <h3>Dashboard</h3>
      <hr>
    </div>
      <div class="content">
        <div class="container-fluid">
          <!-- end row -->
          <div class="row">
            <div class="col-xl-4">
              <div class="card-box ribbon-box">
                <div class="ribbon ribbon-primary">Customers Bought from you</div>
                <div class="clearfix"></div>
                <div class="inbox-widget">
                  <?php foreach($customers as $customer){ ?>
                    <a href="#">
                      <div class="inbox-item">
                        <h5 class="inbox-item-author"><?php echo $customer['username'] ?></h5>
                        <p class="inbox-item-text"><?php echo $customer['email'] ?></p>
                        <p class="inbox-item-text"><?php echo $customer['mobile'] ?></p>
                      </div>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="row">
                <div class="col-sm-4">
                  <div class="card-box tilebox-one"><i class="icon-layers float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Total Number Of Orders</h6>
                    <h2 class="" data-plugin="counterup"><?php echo $numberOfOrders['total'] ?></h2>
                    <span class="text-muted">Delivered + in processs</span>
                  </div>
                  </div>
                  <!-- end col -->
                  <div class="col-sm-4">
                    <div class="card-box tilebox-one"><i class="icon-paypal float-right text-muted"></i>
                      <h6 class="text-muted text-uppercase mt-0">Total Revenue</h6>
                      <h2 class="">
                        $
                        <span data-plugin="counterup"><?php echo $totalRevenue['revenue'] ?></span>
                      </h2>
                      <span class="text-muted">This amount includes the website share</span>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-sm-4">
                    <div class="card-box tilebox-one"><i class="icon-rocket float-right text-muted"></i>
                      <h6 class="text-muted text-uppercase mt-0">Total Number of Products</h6>
                      <h2 class="" data-plugin="counterup"><?php echo $numberOfProducts['total_products'] ?></h2>
                      <span class="text-muted">Refers to products offered by this user only</span>
                    </div>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
                <div class="card-box">
                  <h4 class="header-title mb-3">Recent Orders</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tracking Number</th>
                          <th>Product Name</th>
                          <th>Customer Name</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; foreach($recentOrders as $order){ ?>
                        <tr>
                          <td><?php echo $i; $i++; ?></td>
                          <td><?php echo $order['tracking_number'] ?></td>
                          <td><?php echo $order['product_name'] ?></td>
                          <td><?php echo $order['username'] ?></td>
                          <td><?php echo $order['added_date'] ?></td>
                          <td><?php
                            if($order['product_status'] == 'true'){
                              echo 'Delivered';
                            }else{
                              echo 'Processing';
                            }
                          ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- container -->
        </div>
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        <?php }else if ($_SESSION['user_type'] == 'admin'){ ?>
          <div class="content-header">
          <h3>Dashboard</h3>
          <hr>
        </div>
          <div class="content">
            <div class="container-fluid">
              <!-- end row -->
              <div class="row">
                <div class="col-xl-4">
                  <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-primary">Visitors Messages</div>
                    <div class="clearfix"></div>
                    <div class="inbox-widget">
                      <?php foreach($visitorsMessages as $message){ ?>
                        <a href="#">
                          <div class="inbox-item">
                            <h5 class="inbox-item-author"><?php echo $message['sender'] ?></h5>
                            <p class="inbox-item-text">Email: <?php echo $message['email'] ?></p>
                            <p class="inbox-item-text">Title: <?php echo $message['title'] ?></p>
                            <br>
                            <p class="inbox-item-text"><?php echo $message['content'] ?></p>
                          </div>
                          <hr>
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="card-box tilebox-one"><i class="icon-layers float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Total Number Of Orders</h6>
                        <h2 class="" data-plugin="counterup"><?php echo $allOrders['total'] ?></h2>
                        <span class="text-muted">Delivered + in processs</span>
                      </div>
                      </div>
                      <!-- end col -->
                      <div class="col-sm-4">
                        <div class="card-box tilebox-one"><i class="icon-paypal float-right text-muted"></i>
                          <h6 class="text-muted text-uppercase mt-0">Total Revenue</h6>
                          <h2 class="">
                            $
                            <span data-plugin="counterup"><?php echo $Revenue['revenue'] ?></span>
                          </h2>
                          <span class="text-muted">This amount includes the website share</span>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-sm-4">
                        <div class="card-box tilebox-one"><i class="icon-rocket float-right text-muted"></i>
                          <h6 class="text-muted text-uppercase mt-0">Total Number of Products</h6>
                          <h2 class="" data-plugin="counterup"><?php echo $allProducts['total_products'] ?></h2>
                          <span class="text-muted">Refers to products offered by this user only</span>
                        </div>
                      </div>
                      <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="card-box">
                      <h4 class="header-title mb-3">Recent Orders</h4>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Tracking Number</th>
                              <th>Product Name</th>
                              <th>Customer Name</th>
                              <th>Provider Name</th>
                              <th>Date</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; foreach($adminOrderView as $order){ ?>
                            <tr>
                              <td><?php echo $i; $i++; ?></td>
                              <td><?php echo $order['tracking_number'] ?></td>
                              <td><?php echo $order['product_name'] ?></td>
                              <td><?php echo $order['username'] ?></td>
                              <td><?php echo $order['created_by'] ?></td>
                              <td><?php echo $order['added_date'] ?></td>
                              <td><?php
                                if($order['product_status'] == 'true'){
                                  echo 'Delivered';
                                }else{
                                  echo 'Processing';
                                }
                              ?></td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
              </div>
              <!-- container -->
            </div>
        <?php } ?>
      </div>
<?php
require 'includes/footer.php';
