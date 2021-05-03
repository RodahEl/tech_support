<?php
session_start();

require('../model/database.php');
require('../model/product_db.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'login_page';
    }
}

if ($action == 'login_page') {

    include('customer_login.php');

} else if ($action == 'login_customer') {

    if(isset($_SESSION['customer'])) {
        $email = $_SESSION['customer']['email'];
    }else {
        $email = filter_input(INPUT_POST, 'email');
    }

    // Validate inputs
    if ($email == null) {
        $error = "Empty email field. Enter email and try again.";
        include('../errors/error.php');
    } else {

        $email_exists = check_email($email);

        if($email_exists) {

            $customer = get_customer($email);
            $_SESSION['customer'] = $customer;
            $products = get_products();
            include('register_product.php');
        }else {
            
            $error = "Email does not exist. Try another email.";
            include('../errors/error.php');
        }
    } 

} else if ($action == 'register_product') {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $product_code = filter_input(INPUT_POST, 'product_code', FILTER_SANITIZE_STRING);

    // Validate inputs
    if ($product_code == null) {
        $error = "Invalid product. Select product and try again.";
        include('../errors/error.php');
    } else {

        register_product($email, $product_code);
        include('product_registered.php');
    } 

} else if ($action == 'logout') {

    $_SESSION['customer'] = "";
    session_destroy();
    session_write_close();
    header("Location: index.php?action=login_page");

}
?>