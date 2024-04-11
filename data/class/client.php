<?php //client.php 
    //Incluimos la conexion.
    include_once(__DIR__."/../conexion.php");

    //Creamos la clase para nuestra tabla
    class Client extends conexion{
        private $id;
        private $name;
        private $email;
        private $address;
        private $country;
        private $city;
        private $state;
        private $zip_code;
        private $tel;
        private $fk_user;


        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setName($name) {
            $this->name = $name;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setAddress($address) {
            $this->address = $address;
        }
        public function setCountry($country) {
            $this->country = $country;
        }
        public function setCity($city) {
            $this->city = $city;
        }
        public function setState($state) {
            $this->state = $state;
        }
        public function setZipCode($zip_code) {
            $this->zip_code = $zip_code;
        }
        public function setTel($tel) {
            $this->tel = $tel;
        }
        public function setFK_user($fk_user) {
            $this->fk_user = $fk_user;
        }

        //METODOS

        //SELECT
        public function getAllClientsC(){
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery("SELECT * FROM client INNER JOIN user on client.fk_user = user.pk_user WHERE user.category = 'C'");
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        }
        public function getAllClients(){
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery("SELECT * FROM client WHERE fk_status = 1");
            }
            else{
                //echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        } 
        //Metodo para saber el cliente por la fk de usuario.
        public function getClientByUser($fk_user){
            $result = $this->connect();
            if ($result == true){
                // echo "Funciono la consulta en Cliente por filtro de Usuario";
                $dataset = $this->execquery("SELECT * FROM client WHERE fk_user = $fk_user");
                // print_r($dataset);
            }
            else{
                //echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        }

        // Método para contar el total de clientes excluyendo al administrador
public function countTotalClients()
{
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery("SELECT COUNT(pk_client) AS total_clients FROM client WHERE fk_user <> 1");
        if ($row = mysqli_fetch_assoc($dataset)) {
            return $row['total_clients'];
        } else {
            return 0;
        }
    } else {
        echo "Algo falló";
        return 0;
    }
}

        
        //Metdoo para obtener el id del cliente.
        public function getClientById($client_id) {
            $result = $this->connect();
        
            if ($result) {
                $client_id = mysqli_real_escape_string($this->getConnection(), $client_id); // Escapa el valor para evitar SQL injection
                $query = "SELECT * FROM client WHERE pk_client = $client_id";
                $client_data = mysqli_query($this->getConnection(), $query);
        
                if ($client_data) {
                    return mysqli_fetch_assoc($client_data); // Devuelve un array asociativo con los datos del cliente
                }
            }
            return null; // Devuelve null si no se encuentra el cliente
        }

        //INSERT
        public function setClient() {
            $consult = $this->connect();
            if ($consult) {
                $newid = $this->execinsert("INSERT INTO client (client_name, client_email, client_address, client_country, client_city, client_state, client_zip_code, client_tel, fk_user, fk_status) VALUES ('" . $this->name . "', '" . $this->email . "','".$this->address."','".$this->country."','".$this->city."','".$this->state."',".$this->zip_code.",'".$this->tel."',".$this->fk_user.", 1)");
            } else {
                echo "Ha ocurrido un problema con la conexión";
                $newid = 0;
            }
            return $newid;
        }

        //UPDATE
        
        //Metodo para actualizar el cliente.
        public function updateClient() {
            $query = 'UPDATE client SET  client_email = "'.$this->email.'", client_address = "'.$this->address.'", client_tel = "'.$this->tel.'" WHERE pk_client = '.$this->id.'';
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

        //Metodo para eliminar el cliente.
        public function deleteClient() {
            $query = 'UPDATE client SET fk_status = 2 WHERE pk_client = ' . $this->id . '';
            $result = $this->connect();
            if($result) {
                echo "Ha funcionado la eliminacion de usuario"; 
                $newID = $this->execquery($query);
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }
    } //Fin de la clase
?>