<?php
$title = 'Confirmation Order';
require 'includes/dbh.inc.php';
require 'includes/header.php';

if ($_SESSION['username'] == NULL) {
    header("location:home.php");
} else if ($_SESSION['user_type'] != 'customer') {
    header("location:home.php");
}

if ($_SESSION['user_type'] == 'customer') {
    echo '<div class="user_id" style="display:none;">' . $row_user['id'] . '</div>';
}
?>

<div class="tracking-content">
    <img class="tracking-icon" src="images/pay-successed.png" />
    <div class="tracking-title">Order confirmed successfully</div>
    <div class="tracking-description">We will deliver your order as soon as possible, please prepare the payment and wait for the delivery. After confirming the order, you still have time to cancel, if you want to cancel the order, log on to traking within 3 hours.</div>
</div>

<button class="submission add-to-cart-btn block2-btn-towishlist" onclick="submission()">Tracking</button>

<?php
require 'includes/footer.php';
?>

<script type="text/javascript">
    $(document).ready(function() {

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });

    function submission() {
        var user_id = $('.user_id').text();
        $.ajax({
            method: 'POST',
            cache: false,
            url: 'carparts_backend.php',
            dataType: "json",
            data: {
                confirmation_user_id: user_id
            },
            success: function(data, status, xhr) {
                window.location.href = 'payment.php';
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }
</script>