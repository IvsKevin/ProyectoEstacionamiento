<?php
include_once(__DIR__."/../conexion.php");

class Dashboard extends conexion {

    public function getParkings($client_id) {
        $this->connect();
        $query = "SELECT * FROM Parking WHERE fk_client = '$client_id'";
        return $this->execquery($query);
    }
    
    public function countParkings($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS total_parkings FROM Parking WHERE fk_client = '$client_id'";
        return $this->execquery($query);
    }
    
    public function countAvailableParkings($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS available_parkings FROM Parking WHERE fk_client = '$client_id' AND fk_status = 1";
        return $this->execquery($query);
    }
    
    public function getCars($client_id) {
        $this->connect();
        $query = "SELECT * FROM Car_Information WHERE fk_client = '$client_id'";
        return $this->execquery($query);
    }
    
    public function countCars($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS total_cars FROM Car_Information WHERE fk_client = '$client_id'";
        return $this->execquery($query);
    }

    public function countVisits($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS total_visits FROM Visit WHERE fk_client = '$client_id'";
        $result = $this->execquery($query);
        if ($result !== false && $result->num_rows > 0) {
            $total_visits = $result->fetch_assoc()['total_visits'];
        } else {
            $total_visits = 0;
        }
        return $total_visits;
    }

    public function countActiveAccessCards($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS active_cards FROM Access_Card AS AC 
                  LEFT JOIN Employee AS E ON AC.fk_employee = E.pk_employee
                  LEFT JOIN Visit AS V ON AC.fk_visit = V.pk_visit
                  WHERE (E.fk_client = '$client_id' OR V.fk_client = '$client_id') AND AC.fk_status = 1";
        $result = $this->execquery($query);
        if ($result !== false && $result->num_rows > 0) {
            $active_cards = $result->fetch_assoc()['active_cards'];
        } else {
            $active_cards = 0;
        }
        return $active_cards;
    }

    public function countEmployees($client_id) {
        $this->connect();
        $query = "SELECT COUNT(*) AS total_employees FROM Employee 
                  INNER JOIN Rol ON Employee.fk_rol = Rol.pk_rol 
                  WHERE Employee.fk_status = 1 AND Employee.fk_client = '$client_id'";
        $result = $this->execquery($query);
        if ($result !== false && $result->num_rows > 0) {
            $total_employees = $result->fetch_assoc()['total_employees'];
        } else {
            $total_employees = 0;
        }
        return $total_employees;
    }

    public function countCheckInOutByClient($client_id) {
        $this->connect(); // Asegurarse de que la conexión esté establecida
    
        $query = "SELECT 
                    COUNT(*) AS total_checkinout, 
                    SUM(CASE WHEN CI.date_out IS NOT NULL THEN 1 ELSE 0 END) AS total_with_date,
                    SUM(CASE WHEN CI.date_out IS NULL THEN 1 ELSE 0 END) AS total_without_date
                  FROM 
                    Check_In_Out AS CI
                  LEFT JOIN 
                    Access_Card AS AC ON CI.fk_card = AC.pk_card
                  LEFT JOIN 
                    Employee AS E ON AC.fk_employee = E.pk_employee
                  LEFT JOIN 
                    Visit AS V ON AC.fk_visit = V.pk_visit
                  WHERE 
                    (E.fk_client = '$client_id' OR V.fk_client = '$client_id') AND CI.fk_status = 1";
    
        $result = $this->execquery($query);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_object();
            $total_checkinout = $row->total_checkinout;
            $total_with_date = $row->total_with_date;
            $total_without_date = $row->total_without_date;
        } else {
            $total_checkinout = 0;
            $total_with_date = 0;
            $total_without_date = 0;
        }
    
        return (object) [
            'total_checkinout' => $total_checkinout,
            'total_with_date' => $total_with_date,
            'total_without_date' => $total_without_date
        ];
    }
    
    public function countCarsByModel($client_id) {
        $this->connect();
        $query = "SELECT M.model_name, COUNT(*) AS total_cars FROM Car_Information AS CI
                  INNER JOIN Model AS M ON CI.fk_model = M.pk_model
                  WHERE CI.fk_client = '$client_id'
                  GROUP BY M.model_name";
        return $this->execquery($query);
    }
    
    
}

$dashboard = new Dashboard();