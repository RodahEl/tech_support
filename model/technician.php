<?php

class Technician {

  public $techID;
  public $name;
  public $firstName;
  public $lastName;
  public $email;
  public $phone;
  public $password;
  public $db;

  public function __construct()
  {
      $dbconnect = new Database();
      $this->db = $dbconnect->connect();
  }

  public function set_techid($techID) {
    $this->techID = $techID;
  }

  public function get_techid() {
    return $this->techID;
  }

  public function set_firstname($firstName) {
    $this->firstName = $firstName;
  }

  public function get_firstname() {
    return $this->firstName;
  }

  public function set_lastname($lastName) {
    $this->lastName = $lastName;
  }

  public function get_lastname() {
    return $this->lastName;
  }

  public function set_email($email) {
    $this->email = $email;
  }

  public function get_email() {
    return $this->email;
  }

  public function set_phone($phone) {
    $this->phone = $phone;
  }

  public function get_phone() {
    return $this->phone;
  }

  public function set_password($password) {
    $this->password = $password;
  }

  public function get_password() {
    return $this->password;
  }

  public function fullName() {
    return $this->name = $this->firstName . ' ' . $this->lastName;
  }

  public function getTechnician($tech_id) {

    $query = 'SELECT * FROM technicians
                    WHERE techID = :techID';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':techID', $tech_id);
        $statement->execute();
        $data = $statement->fetch();
        $statement->closeCursor();
        $technician = new Technician();
        $technician->set_techid($data['techID']);
        $technician->set_name($data['firstName']. ' ' .$data['lastName']);
        $technician->set_firstname($data['firstName']);
        $technician->set_lastname($data['lastName']);
        $technician->set_email($data['email']);
        $technician->set_phone($data['phone']);
        $technician->set_password($data['password']);
        return $technician;
  }

  public function getTechnicians() {

    $query = 'SELECT * FROM technicians';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $technicians_data = $statement->fetchAll();
        $statement->closeCursor();
        $technicians = [];
        foreach($technicians_data as $data) {
          $technician = new Technician();
          $technician->set_techid($data['techID']);
          $technician->set_firstname($data['firstName']);
          $technician->set_lastname($data['lastName']);
          $technician->fullName();
          $technician->set_email($data['email']);
          $technician->set_phone($data['phone']);
          $technician->set_password($data['password']);
          array_push($technicians, $technician);
        }
        return $technicians;
  }

  public function save() {

      $query = 'INSERT INTO technicians
          (firstName, lastName, email, phone, password)
          VALUES
          (:first_name, :last_name, :email, :phone, :password)';

      $statement = $this->db->prepare($query);
      $statement->bindValue(':first_name', $this->firstName);
      $statement->bindValue(':last_name', $this->lastName);
      $statement->bindValue(':email', $this->email);
      $statement->bindValue(':phone', $this->phone);
      $statement->bindValue(':password', $this->password);
      $statement->execute();
      $statement->closeCursor();
  }

  public function delete($tech_id) {

    $query = 'DELETE FROM technicians
        WHERE techID = :techID';
    $statement = $this->db->prepare($query);
    $statement->bindValue(':techID', $tech_id);
    $statement->execute();
    $statement->closeCursor();
  }

}
?>