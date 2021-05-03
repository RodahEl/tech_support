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
        $action = 'assign_incident';
    }
}

if ($action == 'assign_incident') {

    $technicians = get_technicians();
    $incidents = get_unassigned_incidents();
    include('assign_incident.php');
     
} else if ($action == 'assign_incident_form') {

    $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
    $tech_id = filter_input(INPUT_POST, 'tech_id', FILTER_VALIDATE_INT);

    // Validate inputs
    if ($incident_id == null || $tech_id == null) {
        $error = "Form data missing. Select incident and technician and try again.";
        include('../errors/error.php');
    } else {

        assign_incident($incident_id, $tech_id);
        include('incident_assigned.php');
    } 
}

?>