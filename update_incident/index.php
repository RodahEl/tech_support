<?php
session_start();

require('../model/database.php');
require('../model/incident_db.php');
require('../model/product_db.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'update_incident';
    }
}

if ($action == 'update_incident') {

    $incidents = get_opened_incidents();
    include('update_incident.php');
     
} else if ($action == 'update_incident_form') {

    $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
    $date_closed = filter_input(INPUT_POST, 'date_closed');

    // Validate inputs
    if ($incident_id == null || $date_closed == null) {
        $error = "Form data incomplete. Fill all the fields and try again.";
        include('../errors/error.php');
    } else {

        if(validateDate($date_closed, 'm/d/Y') == false) {
            $error = "Invalid Closed Date format. Accepted format is MM/DD/YYYY.";
            include('../errors/error.php');
        }else {
            $newDate = date("Y-m-d", strtotime($date_closed));
            update_incident($incident_id, $newDate);
            include('incident_updated.php');
        }
    } 
}

function validateDate($date, $format = 'm/d/Y'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>