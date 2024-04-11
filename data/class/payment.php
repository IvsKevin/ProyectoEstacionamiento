<?php //client.php 
    //Incluimos la conexion.
    include_once(__DIR__."/../conexion.php");

    //Creamos la clase para nuestra tabla
    class Payment extends conexion{
        private $id;
        private $amount;
        private $description;
        private $date;
        private $fk_duration;
        private $fk_method;
        private $fk_paymentStatus;
        private $fk_client;

        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setAmount($amount) {
            $this->amount= $amount;
        }
        public function setDescription($description) {
            $this->description = $description;
        }
        public function setDate($date) {
            $this->date = $date;
        }
        public function setDuration($fk_duration) {
            $this->fk_duration= $fk_duration;
        }
        public function setMethod($fk_method) {
            $this->fk_method= $fk_method;
        }
        public function setPaymentStatus($fk_paymentStatus) {
            $this->fk_paymentStatus= $fk_paymentStatus;
        }
        public function setClient($fk_client) {
            $this->fk_client= $fk_client;
        }
 

        //METODOS

        

        public function sumBasicPayment(){
            $result = $this->connect();
            if($result){
                $dataset = $this->execquery("SELECT COUNT(pk_payment) AS basic
                FROM payment
                where payment_description = 'Licencia Basica'");
                if ($basic = mysqli_fetch_assoc($dataset)) {
                    return $basic['basic']; // Corregido aquí
                } else {
                    return 0;
                }
            }else{
                echo "algo fallo";
                return 0;
            }
        }

        public function sumProPayment(){
            $result = $this->connect();
            if($result){
                $dataset = $this->execquery("SELECT COUNT(pk_payment) AS pro
                FROM payment
                where payment_description = 'Licencia Pro'");
                if ($basic = mysqli_fetch_assoc($dataset)) {
                    return $basic['pro']; // Corregido aquí
                } else {
                    return 0;
                }
            }else{
                echo "algo fallo";
                return 0;
            }
        }
        public function sumRegularPayment(){
            $result = $this->connect();
            if($result){
                $dataset = $this->execquery("SELECT COUNT(pk_payment) AS regular
                FROM payment
                where payment_description = 'Licencia Regular'");
                if ($basic = mysqli_fetch_assoc($dataset)) {
                    return $basic['regular']; // Corregido aquí
                } else {
                    return 0;
                }
            }else{
                echo "algo fallo";
                return 0;
            }
        }

        public function sumPayment(){
            $result = $this->connect();
            if($result){
                $dataset = $this->execquery("SELECT SUM(payment_amount) AS Total FROM payment");
                if ($row = mysqli_fetch_assoc($dataset)) {
                    return $row['Total'];
                } else {
                    return 0;
                }
            }else{
                echo "algo fallo";
                return 0;
            }
        }
        //SELECT 
        public function getAllPayments(){
            $result = $this->connect();
            if ($result == true){
                $dataset = $this->execquery("SELECT payment.*, client.client_name, payment_Method.* 
                                            FROM payment 
                                            INNER JOIN client ON payment.fk_client = client.pk_client 
                                            INNER JOIN payment_method ON Payment.fk_method = payment_method.pk_method");
            }
            else {
                $dataset = "error";
            }
            return $dataset;
        }
        
        
        //INSERT
        public function setPayment() {
            $query = "INSERT INTO payment (payment_amount, payment_description, payment_date, fk_duration, fk_method, fk_paymentStatus, fk_client) 
            VALUES (".$this->amount.", '".$this->description."', NOW(),'".$this->fk_duration."', 1, 1, '".$this->fk_client."')";
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

        public function getEarningsByMonth() {
            $result = $this->connect();
            if ($result) {
                $query = "SELECT MONTH(payment_date) AS month, YEAR(payment_date) AS year, SUM(payment_amount) AS total_earnings FROM payment GROUP BY YEAR(payment_date), MONTH(payment_date) ORDER BY year ASC, month ASC";
                $dataset = $this->execquery($query);
                if ($dataset) {
                    $earnings = array();
                    while ($row = mysqli_fetch_assoc($dataset)) {
                        $earnings[] = $row;
                    }
                    return $earnings;
                } else {
                    echo "Error al ejecutar la consulta";
                    return array();
                }
            } else {
                echo "Error al conectar con la base de datos";
                return array();
            }
        }
        
    }