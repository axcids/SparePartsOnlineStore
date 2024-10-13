<?php
if ($_SESSION['user_type'] != 'admin') {
    $_SESSION['danger_message'] = "You can't access this page";
    header("location:home.php");
}
if (isset($_POST['input_select']) && isset($_POST['input_search'])) {
    require 'includes/dbh.inc.php';
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        $content = '<div class="row replace-content">';
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_status'] == 'approved' && str_contains($row['product_name'], $_POST['input_search'])) {
                if ($_POST['input_select'] == 'all_companies') {
                    $content .= '
                <div class="col-md-3">
                    <div class="item">
                        <img src="uploads/' . $row['product_image'] . '" height="200px" width="100%">
                        <div class="item-content">
                            <p class="text-left"><b>Product Name:</b> ' . $row['product_name'] . '</p>
                            <p class="text-left"><b>Prand Name:</b> ' . $row['category_name'] . '</p>
                            <div class="item-detail">
                                <p class="text-left"><b>Price:</b> ' . $row['product_price'] . '</p>
                                <p class="text-right"><b>Qty:</b> ' . $row['product_qty'] . '</p>
                            </div>
                            <button product_id="' . $row['id'] . '" class="add-to-cart-btn block2-btn-towishlist" onclick="addToCart(this.getAttribute(\'product_id\'))"> add to cart</button>
                        </div>
                    </div>
                </div>
                ';
                } else if ($_POST['input_select'] == $row['category_name']) {
                    $content .= '
                    <div class="col-md-3">
                        <div class="item">
                            <img src="uploads/' . $row['product_image'] . '" height="200px" width="100%">
                            <div class="item-content">
                                <p class="text-left"><b>Product Name:</b> ' . $row['product_name'] . '</p>
                                <p class="text-left"><b>Prand Name:</b> ' . $row['category_name'] . '</p>
                                <div class="item-detail">
                                    <p class="text-left"><b>Price:</b> ' . $row['product_price'] . '</p>
                                    <p class="text-right"><b>Qty:</b> ' . $row['product_qty'] . '</p>
                                </div>
                                <button product_id="' . $row['id'] . '" class="add-to-cart-btn block2-btn-towishlist" onclick="addToCart(this.getAttribute(\'product_id\'))"> add to cart</button>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        }
        $content .= '</div>';
        if ($content == '<div class="row replace-content"></div>') {
            echo json_encode(array('content' => '<div class="row replace-content" style="display: block;"><center><p style="color: #000000;">Product not Found.</p></center></div>'));
        } else {
            echo json_encode(array('content' => $content));
        }
    }
}
