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
            FROM parking_spaces ps
            JOIN general_status gs ON ps.fk_status = gs.pk_status
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
                FROM visit
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
                FROM employee e
                JOIN car_information ci ON e.pk_employee = ci.fk_employee
                JOIN model m ON ci.fk_model = m.pk_model
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
                        FROM employees e
                        JOIN check_in_out c ON e.pk_employee = c.fk_employee
                        JOIN vehicles v ON v.pk_vehicle = c.fk_vehicle
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
            $dataset = $this->execquery("SELECT parking_capacity FROM parking WHERE pk_parking = $this->fk_parking AND fk_client = $this->client_id");
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

    public function crearEspacio() {
        // Obtener la capacidad actual del estacionamiento
        $capacidad = $this->getCapacidad();
    
        // Obtener el número máximo de espacio actualmente utilizado
        $maxSpaceNumberResult = $this->execquery("SELECT MAX(spaces_number) AS max_space_number FROM parking_spaces WHERE fk_parking = $this->fk_parking");
        $maxSpaceNumberRow = $maxSpaceNumberResult->fetch_assoc();
        $maxSpaceNumber = $maxSpaceNumberRow['max_space_number'];
    
        // Comprobar si el estacionamiento está lleno
        if ($maxSpaceNumber >= $capacidad) {
            echo "El estacionamiento está lleno, no se pueden agregar más espacios.";
            return false;
        }
    
        // Generar un nuevo número de espacio único
        $newSpaceNumber = $maxSpaceNumber + 1;
    
        // Insertar el nuevo espacio en la base de datos
        $query = "INSERT INTO parking_spaces (spaces_number, fk_status, fk_parking) VALUES ($newSpaceNumber, 1, $this->fk_parking)";
        $result = $this->execquery($query);
        if ($result) {
            echo "Espacio creado exitosamente.";
            return true;
        } else {
            echo "Ha ocurrido un error al crear el espacio.";
            return false;
        }
    }
    

    public function updateEspacio($pk_spaces) {
        $query = "UPDATE parking_spaces SET fk_status = $this->fk_status WHERE pk_spaces = $pk_spaces";
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
        $query = "UPDATE parking_spaces SET spaces_number = $this->spaces_number WHERE pk_spaces = $pk_spaces";
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
        $query = "DELETE FROM parking_spaces WHERE pk_spaces = $pk_spaces";
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