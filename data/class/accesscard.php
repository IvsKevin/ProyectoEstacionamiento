<?php //user.php 
//Incluimos la conexion.
include_once(__DIR__ . '/../conexion.php');

//creamos la clase para nuestra tabla
class AccessCard extends conexion
{
    private $id;
    private $QR_code;
    private $card_creation_date;
    private $card_end_date;
    private $card_type;
    private $fk_employee;
    private $fk_status;
    private $fk_visit;

    // Setters

    public function setID($id)
    {
        $this->id = $id;
    }

    public function setQRCode($QR_code)
    {
        $this->QR_code = $QR_code;
    }

    public function setCreationDate($card_creation_date)
    {
        $this->card_creation_date = $card_creation_date;
    }

    public function setEndDate($card_end_date)
    {
        $this->card_end_date = $card_end_date;
    }

    public function setCardType($card_type)
    {
        $this->card_type = $card_type;
    }

    public function setFKEmployee($fk_employee)
    {
        $this->fk_employee = $fk_employee;
    }

    public function setFKStatus($fk_status)
    {
        $this->fk_status = $fk_status;
    }
    public function setFKVisit($fk_visit)
    {
        $this->fk_visit = $fk_visit; // Asigna el ID de la visita al atributo que representa la visita
    }

    public function getAccessCards()
    {
        $query = "SELECT * FROM access_card";
        $result = $this->connect();

        if ($result) {
            $access_cards = $this->execquery($query);
            return $access_cards;
        } else {
            echo "Algo salió mal al intentar obtener las tarjetas de acceso";
            return "error";
        }
    }


    public function insertAccessCard()
    {
        $query = "INSERT INTO access_card (QR_code, card_creation_date, card_end_date, card_type, fk_employee, fk_status) 
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

    public function insertAccessCardForVisit($QR_code, $creation_date, $end_date, $card_type, $fk_visit)
    {
        $query = "INSERT INTO access_card (QR_code, card_creation_date, card_end_date, card_type, fk_visit, fk_status) 
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

    public function updateAccessCard()
    {
        $query = "UPDATE access_card SET QR_code = '$this->QR_code', card_creation_date = '$this->card_creation_date', 
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

    public function getAccessCardsByClient($client_id)
    {
        $query = "SELECT AC.pk_card, AC.QR_code, 
            CONVERT_TZ(AC.card_creation_date, '+00:00', '-07:00') AS card_creation_date,
            CASE WHEN AC.card_type = 'Visitante' THEN CONVERT_TZ(DATE_ADD(AC.card_creation_date, INTERVAL 1 DAY), '+00:00', '-07:00')
                ELSE CONVERT_TZ(DATE_ADD(AC.card_creation_date, INTERVAL 1 YEAR), '+00:00', '-07:00') END AS card_end_date,
            AC.card_type, AC.fk_employee, AC.fk_status, 
            E.employee_name,
            E.employee_lastNameP, 
            E.employee_lastNameM,
            V.pk_visit,
            V.visit_name,
            V.visit_lastName
            FROM access_card AS AC 
            LEFT JOIN employee AS E ON AC.fk_employee = E.pk_employee
            LEFT JOIN visit AS V ON AC.fk_visit = V.pk_visit
            WHERE E.fk_client = $client_id OR V.fk_client = $client_id";

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
