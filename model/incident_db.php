<?php

function register_incident($customer_id, $title, $description, $product_code) {

    global $db;
    $query = 'INSERT INTO incidents
                 (customerID, productCode, dateOpened, title, description)
              VALUES
                 (:customerID, :productCode, :dateOpened, :title, :description)';

    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer_id);
    $statement->bindValue(':productCode', $product_code);
    $statement->bindValue(':dateOpened', date('Y-m-d') . ' 00:00:00');
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();

}

function get_incidents() {
    global $db;
    $query = "SELECT * FROM incidents
                LEFT JOIN customers ON customers.customerID=incidents.customerID
                LEFT JOIN products ON products.productCode=incidents.productCode
                LEFT JOIN technicians ON technicians.techID=incidents.techID
                ";
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_unassigned_incidents() {
    global $db;
    $query = "SELECT * FROM incidents
                WHERE techID IS NULL";
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_opened_incidents() {
    global $db;
    $query = "SELECT * FROM incidents
                WHERE techID IS NOT NULL AND dateClosed IS NULL";
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function assign_incident($incident_id, $tech_id) {
    global $db;
    $query = "UPDATE incidents
                SET techID = :tech_id
                WHERE incidentID = :incident_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':tech_id', $tech_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_incident($incident_id, $date_closed) {

    global $db;
    $query = "UPDATE incidents
                SET dateClosed = :date_closed
                WHERE incidentID = :incident_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->bindValue(':date_closed', $date_closed . ' 00:00:00');
    $statement->execute();
    $statement->closeCursor();
}

?>