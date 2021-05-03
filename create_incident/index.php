<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/customer_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'get_customer';
    }
}

switch ($action) {
    case "get_customer":
        include('get_customer.php');
        break;

    case "get_customer_form":
        $email = filter_input(INPUT_POST, 'email');

        // Validate inputs
        if ($email == null) {
            $error = "Empty email field. Enter email and try again.";
            include('../errors/error.php');
        } else {
    
            $email_exists = check_email($email);
            if($email_exists) {
    
                $customer = get_customer($email);
                $products = get_registered_products($customer);
                include('create_incident.php');
            }else {
                
                $error = "Email does not exist. Try another email.";
                include('../errors/error.php');
            }
        } 
        break;

    case "register_incident":
        $customer_id = filter_input(INPUT_POST, 'customer_id');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $product_code = filter_input(INPUT_POST, 'product_code');
    
        // Validate inputs
        if ($title == null || $description == null) {
            $error = "Invalid incident data. Check all fields and try again.";
            include('../errors/error.php');
        } else {
    
            register_incident($customer_id, $title, $description, $product_code);
            include('incident_registered.php');
        } 
        break;

    default:
        include('get_customer.php');
}

?>