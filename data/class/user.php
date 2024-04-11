<?php //user.php 
    //Incluimos la conexion.
    include_once(__DIR__.'/../conexion.php');

    //creamos la clase para nuestra tabla
    class User extends conexion{
        private $id;
        private $first_name;
        private $last_name;
        private $password;
        private $email;
        private $nickname;

        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setNickname($nickname) {
            $this->nickname = $nickname;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setPassword($password) {
            $this->password = $password;
        }
 
        //METODOS 
        //SELECT
        public function getUserAdmin() {
            $query = "select * from user where password='".$this->password."' and nickname = '".$this->nickname."' and category = 'A'";
            $result = $this->connect();
            if($result) {
                ////echo "todo bien"; 
                $dateSet = $this->execquery($query);
            } else {
                //echo "algo salio mal";
                $dateSet = "error";
            }
            return $dateSet;
        }
        public function getUser() {
            $query = "select * from user where password='".$this->password."' and nickname = '".$this->nickname."' and category = 'C'";
            $result = $this->connect();
            if($result) {
                ////echo "todo bien"; 
                $dateSet = $this->execquery($query);
            } else {
                //echo "algo salio mal";
                $dateSet = "error";
            }
            return $dateSet;
        }
        public function getAllUser() {
            $query = "select * from user where password='".$this->password."' and nickname = '".$this->nickname."'";
            $result = $this->connect();
            if($result) {
                ////echo "todo bien"; 
                $dateSet = $this->execquery($query);
            } else {
                //echo "algo salio mal";
                $dateSet = "error";
            }
            return $dateSet;
        }
        public function getUserAccess($accessCode) {
            $query = 
            "SELECT u.*,
                l.accessCode
            FROM user as u
            INNER JOIN licenses_duration as l
            WHERE nickname = '".$this->nickname."' AND l.accessCode = '$accessCode' AND u.accessCode = '$accessCode' AND l.fk_status = 1";
            $result = $this->connect();
            if($result) {
                ////echo "todo bien"; 
                $dateSet = $this->execquery($query);
            } else {
                //echo "algo salio mal";
                $dateSet = "error";
            }
            return $dateSet;
        }
        public function getUserExist() {
            $query = "SELECT * FROM user WHERE nickname ='".$this->nickname."' OR email = '".$this->email."'";
            $result = $this->connect();
            if($result) {
                ////echo "todo bien"; 
                $dateSet = $this->execquery($query);
                // Verifica si hay filas devueltas
                if ($dateSet->num_rows > 0) {
                    // Existe al menos un usuario con ese nickname o email
                    return true;
                } else {
                    // No existe ningún usuario con ese nickname o email
                    return false;
                }
            } 
        }
        //INSERT
        //Metodo para hacer el insert a la tabla usuario.
        public function setUser() {
            $query = "INSERT INTO user (first_name, last_name, password, email, nickname, category) VALUES ('".$this->first_name."', '".$this->last_name."', '".$this->password."', '".$this->email."', '".$this->nickname."','C')";
            $result = $this->connect();
            if($result) {
                //echo "Ha funcionado el registro de usuario"; 
                $newID = $this->execinsert($query);
            } else {
                //echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }
        //UPDATE
        public function updateAccessCode($accessCode) {
            $query = "UPDATE user SET accessCode = $accessCode WHERE pk_user = $this->id";
            $result = $this->connect();
            if($result) {
                //echo "Ha funcionado el registro de usuario"; 
                $newID = $this->execinsert($query);
            } else {
                //echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }

    } //Fin de la clase
