<?php
require 'includes/database.php';
// User info from the session
$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];
// Customers Bought from you
$customers = $conn->query("select DISTINCT users.username, users.email, users.mobile from users
                        inner join tracking on users.id = tracking.user_id
                        inner join products on products.product_name = tracking.product_name
                        where products.created_by = '$username'")->fetch_all(MYSQLI_ASSOC);
// Total number of orders
$numberOfOrders = $conn->query("select count(*) as total from tracking
                                inner join products on tracking.product_name = products.product_name
                                where created_by = '$username'")->fetch_assoc();
//Total Revenue
$totalRevenue = $conn->query("select tracking.product_price as revenue from tracking
                      inner join products on tracking.product_name = products.product_name
                      where products.created_by = '$username'")->fetch_assoc();
// Total number of products
$numberOfProducts = $conn->query("select count(id) as total_products from products where created_by = '$username'")->fetch_assoc();
// // website share of revenue
// $websiteShare = ($totalRevenue['revenue'] / 100 ) * 10;
//recent orders
$recentOrders = $conn->query("select tracking.tracking_number, tracking.product_name, users.username, tracking.added_date, tracking.product_status  from tracking
                        inner join users on tracking.user_id = users.id
                        inner join products on tracking.product_name = products.product_name
                        where created_by = '$username' order by tracking.added_date desc limit 5")->fetch_all(MYSQLI_ASSOC);
//Visitors Messages
$visitorsMessages = $conn->query("select * from messages where status = 'No answer'")->fetch_all(MYSQLI_ASSOC);
// Total number of orders (admin)
$allOrders = $conn->query("select count(id) as total from tracking")->fetch_assoc();
//Total Revenue (admin)
$Revenue = $conn->query("select sum(tracking.product_price) as revenue from tracking")->fetch_assoc();
// Total number of products (admin)
$allProducts = $conn->query("select count(id) as total_products from products")->fetch_assoc();
//recent orders (admin)
$adminOrderView = $conn->query("select tracking.tracking_number, tracking.product_name, users.username, products.created_by, tracking.added_date, tracking.product_status  from tracking
                                inner join users on tracking.user_id = users.id
                                inner join products on tracking.product_name = products.product_name
                                order by tracking.added_date desc limit 5")->fetch_all(MYSQLI_ASSOC);
