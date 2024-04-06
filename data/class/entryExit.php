<?php
include_once(__DIR__.'/../conexion.php');

class carentry extends conexion {
    private $pk_check;
    private $date_in;
    private $date_out;
    private $fk_parking;
    private $fk_card;
    private $fk_status;
    public function getPkCheck() {
        return $this->pk_check;
    }

    public function setPkCheck($pk_check) {
        $this->pk_check = $pk_check;
    }

    public function getDateIn() {
        return $this->date_in;
    }

    public function setDateIn($date_in) {
        $this->date_in = $date_in;
    }

    public function getDateOut() {
        return $this->date_out;
    }

    public function setDateOut($date_out) {
        $this->date_out = $date_out;
    }

    public function getFkParking() {
        return $this->fk_parking;
    }

    public function setFkParking($fk_parking) {
        $this->fk_parking = $fk_parking;
    }

    public function getFkCard() {
        return $this->fk_card;
    }

    public function setFkCard($fk_card) {
        $this->fk_card = $fk_card;
    }

    public function getFkStatus() {
        return $this->fk_status;
    }

    public function setFkStatus($fk_status) {
        $this->fk_status = $fk_status;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Property {$property} does not exist on this object.");
        }
    }

    
    public function registrarEntradaVehiculo($QR_code, $selectedParking) {
        date_default_timezone_set('America/Tijuana');
        $conexion = new conexion();
        $conexion->connect();
        $entryDate = date('Y-m-d H:i:s');
    
        $accessCardQuery = "SELECT pk_card, fk_employee, fk_visit FROM Access_Card WHERE QR_code = '$QR_code' AND fk_status = 1";
        $accessCardResult = $conexion->execquery($accessCardQuery);
    
        if ($accessCardResult && mysqli_num_rows($accessCardResult) > 0) {
            $accessCardRow = mysqli_fetch_assoc($accessCardResult);
            $selectedCard = $accessCardRow['pk_card'];
            $selectedCardEmployee = $accessCardRow['fk_employee'];
            $selectedCardVisit = $accessCardRow['fk_visit'];
            $salidaPendiente = $this->verificarSalidaPendiente($selectedCard);
            if ($salidaPendiente) {
                $errorMessage = "No has registrado tu salida, por lo tanto, no puedes volver a entrar.";
                return $errorMessage;
            }

            if($selectedCardEmployee != null) {
                $carCheckQuery = "SELECT pk_car FROM Car_Information WHERE fk_employee = $selectedCardEmployee";
                $carCheckResult = $conexion->execquery($carCheckQuery);
            }
    
            if ($selectedCardEmployee !== null && (!$carCheckResult || mysqli_num_rows($carCheckResult) === 0)) {
                $errorMessage = "El empleado no tiene un carro registrado y no puede hacer check-in.";
                return $errorMessage;
            }
    
            $spaceQuery = "SELECT pk_spaces FROM Parking_Spaces WHERE fk_parking = $selectedParking AND fk_status = 1 LIMIT 1";
            $spaceResult = $conexion->execquery($spaceQuery);
    
            if ($spaceResult && mysqli_num_rows($spaceResult) > 0) {
                $spaceRow = mysqli_fetch_assoc($spaceResult);
                $selectedSpace = $spaceRow['pk_spaces'];
    
                $spaceUpdate = ($selectedCardEmployee !== null) ?
                    "UPDATE Parking_Spaces SET fk_employee = $selectedCardEmployee WHERE pk_spaces = $selectedSpace AND fk_status = 1 LIMIT 1" :
                    "UPDATE Parking_Spaces SET fk_visit = $selectedCardVisit WHERE pk_spaces = $selectedSpace AND fk_status = 1 LIMIT 1";
    
                $spaceResultUpdate = $conexion->execquery($spaceUpdate);
    
                if ($spaceResultUpdate) {
                    $queryInsert = "INSERT INTO Check_In_Out (date_in, fk_parking, fk_card, fk_space, fk_status) VALUES ('$entryDate', $selectedParking, $selectedCard, $selectedSpace, 1)";
                    $resultInsert = $conexion->execinsert($queryInsert);
    
                    if ($resultInsert) {
                        $lastEntryId = $conexion->getConnection()->insert_id;
                        $assignSpaceQuery = "UPDATE Parking_Spaces SET fk_status = 2 WHERE pk_spaces = $selectedSpace";
                        $resultAssignSpace = $conexion->execquery($assignSpaceQuery);
    
                        if ($resultAssignSpace) {
                            return $lastEntryId;
                        } else {
                            $errorMessage = "Error al asignar el espacio al vehículo.";
                            return $errorMessage;
                        }
                    } else {
                        $errorMessage = "Error al registrar la entrada del vehículo.";
                        return $errorMessage;
                    }
                } else {
                    $errorMessage = "Error al asignar el espacio al vehículo.";
                    return $errorMessage;
                }
            } else {
                $errorMessage = "No hay espacios disponibles en el parking seleccionado.";
                return $errorMessage;
            }
        } else {
            $errorMessage = "La tarjeta de acceso no es válida o no está activa.";
            return $errorMessage;
        }
    }
    
    private function verificarSalidaPendiente($selectedCard) {
        $conexion = new conexion();
        $conexion->connect();
        
        $query = "SELECT date_out FROM Check_In_Out WHERE fk_card = $selectedCard AND date_out IS NULL";
        $result = $conexion->execquery($query);
        
        return ($result && mysqli_num_rows($result) > 0);
    }
    
    public function registrarSalidaVehiculo($QR_code) {
        date_default_timezone_set('America/Tijuana');
    
        $conexion = new conexion();
        $conexion->connect();
    
        $checkQuery = "SELECT CI.pk_check, CI.date_out, CI.fk_parking, CI.fk_space 
                       FROM Check_In_Out AS CI
                       INNER JOIN Access_Card AS AC ON CI.fk_card = AC.pk_card
                       WHERE AC.QR_code = '$QR_code' AND CI.date_out IS NULL";
        $checkResult = $conexion->execquery($checkQuery);
    
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            $entryId = $row['pk_check'];
            $existingExitDate = $row['date_out'];
            $parkingId = $row['fk_parking'];
            $spaceId = $row['fk_space'];
    
            if ($existingExitDate !== null) {
                return "Esta entrada ya tiene fecha de salida: $existingExitDate";
            }
    
            $exitDate = new DateTime('now', new DateTimeZone('America/Tijuana'));
            $formattedExitDate = $exitDate->format('Y-m-d H:i:s');
            $query = "UPDATE Check_In_Out SET date_out = '$formattedExitDate' WHERE pk_check = $entryId";
    
            $result = $conexion->execquery($query);
    
            if ($result) {
                $releaseSpaceQuery = "UPDATE Parking_Spaces SET fk_status = 1, fk_employee = NULL, fk_visit = NULL WHERE pk_spaces = $spaceId";
                $resultReleaseSpace = $conexion->execquery($releaseSpaceQuery);
    
                if ($resultReleaseSpace) {
                    return $formattedExitDate;
                } else {
                    return "Error al liberar el espacio del estacionamiento.";
                }
            } else {
                return "Error al registrar la salida del vehículo.";
            }
        } else {
            return "La entrada no existe o ya tiene fecha de salida.";
        }
    }
    

    public function getCheckInOutData($client_id) {
        $conexion = new conexion();
        $conexion->connect();
    
        $query = "SELECT CI.pk_check, CI.date_in, CI.date_out, 
                         CONCAT(E.employee_name, ' (Empleado)') AS person_name, 
                         CONCAT(V.visit_name, ' (Visitante)') AS visit_name, 
                         CI.fk_parking, CI.fk_card, C.matricula, P.parking_location
                  FROM Check_In_Out AS CI
                  LEFT JOIN Access_Card AS AC ON CI.fk_card = AC.pk_card
                  LEFT JOIN Employee AS E ON AC.fk_employee = E.pk_employee
                  LEFT JOIN Visit AS V ON AC.fk_visit = V.pk_visit
                  LEFT JOIN Car_Information AS C ON E.pk_employee = C.fk_employee
                  LEFT JOIN Parking AS P ON CI.fk_parking = P.pk_parking
                  WHERE (E.fk_client = $client_id OR V.fk_client = $client_id) AND CI.fk_status = 1
                  ORDER BY CI.pk_check";
    
        $result = $conexion->execquery($query);
    
        return $result;
    }
    
    
    
    
    
    
}


?>
