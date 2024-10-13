<?php
require 'includes/dbh.inc.php';
if (isset($_POST['input_select']) && isset($_POST['input_search']) && isset($_POST['user_type'])) {
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $content = '<div class="row replace-content">';
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_status'] == 'approved' && str_contains($row['product_name'], $_POST['input_search'])) {
                $prand_qty = '';
                $display = '';
                $display2 = 'display-none';
                if ($row['product_qty'] > 0) {
                    $prand_qty = 'Qty: ' . $row['product_qty'];
                } else {
                    $prand_qty = '<span class="out-of-stock">OUT OF STOCK</span>';
                }
                if ($_POST['user_type'] != 'customer') {
                    $display = 'display-none';
                }
                if ($_POST['user_type'] != 'visitor') {
                    $display2 = '';
                }
                if ($_POST['input_select'] == 'all_companies') {
                    $content .= '
                <div class="col-md-3">
                    <div class="item">
                        <img src="uploads/' . $row['product_image'] . '" height="auto" width="100%" style="padding: 20px">
                        <div class="item-content">
                        <p class="text-left product_name">' . $row['product_name'] . '</p>
                        <p class="text-left prand_name">Prand: ' . $row['category_name'] . '</p>
                        <div class="item-detail">
                          <p class="text-left prand_price">Price: $' . $row['product_price'] . '</p>
                          <p class="text-right prand_qty">' . $prand_qty . '</p>
                        </div>
                            <button product_id="' . $row['id'] . '" class="add-to-cart-btn block2-btn-towishlist ' . $display . '" onclick="addToCart(this.getAttribute(\'product_id\'))"> add to cart</button>
                            <button class="add-to-cart-btn block2-btn-towishlist ' . $display2 . '" onclick="window.location.href = \'register.php\';"> add to cart</button>
                        </div>
                    </div>
                </div>
                ';
                } else if ($_POST['input_select'] == $row['category_name']) {
                    $content .= '
                    <div class="col-md-3">
                        <div class="item">
                            <img src="uploads/' . $row['product_image'] . '" height="auto" width="100%" style="padding: 20px">
                            <div class="item-content">
                                <p class="text-left product_name">' . $row['product_name'] . '</p>
                                <p class="text-left prand_name">Prand: ' . $row['category_name'] . '</p>
                                <div class="item-detail">
                                    <p class="text-left prand_price">Price: $' . $row['product_price'] . '</p>
                                    <p class="text-right prand_qty">' . $prand_qty . '</p>
                                </div>
                                <button product_id="' . $row['id'] . '" class="add-to-cart-btn block2-btn-towishlist ' . $display . '" onclick="addToCart(this.getAttribute(\'product_id\'))"> add to cart</button>
                                <button class="add-to-cart-btn block2-btn-towishlist ' . $display2 . '" onclick="window.location.href = \'register.php\';"> add to cart</button>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        }
        $content .= '</div>';
        if ($content == '<div class="row replace-content"></div>') {
            echo json_encode(array('content' => '<div class="row replace-content"><center><p style="color: #000000;">Cart is empty.</p></center></div>'));
        } else {
            echo json_encode(array('content' => $content));
        }
    }
}


if (isset($_POST['user_id']) && isset($_POST['product_id'])) {
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['product_id']}' LIMIT 0,1");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['product_qty'] > 0) {

            $update_query = mysqli_query(
                $conn,
                "UPDATE products SET product_qty='" . ($row['product_qty'] - 1) . "'
            WHERE id='{$_POST['product_id']}'"
            ) or die();

            $result2 = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='{$_POST['user_id']}' AND id='{$_POST['product_id']}'");
            date_default_timezone_set("Asia/Riyadh");
            $added_date = date("d/m/Y h:iA");
            $exp_date = date('d/m/Y h:iA', strtotime('+5 minutes'));

            if (mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $product_number = $row2['product_number'] + 1;
                $product_price = $row2['product_price'];
                $product_price += $row['product_price'];
                $update_query2 = mysqli_query(
                    $conn,
                    "UPDATE cart SET product_number='{$product_number}', product_price='{$product_price}' ,
                    added_date='{$added_date}' , exp_date='{$exp_date}'
                WHERE id='{$_POST['product_id']}'"
                );
            } else {
                $add_query = mysqli_query(
                    $conn,
                    "INSERT INTO `cart` (`id`,`user_id`,`product_image`,`product_name`,`product_number`, `category_name`,`product_price`,`added_date`,`exp_date`)
                VALUES ('{$row['id']}', '{$_POST['user_id']}', '{$row['product_image']}', '{$row['product_name']}', '1','{$row['category_name']}', '{$row['product_price']}', '{$added_date}', '{$exp_date}')"
                ) or die();
            }

            fech_product($conn, $_POST['user_id']);
        }
    }
}


function fech_product($conn, $user_id)
{
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $content = '<div class="row replace-content">';
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_status'] == 'approved') {
                $prand_qty = '';
                if ($row['product_qty'] > 0) {
                    $prand_qty = 'Qty: ' . $row['product_qty'];
                } else {
                    $prand_qty = '<span class="out-of-stock">OUT OF STOCK</span>';
                }
                $content .= '
                <div class="col-md-3">
                    <div class="item">
                        <img src="uploads/' . $row['product_image'] . '" height="auto" width="100%" style="padding: 20px">
                        <div class="item-content">
                                <p class="text-left product_name">' . $row['product_name'] . '</p>
                                <p class="text-left prand_name">Prand: ' . $row['category_name'] . '</p>
                                <div class="item-detail">
                                    <p class="text-left prand_price">Price: $' . $row['product_price'] . '</p>
                                    <p class="text-right prand_qty">' . $prand_qty . '</p>
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

    $cart_count = 0;
    $result = mysqli_query($conn, "SELECT * FROM cart");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($user_id == $row['user_id']) {
                $cart_count++;
            }
        }
    }


    if ($content == '<div class="row replace-content"></div>') {
        echo json_encode(array('content' => '<div class="row replace-content"><center><p style="color: #000000;">Cart is empty.</p></center></div>', 'cart_count' => $cart_count));
    } else {
        echo json_encode(array('content' => $content, 'cart_count' => $cart_count));
    }
}

if (isset($_POST['delete_user_id']) && isset($_POST['delete_product_id'])) {

    date_default_timezone_set("Asia/Riyadh");
    $date = date("d/m/Y h:iA");
    $result = mysqli_query($conn, "SELECT * FROM cart");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($date > $row['exp_date']) {
                $result_x = mysqli_query($conn, "SELECT * FROM products WHERE id='{$row['id']}' LIMIT 0,1");
                $delete_x = mysqli_query($conn, "DELETE FROM cart WHERE id='{$row['id']}' AND user_id='{$row['user_id']}'");
                if (mysqli_num_rows($result_x) > 0) {
                    $row_products = mysqli_fetch_assoc($result_x);
                    if ($row_products['product_qty'] >= 0) {
                        $update_x = mysqli_query(
                            $conn,
                            "UPDATE products SET product_qty='" . ($row_products['product_qty'] + $row['product_number']) . "'
                        WHERE id='{$row['id']}'"
                        ) or die();
                    }
                }
            }
        }
    }

    $result_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='{$_POST['delete_user_id']}' AND id='{$_POST['delete_product_id']}'");
    $result_products = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['delete_product_id']}' LIMIT 0,1");
    $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE user_id='{$_POST['delete_user_id']}' AND id='{$_POST['delete_product_id']}'");
    if (mysqli_num_rows($result_cart) > 0 && mysqli_num_rows($result_products) > 0) {
        $row_cart = mysqli_fetch_assoc($result_cart);
        $row_products = mysqli_fetch_assoc($result_products);
        if ($row_products['product_qty'] >= 0) {
            $update_query = mysqli_query(
                $conn,
                "UPDATE products SET product_qty='" . ($row_products['product_qty'] + $row_cart['product_number']) . "'
                WHERE id='{$_POST['delete_product_id']}'"
            ) or die();
            if ($delete_query && $update_query) {
                fech_cart($conn, $_POST['delete_user_id']);
            }
        }
    }
}

function fech_cart($conn, $user_id)
{
    $result = mysqli_query($conn, "SELECT * FROM cart");
    $resultCheck = mysqli_num_rows($result);
    $content = '<div class="row replace-content">';
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content .= '
                <div class="col-md-3">
                <div class="item">
                    <img src="uploads/' . $row['product_image'] . '" height="auto" width="100%" style="padding: 20px">
                    <div class="item-content">
                        <p class="text-left product_name"> ' . $row['product_name'] . '</p>
                        <p class="text-left"><b>Qty:</b> ' . $row['product_number'] . ' </p>
                        <p class="text-left"><b>Prand:</b> ' . $row['category_name'] . '</p>
                        <div class="item-detail">
                            <p class="text-left"><b>Price:</b> ' . $row['product_price'] . '</p>
                        </div>
                        <button product_id="' . $row['id'] . '" class="add-to-cart-btn block2-btn-towishlist" onclick="addToCart(this.getAttribute(\'product_id\'))"> remove product</button>
                    </div>
                </div>
                </div>
                ';
        }
    }
    $content .= '</div>';

    $cart_count = 0;
    $result = mysqli_query($conn, "SELECT * FROM cart");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($user_id == $row['user_id']) {
                $cart_count++;
            }
        }
    }

    $product_price = 0;
    $result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='{$user_id}'");
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_price += $row['product_price'];
        }
    }

    if ($content == '<div class="row replace-content"></div>') {
        echo json_encode(array('content' => '<div class="row replace-content"><center><p style="color: #000000;">Cart is empty.</p></center></div>', 'cart_count' => $cart_count, 'product_price' => $product_price));
    } else {
        echo json_encode(array('content' => $content, 'cart_count' => $cart_count, 'product_price' => $product_price));
    }
}


if (isset($_POST['confirmation_user_id'])) {
    $result = mysqli_query($conn, "SELECT * FROM cart");
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        date_default_timezone_set("Asia/Riyadh");
        $added_date = date("d/m/Y h:iA");
        $exp_date = date('d/m/Y h:iA', strtotime('+5 minutes'));
        while ($row = mysqli_fetch_assoc($result)) {
            if ($_POST['confirmation_user_id'] == $row['user_id']) {
                $rowtracking_number = rand(1111111111, 9999999999);
                $add_query = mysqli_query(
                    $conn,
                    "INSERT INTO `tracking` (`user_id`,`product_id`,`product_name`,`product_image`,`product_prand`, `product_price`,`product_number`,`product_status`,`tracking_number`,`added_date`,`exp_date`)
                    VALUES ('{$_POST['confirmation_user_id']}', '{$row['id']}', '{$row['product_name']}', '{$row['product_image']}', '{$row['category_name']}', '{$row['product_price']}', '{$row['product_number']}', 'false', '{$rowtracking_number}', '{$added_date}', '{$exp_date}')"
                ) or die();
                $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE user_id='{$row['user_id']}' AND id='{$row['id']}'");
            }
        }
    }

    fech_cart($conn, $_POST['confirmation_user_id']);
}


if (isset($_POST['cancel_id']) && isset($_POST['cancel_user_id']) && isset($_POST['cancel_product_id'])) {
    $result_exp = mysqli_query($conn, "SELECT * FROM tracking WHERE id='{$_POST['cancel_id']}' LIMIT 0,1");
    if (mysqli_num_rows($result_exp) > 0) {
        $row = mysqli_fetch_assoc($result_exp);
        date_default_timezone_set("Asia/Riyadh");
        $date = date("d/m/Y h:iA");
        if ($date < $row['exp_date']) {

            $result_tracking = mysqli_query($conn, "SELECT * FROM tracking WHERE id='{$_POST['cancel_id']}' AND user_id='{$_POST['cancel_user_id']}' AND product_id='{$_POST['cancel_product_id']}'");
            $result_products = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['cancel_product_id']}' LIMIT 0,1");
            $delete_query = mysqli_query($conn, "DELETE FROM tracking WHERE id='{$_POST['cancel_id']}' AND user_id='{$_POST['cancel_user_id']}' AND product_id='{$_POST['cancel_product_id']}'");
            if (mysqli_num_rows($result_tracking) > 0 && mysqli_num_rows($result_products) > 0) {
                $row_tracking = mysqli_fetch_assoc($result_tracking);
                $row_products = mysqli_fetch_assoc($result_products);
                if ($row_products['product_qty'] >= 0) {
                    $update_query = mysqli_query(
                        $conn,
                        "UPDATE products SET product_qty='" . ($row_products['product_qty'] + $row_tracking['product_number']) . "'
                WHERE id='{$_POST['cancel_product_id']}'"
                    ) or die();
                }
            }
        }
    }
    fech_tracking($conn, $_POST['cancel_user_id']);
}

function fech_tracking($conn, $user_id)
{
    $result = mysqli_query($conn, "SELECT * FROM tracking WHERE user_id='{$user_id}'");
    $resultCheck = mysqli_num_rows($result);
    $content = '<div class="row replace-content">
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
                        <tbody>';
    $product_status = '';
    if ($resultCheck > 0) {
        date_default_timezone_set("Asia/Riyadh");
        $date = date("d/m/Y h:iA");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_status'] == 'true') {
                $product_status = 'Delivered.';
                $traking_hide = 'traking-hide';
            } else {
                $product_status = 'Delivery in progress.';
                $traking_hide = '';
            }
            if ($date < $row['exp_date']) {
                $button = '<td class="align-middle"><button id="' . $row['id'] . '" product_id="' . $row['product_id'] . '" class="' . $traking_hide . ' traking-cancel cancel add-to-cart-btn block2-btn-towishlist" onclick="cancel(this.getAttribute(\'id\'), this.getAttribute(\'product_id\'))">Cancel</button></td>';
            } else {
                $button = '';
            }
            $content .= '
                        <tr scope="row">
                        <th class="align-middle"><img style="width: 50px; height: 50px;" src="uploads/' . $row['product_image'] . '"/></th>
                            <th class="align-middle">' . $row['product_name'] . '</th>
                            <td class="align-middle">' . $row['product_prand'] . '</td>
                            <td class="align-middle">' . $row['product_number'] . '</td>
                            <td class="align-middle">' . $row['product_price'] . '</td>
                            <td class="align-middle">' . $product_status . '.</td>
                            <td class="align-middle">' . $row['added_date'] . '</td>
                            <td class="align-middle">' . $row['exp_date'] . '</td>
                            ' . $button . '
                        </tr>
                        ';
        }
    }
    $content .= '
                            </tbody>
                        </table>
                    </div>
                </div>';


    $product_price = 0;
    $result = mysqli_query($conn, "SELECT * FROM  tracking WHERE user_id='{$user_id}'");
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_status'] == 'false') {
                $product_price += $row['product_price'];
            }
        }
    }

    echo json_encode(array('content' => $content, 'product_price' => $product_price));
}



mysqli_close($conn);
