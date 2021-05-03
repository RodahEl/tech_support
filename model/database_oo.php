<?php

class Database {
	
	protected $db_name = 'tech_support';
	protected $db_user = 'root';
	protected $db_pass = 'password';
	protected $db_host = 'localhost';
	
	public function connect() {
	
        try {
            $dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name;
            $db = new PDO($dsn, $this->db_user, $this->db_pass);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
        return $db;
		
	}

}
