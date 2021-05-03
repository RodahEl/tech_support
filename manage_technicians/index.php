<?php
// require('../model/database.php');
// require('../model/technician_db.php');
require('../model/database_oo.php');
require('../model/technician.php');
require('../model/technician_db_oo.php');

// $database = new Database();
// $technician = new Technician();
$technician_db = new TechnicianDB();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_technicians';
    }
}

switch ($action) {

    case "list_technicians":
        
        $technicians = $technician_db->get_technicians();
        include('technician_list.php');
        break;

    case "delete_technician":
        $technician_id = filter_input(INPUT_POST, 'techID', FILTER_SANITIZE_STRING);

        if ($technician_id == NULL || $technician_id == FALSE) {
            $error = "Missing or incorrect technician id";
            include('../errors/error.php');
        } else { 
            $technician_db->delete_technician($technician_id);
            header("Location: index.php?action=list_technicians");
        }
        break;

    case "show_add_form":

        include('technician_add.php');
        break;

    case "add_technician":
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');
        if ($first_name == NULL || $last_name == NULL || $email == NULL || $phone == NULL || $password == NULL) {
            $error = "Invalid technician data. Check all fields and try again.";
            include('../errors/error.php');
        } else { 
            $technician_db->add_technician($first_name, $last_name, $email, $phone, $password);
            header("Location: index.php?action=list_technicians");
        }
        break;

    default:
        include('technician_list.php');
}

?>