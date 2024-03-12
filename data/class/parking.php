<?php
include_once(__DIR__.'/../conexion.php');
class Parking extends conexion {
    private $parking_number;
    private $parking_location;
    private $parking_capacity;
    private $fk_client;
    private $fk_status;

    //METODOS: GET && SETTERS
        //Nueva funcion, vamos a ver como funciona.
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            } else {
                throw new Exception("Property {$property} does not exist on this object.");
            }
        }
    public function setFKclient($fk_client) {
        $this->fk_client = $fk_client;
    }

    //GET
    public function getParkingList() {
        $result = $this->connect();
            if ($result == true){
                //echo "vamos bien";
                $dataset = $this->execquery("SELECT 
                p.*,
                g.pk_status,
                g.status_name 
                FROM Parking AS p
                INNER JOIN General_Status AS g ON g.pk_status = p.fk_status
                WHERE p.fk_client = ".$this->fk_client."
                ORDER BY p.parking_number"
                );
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
    }
    public function getParkingActive() {
        $result = $this->connect();
            if ($result == true){
                //echo "vamos bien";
                $dataset = $this->execquery("SELECT 
                p.*,
                g.pk_status,
                g.status_name 
                FROM Parking AS p
                INNER JOIN General_Status AS g ON g.pk_status = p.fk_status
                WHERE p.fk_client = ".$this->fk_client." AND g.pk_status = 1
                ORDER BY p.parking_number"
                );
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
    }

    public function addParking($location, $capacity) {
        // Conectar a la base de datos
        $result = $this->connect();
        if ($result == false) {
            echo "No se pudo conectar a la base de datos.";
            return false;
        }
    
        // Insertar nuevo estacionamiento sin escapar las entradas
        $sql = "INSERT INTO Parking (parking_number, parking_location, parking_capacity, fk_client, fk_status) VALUES ($this->parking_number, '$location', $capacity, $this->fk_client, 1)";
    
        // Ejecutar la inserción y verificar si fue exitosa
        $newID = $this->execinsert($sql);
    
        if ($newID > 0) {
            // Insertar automáticamente espacios como "disponibles" para el nuevo estacionamiento
            for ($i = 1; $i <= $capacity; $i++) {
                $sqlSpaces = "INSERT INTO Parking_Spaces (spaces_number, fk_status, fk_parking) VALUES ($i, 1, $newID)";
                $this->execquery($sqlSpaces);
            }
            return true;
        } else {
            echo "No se pudo insertar el nuevo estacionamiento.";
            return false;
        }
    }
    

    public function getParkingDetails($parkingID) {
        // Asegurarse de que la conexión está establecida
        $this->connect();
    
        // Ejecutar la consulta sin sentencia preparada
        $sql = "SELECT * FROM Parking WHERE pk_parking = $parkingID";
        $result = $this->execquery($sql);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    

    public function updateParking($parkingID, $location, $status) {
        // Verifica que el estado sea válido (1 para disponible, 2 para lleno)
        // if ($status != 1 && $status != 2) {
        //     return false;
        // }
    
        // Asegurarse de que la conexión está establecida
        $this->connect();
    
        // Realizar la actualización sin sentencia preparada
        $sql = "UPDATE Parking SET parking_number = $this->parking_number, parking_capacity = $this->parking_capacity, parking_location = '$location', fk_status = $status WHERE pk_parking = $parkingID";
        $this->execquery($sql);
    
        // Verificar si la actualización fue exitosa
        if ($this->getConnection()->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>
