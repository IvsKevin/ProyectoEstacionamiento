<?php include_once(__DIR__.'/../conexion.php');

    class Car extends conexion{
        
        private $id;
        private $matricula;
        private $model_year;
        private $fk_employee;
        private $fk_model;
        private $fk_color;
        private $fk_status;
        private $fk_client;

        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            } else {
                throw new Exception("Property {$property} does not exist on this object.");
            }
        }
        public function getCarInformation() {
            $query = "SELECT c.*, 
                e.employee_name, 
                e.pk_employee,
                m.model_name, 
                b.brand_name, 
                mc.model_color,
                g.status_name,
                g.pk_status
            FROM Car_Information AS c
                INNER JOIN Employee         AS e ON e.pk_employee = c.fk_employee
                INNER JOIN Model            AS m ON m.pk_model = c.fk_model
                INNER JOIN Brand            AS b ON b.pk_brand = m.fk_brand
                INNER JOIN Model_Color      AS mc ON mc.pk_color = c.fk_color
                INNER JOIN General_Status   AS g ON g.pk_status = c.fk_status
            WHERE c.fk_client = ".$this->fk_client."";
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
        public function getMarca() {
            $query = "SELECT * FROM Brand";
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
        public function getMarcaID($brand_name) {
            $query = "SELECT pk_brand FROM Brand WHERE brand_name = '".$brand_name."'";
            $result = $this->connect();
            if ($result == true){
                $consultado = $this->execquery($query);
                if ($consultado) {
                    $row = mysqli_fetch_assoc($consultado);
                    if ($row) {
                        return $row['pk_brand'];
                    } else {
                        return null;
                    }
                } 
            }
            else{
                echo "algo fallo";
                $consultado = 0;
            }
            return $consultado;
        }
        public function getModel() {
            $query = "SELECT * FROM Model";
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
        public function getModelByID($fk_brand) {
            $query = "SELECT * FROM Model WHERE fk_brand = $fk_brand";
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
        public function getModelColor() {
            $query = "SELECT * FROM Model_Color";
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
        public function setCarInformation() {
            $query = "INSERT INTO Car_Information (matricula, model_year, fk_employee, fk_model, fk_color, fk_status, fk_client) 
            VALUES ('".$this->matricula."', ".$this->model_year.", ".$this->fk_employee.", ".$this->fk_model.", ".$this->fk_color.", ".$this->fk_status.", ".$this->fk_client.")";
            $result = $this->connect();
            if($result) {
                $newID = $this->execquery($query);
                echo "Ha funcionado el registro del carro"; 
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }
        public function updateCar() {
            $query = 'UPDATE Car_Information SET fk_status = "'.$this->fk_status.'" WHERE pk_car = '.$this->id.'';
            $result = $this->connect();
            if($result) {
                echo "Ha funcionado la actualizacion de usuario"; 
                $newID = $this->execquery($query);
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }
    }
?>