<?php
include_once(__DIR__.'/../../../data/conexion.php');
include(__DIR__.'/../../../data/class/car.php');
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');
}

include(PROJECT_ROOT.'/data/class/car.php');

session_start();
$car = new Car();
$car->matricula = $_POST["matricula"];
$car->model_year = $_POST["model_year"];
$car->fk_employee = intval($_POST["empleado"]);
$car->fk_model = intval($_POST["modelo"]);
$car->fk_color = intval($_POST["color"]);
$car->fk_status = 1;
$car->fk_client = $_SESSION["client_id"];

$id = $car->setCarInformation();

if($id > 0) {
    header('Location: ../../../view/client/carros.php');

} else {
    echo 'no ha funcionado el registro del empleado';
}
?>