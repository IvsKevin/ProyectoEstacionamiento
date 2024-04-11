<?php //client.php 
    //Incluimos la conexion.
    include_once(__DIR__."/../conexion.php");

    //Creamos la clase para nuestra tabla
    class Licenses extends conexion{
        private $id;
        private $startDate;
        private $endDate;
        private $accessCode;
        private $fk_duration;
        private $fk_payment;

        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setAccessCode($accessCode) {
            $this->accessCode = $accessCode;
        }
        public function setDuration($fk_duration) {
            $this->fk_duration= $fk_duration;
        }
        public function setPayment($fk_payment) {
            $this->fk_payment= $fk_payment;
        }


        //METODOS

        //SELECT 
        public function getLicensesDuration($client_id){
            $query = "SELECT 
                c.pk_client, 
                c.client_name, 
                LD.pk_LD, 
                LD.LD_start_date, 
                LD.LD_end_date, 
                GS.status_name
            FROM 
                client c
            INNER JOIN 
                payment p ON c.pk_client = p.fk_client
            INNER JOIN 
                licenses_duration LD ON p.pk_payment = LD.fk_payment
            INNER JOIN 
                general_status GS ON LD.fk_status = GS.pk_status
            WHERE 
                c.pk_client = ".$client_id." 
                AND LD.LD_end_date > CURRENT_TIMESTAMP 
                AND GS.status_name = 'activo';
            ";
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery($query);
                if ($dataset->num_rows > 0){
                    $dataset = "aprobado";
                }
            }
            else{
                //echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        } 
        public function getInfoLicense($client_id){
            $query = "SELECT 
                c.pk_client,
                s.nickname, 
                c.client_name, 
                p.payment_description,
                p.payment_amount,
                LD.accessCode, 
                LD.pk_LD, 
                LD.LD_start_date, 
                LD.LD_end_date, 
                GS.status_name
            FROM 
                client c
            INNER JOIN 
                User s ON s.pk_user = c.fk_user
            INNER JOIN 
                payment p ON c.pk_client = p.fk_client
            INNER JOIN 
                licenses_duration LD ON p.pk_payment = LD.fk_payment
            INNER JOIN 
                general_status GS ON LD.fk_status = GS.pk_status
            WHERE 
                c.pk_client = ".$client_id." 
                AND LD.LD_end_date > CURRENT_TIMESTAMP 
                AND GS.status_name = 'activo';
            ";
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery($query);
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        } 

        //INSERT
        // Función para generar un código de acceso aleatorio
        private function generateAccessCode($length = 10) {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= mt_rand(0, 9);
            }
            return $code;
        }
        public function setLicenses() {
            $accessCode = $this->generateAccessCode();

            $query = "INSERT INTO licenses_duration (LD_start_date, LD_end_date, accessCode, fk_duration, fk_payment, fk_status) 
            VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH), $accessCode,".$this->fk_duration.", ".$this->fk_payment.", 1)";
            $result = $this->connect();
            if($result) {
                $newID = $this->execinsert($query);
                echo "Ha funcionado el registro del pago"; 
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $accessCode;
        }

    } //Fin de la clase
?>