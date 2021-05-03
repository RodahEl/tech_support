<?php
require('../model/database.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_incidents';
    }
}

switch ($action) {

    case "list_incidents":
        $incidents = get_incidents();
        include('incident_list.php');
        break;

    default:
        include('incident_list.php');
}

?>