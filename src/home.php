<?php
$title = 'Car Parts';
require 'includes/dbh.inc.php';
require 'includes/header.php';
include 'includes/alerts.php';

?>

<!-- SEARCH BAR -->
<div class="ftco-animate">
  <div class="col-md-6 search_bar">
    <div class="text-center header-search">
      <div class="form">
        <select class="input-select">
          <option value="all_companies">All Companies</option>
          <?php
          $sql = "SELECT * FROM companies";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
          } ?>

        </select>
        <input class="input input-search" id="search" type="text" placeholder="Search here...">
        <button type="submit" id="btn-search search_btn" class="btn-search search-btn">Search</button>
      </div>
    </div>
  </div>
</div>
<!-- /SEARCH BAR -->

<div class="ftco-animate">
  <div class="container page-content">
    <?php
    if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
      echo '<div class="user_type" style="display:none;">' . $_SESSION['user_type'] . '</div>';
      if ($_SESSION['user_type'] == 'customer') {
        echo '<div class="user_id" style="display:none;">' . $row_user['id'] . '</div>';
      }
    }else{
      echo '<div class="user_type" style="display:none;">visitor</div>';
    }
    ?>
    <div class="row replace-content">
      <?php
      $sql = "SELECT * FROM products";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['product_status'] == 'approved') { ?>
            <div class="col-md-3">
              <div class="item">
                <img src="<?= 'uploads/' . $row['product_image']; ?>" height="auto" width="100%" style="padding: 20px">
                <div class="item-content">
                  <p class="text-left product_name"><?php echo $row['product_name'] ?></p>
                  <p class="text-left prand_name">Prand: <?php echo $row['category_name'] ?></p>
                  <div class="item-detail">
                    <p class="text-left prand_price">Price: $<?php echo $row['product_price'] ?></p>
                    <p class="text-right prand_qty"><?php echo ($row['product_qty'] > 0) ? 'Qty: ' . $row['product_qty'] : '<span class="out-of-stock">OUT OF STOCK</span>'; ?></p>
                  </div>
                  <?php if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) : ?>
                    <?php if ($_SESSION['user_type'] == 'customer') : ?>
                      <button product_id="<?php echo $row['id'] ?>" class="add-to-cart-btn block2-btn-towishlist" onclick="addToCart(this.getAttribute('product_id'))"> add to cart</button>
                    <?php endif; ?>
                  <?php else: ?>
                      <button class="add-to-cart-btn block2-btn-towishlist" onclick="window.location.href = 'login.php?id=0';"> add to cart</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
      <?php
          }
        }
      } ?>
    </div>
  </div>
</div>
<?php
require 'includes/footer.php';
?>

<script type="text/javascript">
  $(document).ready(function() {

    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    // search
    $('.btn-search').on('click', function() {
      var input_select = $('.input-select').val();
      var input_search = $('.input-search').val();
      var user_type = $('.user_type').val();
      $.ajax({
        method: 'POST',
        cache: false,
        url: 'carparts_backend.php',
        dataType: "json",
        data: {
          input_select: input_select,
          input_search: input_search,
          user_type: user_type
        },
        success: function(data, status, xhr) {
          $('.replace-content').replaceWith(data.content);
        },
        error: function(error) {
          console.log(error.responseText);
        }
      });
    });
  });

  // add to cart
  function addToCart(product_id) {
    var user_id = $('.user_id').text();
    $.ajax({
      method: 'POST',
      cache: false,
      url: 'carparts_backend.php',
      dataType: "json",
      data: {
        user_id: user_id,
        product_id: product_id
      },
      success: function(data, status, xhr) {
        $('.replace-content').replaceWith(data.content);
        $('.cart-number').replaceWith('<span class="cart-number"><p>' + data.cart_count + '</p></span>');
      },
      error: function(error) {
        console.log(error.responseText);
      }
    });
  }
</script>
