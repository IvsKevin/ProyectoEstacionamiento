<?php 
// Incluir la conexión
include_once(__DIR__.'/../conexion.php');

class Visit extends conexion {
    
    private $id;
    private $company;
    private $reason;
    private $name;
    private $last_name;
    private $fk_client;

    // Setters
    public function setCompany($company) {
        $this->company = $company;
    }

    public function setReason($reason) {
        $this->reason = $reason;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setFkClient($fk_client) {
        $this->fk_client = $fk_client;
    }

    // Métodos

    // Obtener visitas por cliente
    public function getVisitsByClient() {
        $query = "SELECT * FROM Visit WHERE fk_client = '".$this->fk_client."'";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        } else {
            $dataset = "error";
        }
        return $dataset;
    }

    // Insertar nueva visita
    public function setVisit() {
        $query = "INSERT INTO Visit (visit_company, visit_reason, visit_name, visit_lastName, fk_client) VALUES ('".$this->company."', '".$this->reason."', '".$this->name."', '".$this->last_name."', ".$this->fk_client.")";
        $result = $this->connect();
        if ($result) {
            $newID = $this->execquery($query);
            echo "Registro de visita exitoso"; 
        } else {
            echo "Error al registrar visita";
            $newID = "error";
        }
        return $newID;
    }

    // Actualizar información de visita
    public function updateVisit() {
        $query = 'UPDATE Visit SET visit_company = "'.$this->company.'", visit_reason = "'.$this->reason.'", visit_name = "'.$this->name.'", visit_lastName = "'.$this->last_name.'" WHERE pk_visit = '.$this->id.'';
        $result = $this->execquery($query);
        if ($result) {
            echo "Actualización de visita exitosa"; 
            return $this->id;
        } else {
            echo "Error al actualizar visita";
            return 0;
        }
    }

    // Eliminar visita
    public function deleteVisit() {
        $query = 'UPDATE Visit SET fk_status = 2 WHERE pk_visit = ' . $this->id . '';
        $result = $this->connect();
        if ($result) {
            $updated_visit = $this->execquery($query);
            if ($updated_visit) {
                echo "Eliminación de visita exitosa";
                return $updated_visit; 
            } else {
                echo "Error al eliminar visita";
                return "error";
            }
        } else {
            echo "Error al conectar con la base de datos";
            return "error";
        }
    }

    public function getVisit() {
        $query = "SELECT * FROM Visit WHERE fk_client = '".$this->fk_client."'";
        $result = $this->connect();
        if ($result == true){
            $dataset = $this->execquery($query);
        }
        else{
            echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }

    // Obtener información de visita por ID
    public function getVisitById($visit_id) {
        $result = $this->connect();
        if ($result) {
            $visit_id = mysqli_real_escape_string($this->getConnection(), $visit_id); 
            $query = "SELECT * FROM Visit WHERE pk_visit = $visit_id";
            $visit_data = mysqli_query($this->getConnection(), $query);
            if ($visit_data) {
                return mysqli_fetch_assoc($visit_data); 
            }
        }
        return null;
    }

    // Métodos Getters
    public function getId() {
        return $this->id;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getReason() {
        return $this->reason;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getFkClient() {
        return $this->fk_client;
    }
}
?>
