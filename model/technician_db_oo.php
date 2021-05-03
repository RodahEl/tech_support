<?php
    
class TechnicianDB {
	
    public function get_technicians() {
        
        $technician = new Technician();
        return $technician->getTechnicians();
    }

    public function get_technician($tech_id) {
        
        $technician = new Technician();
        return $technician->getTechnician($tech_id);
    }

    public function add_technician($first_name, $last_name, $email, $phone, $password) {

        $technician = new Technician();
        $technician->set_firstname($first_name);
        $technician->set_lastname($last_name);
        $technician->set_email($email);
        $technician->set_phone($phone);
        $technician->set_password($password);
        $technician->save();
    }

    public function delete_technician($tech_id) {
            
        $technician = new Technician();
        $technician->delete($tech_id);
    }

}
?>