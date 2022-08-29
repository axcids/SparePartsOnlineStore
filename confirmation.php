<?php
$title = 'Confirmation';
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


<div class="con-content">
                <span class="con-title">Payment method:</span>
    <label for="myCheck">
        <input class="con-checkbox" id="myCheck" type="checkbox" name="checkbox" value="value" />
        <div>
            <div>
                <img class="con-icon" src="images/money.jpg" />
                <span class="con-title">Paiement when recieving.</span>
            </div>
            <div>
                <span class="con-description">Cash on Delivery is the payment method we offer to our customers in Saudi Arabia.</span>
            </div>
        </div>
    </label>
</div>

<button class="submission add-to-cart-btn block2-btn-towishlist" onclick="submission()">Submission</button>

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
        if ($('#myCheck').is(":checked")) {
            window.location.href = 'confirmation-order.php';
        } else {
            alert("Please indicate the payment method.");
        }
    }
</script>