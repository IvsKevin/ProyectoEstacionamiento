<?php //user.php 
    //Incluimos la conexion.
    include_once(__DIR__.'/../conexion.php');

    //creamos la clase para nuestra tabla
    class AccessCard extends conexion {
        private $id;
        private $QR_code;
        private $card_creation_date;
        private $card_end_date;
        private $card_type;
        private $fk_employee;
        private $fk_status;
        private $fk_visit;
    
        // Setters
    
        public function setID($id) {
            $this->id = $id;
        }
    
        public function setQRCode($QR_code) {
            $this->QR_code = $QR_code;
        }
    
        public function setCreationDate($card_creation_date) {
            $this->card_creation_date = $card_creation_date;
        }
    
        public function setEndDate($card_end_date) {
            $this->card_end_date = $card_end_date;
        }
    
        public function setCardType($card_type) {
            $this->card_type = $card_type;
        }
    
        public function setFKEmployee($fk_employee) {
            $this->fk_employee = $fk_employee;
        }
    
        public function setFKStatus($fk_status) {
            $this->fk_status = $fk_status;
        }
        public function setFKVisit($fk_visit) {
            $this->fk_visit = $fk_visit; // Asigna el ID de la visita al atributo que representa la visita
        }

        public function getAccessCards() {
            $query = "SELECT * FROM Access_Card";
            $result = $this->connect();
        
            if ($result) {
                $access_cards = $this->execquery($query);
                return $access_cards;
            } else {
                echo "Algo salió mal al intentar obtener las tarjetas de acceso";
                return "error";
            }
        }

    
        public function insertAccessCard() {
            $query = "INSERT INTO Access_Card (QR_code, card_creation_date, card_end_date, card_type, fk_employee, fk_status) 
              VALUES ('$this->QR_code', '$this->card_creation_date', '$this->card_end_date', '$this->card_type', '$this->fk_employee', 1)";
        
            $result = $this->connect();
            if ($result) {
                $newID = $this->execinsert($query);
                echo "La tarjeta de acceso se ha generado correctamente"; 
            } else {
                echo "Algo salió mal al intentar generar la tarjeta de acceso";
                $newID = "error";
            }
            return $newID;
        }

        public function insertAccessCardForVisit($QR_code, $creation_date, $end_date, $card_type, $fk_visit) {
            $query = "INSERT INTO Access_Card (QR_code, card_creation_date, card_end_date, card_type, fk_visit, fk_status) 
                      VALUES ('$QR_code', '$creation_date', '$end_date', '$card_type', '$fk_visit', 1)";
            
            $result = $this->connect();
            if ($result) {
                $newID = $this->execinsert($query);
                if ($newID) {
                    echo "La tarjeta de acceso para la visita se ha generado correctamente"; 
                    return $newID;
                } else {
                    echo "No se pudo generar la tarjeta de acceso para la visita.";
                    return "error";
                }
            } else {
                echo "Algo salió mal al intentar generar la tarjeta de acceso para la visita";
                return "error";
            }
        }
        
    
        // Actualizar tarjeta de acceso en la base de datos
    
        public function updateAccessCard() {
            $query = "UPDATE Access_Card SET QR_code = '$this->QR_code', card_creation_date = '$this->card_creation_date', 
                      card_end_date = '$this->card_end_date', card_type = '$this->card_type', 
                      fk_employee = '$this->fk_employee', fk_status = '$this->fk_status' WHERE pk_card = $this->id";
            
            $result = $this->connect();
            if ($result) {
                $updated = $this->execquery($query);
                echo "La tarjeta de acceso se ha actualizado correctamente"; 
            } else {
                echo "Algo salió mal al intentar actualizar la tarjeta de acceso";
                $updated = "error";
            }
            return $updated;
        }
    
        // Eliminar tarjeta de acceso de la base de datos
    
        // Método para eliminar el empleado y su tarjeta de acceso asociada
public function deleteEmployee() {
    $query = 'UPDATE Employee SET fk_status = 2 WHERE pk_employee = ' . $this->id . '';
    $result = $this->connect();

    if ($result) {
        $deleteEmployee = $this->execquery($query);

        // Eliminar la tarjeta de acceso asociada al empleado
        if ($deleteEmployee) {
            $deleteCardQuery = "DELETE FROM Access_Card WHERE fk_employee = " . $this->id;
            $deleteCardResult = $this->execquery($deleteCardQuery);
            if ($deleteCardResult) {
                echo "El empleado y su tarjeta de acceso se han eliminado correctamente";
                return $deleteCardResult;
            } else {
                echo "Algo salió mal al intentar eliminar la tarjeta de acceso del empleado";
                return "error";
            }
        }
    }

    echo "Algo salió mal al intentar eliminar el empleado";
    return "error";
}

    
        // Obtener tarjeta de acceso por ID
    
        public function getAccessCardByID($access_card_id) {
            $query = "SELECT * FROM Access_Card WHERE pk_card = $access_card_id";
            
            $result = $this->connect();
            if ($result) {
                $access_card_data = $this->execquery($query);
                return mysqli_fetch_assoc($access_card_data);
            }
            return null;
        }

        public function getEmployeeName($employee_id) {
            $query = "SELECT employee_name, employee_lastNameP, employee_lastNameM FROM Employee WHERE pk_employee = $employee_id";
            $result = $this->connect();
            if ($result) {
                $employee_data = $this->execquery($query);
                $employee = mysqli_fetch_assoc($employee_data);
                return $employee['employee_name'] . ' ' . $employee['employee_lastNameP'] . ' ' . $employee['employee_lastNameM'];
            }
            return null;
        }
    
        public function getEmployeePhoto($employee_id) {
            // Aquí debes obtener la URL de la foto del empleado desde el framework
            // Esto podría implicar acceder a algún objeto o servicio proporcionado por el framework
            // Por ahora, simplemente devolveremos una URL de imagen de ejemplo
            return "https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg";
        }
        
        public function getAccessCardsByClient($client_id) {
            $query = "SELECT Access_Card.*, Employee.fk_client
                      FROM Access_Card
                      INNER JOIN Employee ON Access_Card.fk_employee = Employee.pk_employee
                      WHERE Employee.fk_client = $client_id";
        
            $result = $this->connect();
            if ($result) {
                $access_cards = $this->execquery($query);
                return $access_cards;
            } else {
                echo "Algo salió mal al intentar obtener las tarjetas de acceso";
                return "error";
            }
        }
    
        // Otros métodos que puedas necesitar para AccessCard.
    }
