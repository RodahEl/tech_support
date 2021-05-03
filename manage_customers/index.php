<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_customers';
    }
}

switch ($action) {
    case "list_customers":
        include('customer_list.php');
        break;

    case "search_customers":
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);

        // Validate inputs
        if ($last_name == null || $last_name == false) {
            $error = "Invalid customer last_name. Check last name field and try again.";
            include('../errors/error.php');
        } else {

            $customers = get_customers($last_name);
            include('customer_list.php');
        } 
        break;

    case "show_edit_form":
        // customer ID isset
        if (!isset($customer_id)) {
            $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
            if ($customer_id == NULL || $customer_id == FALSE) {
                echo "Something went wrong, customer_id missing";
                die();
            }
        }

        $customer = get_customer_by_id($customer_id);
        $countries = get_countries();
        include('customer_edit_form.php');  
        break;

    case "edit_customer":
        // Get the customer data
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $country_code = filter_input(INPUT_POST, 'country_code');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $customer_id = filter_input(INPUT_POST, 'customer_id');

        if ($first_name == NULL) {
            
            $first_name_error_message = 'First Name is required'; 

        } else if (strlen($first_name) > 51) {
            
            $first_name_error_message = 'Character length must be greater than 1 and less than 52'; 
        } 
        
        if ($last_name == NULL) {
            
            $last_name_error_message = 'Last Name is required'; 

        } else if (strlen($last_name) > 51) {
            
            $last_name_error_message = 'Character length must be greater than 1 and less than 52'; 
        }
        
        if ($address == NULL) {
            
            $address_error_message = 'Address is required'; 

        } else if (strlen($address) > 51) {
            
            $address_error_message = 'Character length must be greater than 1 and less than 52'; 
        }
        
        if ($city == NULL) {
            
            $city_error_message = 'City is required'; 

        } else if (strlen($city) > 51) {
            
            $city_error_message = 'Character length must be greater than 1 and less than 52'; 
        }
        
        if ($state == NULL) {
            
            $state_error_message = 'State is required'; 

        } else if (strlen($state) > 51) {
            
            $state_error_message = 'Character length must be greater than 1 and less than 52'; 
        }
        
        if ($email == NULL) {
            
            $email_error_message = 'Email is required'; 

        } else if (strlen($email) > 51) {
            
            $email_error_message = 'Character length must be greater than 1 and less than 52'; 
        
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $email_error_message = 'Invalid Email address';
        }
        
        if ($postal_code == NULL) {
            
            $postal_code_error_message = 'Postal Code is required'; 

        } else if (strlen($postal_code) > 21) {
            
            $postal_code_error_message = 'Number length must be greater than 1 and less than 22'; 
        }

        if ($password == NULL) {
            
            $password_error_message = 'Password is required'; 

        } else if (strlen($password) > 21 || strlen($password) < 6) {
            
            $password_error_message = 'Character length must be greater than 6 and less than 22'; 
        }


        if ($phone == NULL) {
            $phone_error_message = 'Phone is required'; 

        } else if (preg_match('/^\(\d{3}\)\s\d{3}-\d{4}/', $phone) == 0) {
            
            $phone_error_message = 'invalid Phone number format, should be (888) 888-8888'; 
        }

        // Validate inputs
        if ($first_name_error_message != '' || $last_name_error_message != '' || $address_error_message != '' || $city_error_message != ''
        || $state_error_message != '' || $email_error_message != '' || $postal_code_error_message != '' || $password_error_message != '' || $phone_error_message != '') {
            $countries = get_countries();
            // var_dump($first_name_error_message);
            // var_dump($last_name_error_message);
            // die();
            include('customer_edit_form_2.php');
        } else {

            // update the customer to the database 
            edit_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
            header("Location: index.php?action=list_customers");
            
        }  
        break;

    default:
        include('customer_list.php');
}

?>