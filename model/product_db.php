<?php

function get_products() {
    global $db;
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function delete_product($product_code) {
    global $db;
    $query = 'DELETE FROM products
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $statement->closeCursor();
}

function add_product($code, $name, $version, $release_date) {
    global $db;
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (:code, :name, :version, :release_date)';
                 
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->execute();
    $statement->closeCursor();
}

function register_product($email, $product_code) {
    global $db;

    $query = 'SELECT * FROM customers
                WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    
    $query2 = 'INSERT INTO registrations
                 (customerID, productCode, registrationDate)
              VALUES
                 (:customerID, :productCode, :registrationDate)';
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':customerID', $customer['customerID']);
    $statement2->bindValue(':productCode', $product_code);
    $statement2->bindValue(':registrationDate', date('Y-m-d') . ' 00:00:00');
    $statement2->execute();
    $statement2->closeCursor();

}

function get_registered_products($customer) {
    global $db;
    $query = 'SELECT productCode FROM registrations
                WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer['customerID']);
    $statement->execute();
    $registered_product_codes = $statement->fetchAll();
    $statement->closeCursor();

    $prod_codes = [];
    foreach($registered_product_codes as $code) {
        array_push($prod_codes, $code['productCode']);
    }
    
    $query2 = 'SELECT * FROM products
                WHERE productCode IN ("'. implode('","', $prod_codes). '")';
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $registered_products = $statement2->fetchAll();
    $statement2->closeCursor();
    return $registered_products;
}

?>