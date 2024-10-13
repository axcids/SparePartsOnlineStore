<?php
$title = 'Car Parts';
require 'includes/dbh.inc.php';
require 'includes/header.php';

if ($_SESSION['username'] == NULL) {
    $_SESSION['danger_message'] = "You can't access this page";
    header("location:home.php");
} else if ($_SESSION['user_type'] != 'customer') {
    header("location:home.php");
}

$product_price = 0;
?>

<div class="container page-content">
    <?php
    if ($_SESSION['user_type'] == 'customer') {
        echo '<div class="user_id" style="display:none;">' . $row_user['id'] . '</div>';
    }
    ?>
    <div class="row replace-content">
        <?php
        $idpro = 1;
        $sql = "SELECT * FROM cart WHERE user_id='{$row_user['id']}'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_price += $row['product_price'] ?>
                <div class="col-md-3">
                    <div class="item">
                        <img src="<?= 'uploads/' . $row['product_image']; ?>" height="auto" width="100%" style="padding: 20px">
                        <div class="item-content">
                            <p class="text-left product_name"><?php echo $row['product_name'] ?></p>
                            <p class="text-left"><b>Qty: </b><?php echo $row['product_number'] ?></p>
                            <p class="text-left"><b>Prand: </b><?php echo $row['category_name'] ?></p>
                            <div class="item-detail">
                                <p class="text-left"><b>Price: $</b><?php echo $row['product_price'] ?></p>
                            </div>
                            <p class="text-left"><b>Added in: </b><?php echo $row['added_date'] ?></p>
                            <p class="text-left"><b>Expired in: </b><?php echo $row['exp_date'] ?></p>
                                <button product_id="<?php echo $row['id'] ?>" class="add-to-cart-btn block2-btn-towishlist" onclick="addToCart(this.getAttribute('product_id'))"> remove product</button>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else { ?>
            <p style="color: #000000;">Cart is empty.</p>
        <?php } ?>
    </div>
</div>
<div class="payment">
    <div class="price">
        <p>Total payments $:<span><?php echo $product_price; ?></span></p>
    </div>
    <button class="add-to-cart-btn block2-btn-towishlist" onclick="confirmation()">Confirmation</button>
    <button class="add-to-cart-btn block2-btn-towishlist tracking" onclick="tracking()">Tracking</button>
</div>
<?php
require 'includes/footer.php';
?>

<script type="text/javascript">
    $(document).ready(function() {

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });

    function confirmation() {
        if ($('.payment > .price > p > span').text() != '0') {
            window.location.href = 'confirmation.php';
        } else {
            alert("Your cart is empty!!");
        }
    }

    function tracking() {
        window.location.href = 'payment.php';
    }

    // remove cart
    function addToCart(product_id) {
        var user_id = $('.user_id').text();
        $.ajax({
            method: 'POST',
            cache: false,
            url: 'carparts_backend.php',
            dataType: "json",
            data: {
                delete_user_id: user_id,
                delete_product_id: product_id
            },
            success: function(data, status, xhr) {
                $('.replace-content').replaceWith(data.content);
                $('.cart-number').replaceWith('<span class="cart-number"><p>' + data.cart_count + '</p></span>');
                $('.payment .price').replaceWith('<div class="price"><p>Total payments: $' + data.product_price + '</p></div>');
                if (data.product_price <= 0) {
                    location.reload();
                }
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }
</script>
