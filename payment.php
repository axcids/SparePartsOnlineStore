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
        <div class="col-md-12" style="padding-top: 20px;">
            <table class="table table-bordered small">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Prand</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Added date</th>
                        <th scope="col">Can be canceled before</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idpro = 1;
                    $sql = "SELECT * FROM tracking WHERE user_id='{$row_user['id']}'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr scope="row">
                                <th class="align-middle"><?php echo '<img style="width: 50px; height: 50px;" src="uploads/' . $row['product_image'] . '"/>' ?></th>
                                <th class="align-middle"><?php echo $row['product_name'] ?></th>
                                <td class="align-middle"><?php echo $row['product_prand'] ?></td>
                                <td class="align-middle"><?php echo $row['product_number'] ?></td>
                                <td class="align-middle"><?php echo $row['product_price'] ?></td>
                                <?php if ($row['product_status'] == 'true') { ?>
                                    <td class="align-middle">Delivered.</td>
                                <?php } else {
                                    $product_price += $row['product_price']; ?>
                                    <td class="align-middle">Delivery in progress.</td>
                                <?php } ?>
                                <td class="align-middle"><?php echo $row['added_date'] ?></td>
                                <td class="align-middle"><?php echo $row['exp_date'] ?></td>
                                <?php
                                date_default_timezone_set("Asia/Riyadh");
                                $date = date("d/m/Y h:iA");
                                if ($row['product_status'] == 'false' && $date < $row['exp_date']) { ?>
                                    <td class="align-middle"><button id="<?php echo $row['id'] ?>" product_id="<?php echo $row['product_id'] ?>" class="traking-cancel cancel add-to-cart-btn block2-btn-towishlist" onclick="cancel(this.getAttribute('id'), this.getAttribute('product_id'))">Cancel</button></td>
                                <?php } ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="payment">
    <div class="price">
        <p>Total payments $:<?php echo $product_price; ?></p>
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
    });

    // remove cart
    function cancel(id, product_id) {
        var user_id = $('.user_id').text();
        $.ajax({
            method: 'POST',
            cache: false,
            url: 'carparts_backend.php',
            dataType: "json",
            data: {
                cancel_id: id,
                cancel_user_id: user_id,
                cancel_product_id: product_id
            },
            success: function(data, status, xhr) {
                $('.replace-content').replaceWith(data.content);
                $('.payment .price').replaceWith('<div class="price"><p>Total payments: $' + data.product_price + '</p></div>');
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }
</script>
