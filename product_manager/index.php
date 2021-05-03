<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

switch ($action) {

    case "list_products":
        $products = get_products();
        include('product_list.php');
        break;

    case "delete_product":
        $product_code = filter_input(INPUT_POST, 'productCode', FILTER_SANITIZE_STRING);

        if ($product_code == NULL || $product_code == FALSE) {
            $error = "Missing or incorrect product Code";
            include('../errors/error.php');
        } else { 
            delete_product($product_code);
            header("Location: index.php?action=list_products");
        }
        break;

    case "show_add_form":

        include('product_add.php');  
        break;

    case "add_product":
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version');
        $release_date = filter_input(INPUT_POST, 'release_date');
        if ($code == NULL || $name == NULL || $version == NULL || $release_date == NULL) {
            $error = "Invalid product data. Check all fields and try again.";
            include('../errors/error.php');
        } else {
            
            if(validateDate($release_date, 'm/d/Y') == false) {
                $error = "Invalid release date format. Accepted format is MM/DD/YYYY.";
                include('../errors/error.php');
            }else {

                $newDate = date("Y-m-d", strtotime($release_date));
                add_product($code, $name, $version, $newDate);
                header("Location: index.php?action=list_products");
            }
        }
        break;

    default:
        include('product_list.php');
}


function validateDate($date, $format = 'm/d/Y'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>