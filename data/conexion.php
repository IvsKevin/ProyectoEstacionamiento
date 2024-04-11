<?php
class conexion {
//Atributos
private $HOST = "";
private $USER = "";
private $PASS = "";
private $DB = "";
private $connection;
private $dateSet; //El resultado de la consulta.
    //constructor
    // public function __construct() {
    //     $this->HOST = "localhost";
    //     $this->USER = "root";
    //     $this->PASS = "";
    //     $this->DB = "estacionamiento"; //Aqui ira el nombre de nuestra BD
    // }
    public function __construct() {
        $this->HOST = "localhost";
        $this->USER = "id22030952_root";
        $this->PASS = "Estacionamiento_10";
        $this->DB = "id22030952_estacionamiento"; //Aqui ira el nombre de nuestra BD
    }

    //Metodo para conectar con la base de datos.
    public function connect() {
        $this->connection = mysqli_connect($this->HOST,$this->USER,$this->PASS,$this->DB);
        if ($this->connection) {
            //echo "Si conecta a la base de datos.";
            return true;
        } else {
            echo "No se conecto a la BD";
            return false;
        }
    } //Fin del conectar.
      
    //Metodo que hace la conexion y la insercción de nuestro query realizado.
    public function execinsert($query) {
        if(mysqli_query($this->connection, $query) > 0) {
            $newID = $this->connection->insert_id;
            //echo "Insercion exitosa";
        } else {
            $newID = 0;
            //echo "Insercion fallida";
        }
        return $newID;
    }
    //Metodo que ejecuta la consulta que nosotros deseemos.
    public function execquery($query) {
        $this->dateSet = mysqli_query($this->connection, $query);
        if ($this->dateSet) {
            //echo "la consulta va bien";
            return $this->dateSet;
        } else {
            //echo "algo paso en la consulta error";
            return 0;
        }
    } //Fin del execquery.

    public function getConnection() {
        return $this->connection;
    }
}

?>
