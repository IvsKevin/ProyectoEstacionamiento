<?php 
    include_once(__DIR__.'/../conexion.php');
    class Espacios extends conexion {
    private $pk_spaces;
    private $spaces_number;
    private $fk_status;
    private $fk_parking;
    private $client_id;
    private $capacidad;
    private $fk_client;
    private $pk_parking;

    public function setPKSpaces ($pk_spaces){
        $this->pk_spaces = $pk_spaces;
    }
    public function setSpacesNumber($spaces_number){
        $this->spaces_number = $spaces_number;
    }
    public function setFkStatus($fk_status){
        $this->fk_status = $fk_status;
    }
    public function setFk_parking($fk_parking){
        $this->fk_parking = $fk_parking;
    }
    public function setFkClient($client_id){
        $this->client_id = $client_id;
    }

    public function getEspacios($pk_parking){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("SELECT 
                ps.pk_spaces,
                ps.spaces_number, 
                ps.fk_employee,
                ps.fk_visit,
                gs.pk_status,
                gs.status_name
            FROM Parking_Spaces ps
            JOIN General_Status gs ON ps.fk_status = gs.pk_status
            WHERE ps.fk_parking = $pk_parking
            ORDER BY ps.spaces_number");
        } else {
            echo "La consulta salió mal";
            $dataset = "error";
        }
        return $dataset;
    }

    public function getVisitaInfo($pk_visit){
        $result = $this->connect();
        if ($result){
            $visitQuery = "SELECT visit_name, visit_lastNameP, visit_lastNameM
                FROM Visit
                WHERE pk_visit = $pk_visit";
            $visitResult = $this->execquery($visitQuery);
            return $visitResult;
        } else {
            echo "La consulta de visita salió mal";
            return null;
        }
    }
    
    public function getEmpleadoInfo($pk_employee){
        $result = $this->connect();
        if ($result){
            $employeeQuery = "SELECT e.employee_name, ci.matricula, m.model_name
                FROM Employee e
                JOIN Car_Information ci ON e.pk_employee = ci.fk_employee
                JOIN Model m ON ci.fk_model = m.pk_model
                WHERE e.pk_employee = $pk_employee";
            $employeeResult = $this->execquery($employeeQuery);
            return $employeeResult;
        } else {
            echo "La consulta de empleado salió mal";
            return null;
        }
    }
    
    public function getEspaciosActuales(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery ("SELECT pk_spaces FROM parking_spaces WHERE fk_parking = $this->fk_parking");
            if($dataset) {
                $i = 0;
                while($row = mysqli_fetch_assoc($dataset)) {
                    $i++;
                }
                return $espaciosActuales = $i;
            }
        }else{
            echo "La consulta salio mal";
            $espaciosActuales = 0;
        }
    }

    public function getEmpleadoInfoBySpace($pk_space) {
        $result = $this->connect();
        if ($result) {
            $query = "SELECT e.employee_name, v.vehicle_model, v.matricula
                        FROM Employees e
                        JOIN Check_In_Out c ON e.pk_employee = c.fk_employee
                        JOIN Vehicles v ON v.pk_vehicle = c.fk_vehicle
                        WHERE c.fk_space = {$pk_space}";
    
            $employeeInfo = $this->execquery($query);
            return $employeeInfo;
        } else {
            return false;
        }
    }
    
    public function getEspaciosDisponibles(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery ("SELECT pk_spaces FROM parking_spaces WHERE fk_parking = $this->fk_parking AND fk_status = 1");
            if($dataset) {
                $i = 0;
                while($row = mysqli_fetch_assoc($dataset)) {
                    $i++;
                }
                return $espaciosActuales = $i;
            }
        }else{
            echo "La consulta salio mal";
            $espaciosActuales = 0;
        }
    }

    public function getCapacidad(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("SELECT parking_capacity FROM Parking WHERE pk_parking = $this->fk_parking AND fk_client = $this->client_id");
            if($dataset) {
                while($row = mysqli_fetch_assoc($dataset)) {
                    $capacidad = $row['parking_capacity'];
                    return $capacidad;
                }
            } 
        }else{
            //echo "La consulta salio mal";
            $dataset = "error";
            return 0;
        }
    }

    public function crearEspacio($space_number) {
        $query = "INSERT INTO parking_spaces (spaces_number, fk_status, fk_parking) 
        VALUES ($space_number, 1, $this->fk_parking)";
        $result = $this->connect();
        if($result) {
            $newID = $this->execinsert($query);
            echo "Ha funcionado el registro del pago"; 
        } else {
            echo "algo salio mal";
            $newID = "error";
        }
        return $newID;
    }

    public function updateEspacio($pk_spaces) {
        $query = "UPDATE Parking_Spaces SET fk_status = $this->fk_status WHERE pk_spaces = $pk_spaces";
            $result = $this->connect();
            if($result) {
                $newID = $this->execquery($query);
                echo "Ha funcionado la eliminacion de espacio"; 
            } else {
                echo "algo salio mal";
                $newID = 0;
            }
            return $newID;
    }
    public function updateEspacioNumber($pk_spaces) {
        $query = "UPDATE Parking_Spaces SET spaces_number = $this->spaces_number WHERE pk_spaces = $pk_spaces";
            $result = $this->connect();
            if($result) {
                $newID = $this->execquery($query);
                echo "Ha funcionado la eliminacion de espacio"; 
            } else {
                echo "algo salio mal";
                $newID = 0;
            }
            return $newID;
    }
    public function eliminarEspacio($pk_spaces) {
        $query = "DELETE FROM Parking_Spaces WHERE pk_spaces = $pk_spaces";
            $result = $this->connect();
            if($result) {
                $newID = $this->execquery($query);
                echo "Ha funcionado la eliminacion de espacio"; 
            } else {
                echo "algo salio mal";
                $newID = 0;
            }
            return $newID;
    }
}
