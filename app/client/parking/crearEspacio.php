<?php
//Incluimos la clase Espacios para crear el objeto.
session_start();
include(__DIR__ . '/../../../data/class/Espacios.php');

$space_number = $_POST['spaces_number'];

$myEspacios = new Espacios();
$myEspacios->setFkClient($_SESSION['client_id']);
$myEspacios->setFk_parking($_SESSION['pk_parking']);

$limite = $myEspacios->getCapacidad(); //Obtenemos el limite
$espaciosActuales = $myEspacios->getEspaciosActuales(); //Creamos otro metodo que obtenga los espacios actuales.

//Validamos la capacidad del parking con los espacios actuales.
if ($espaciosActuales < $limite) {
    $creacionExitosa = $myEspacios->crearEspacio($space_number);
    header('Location: ../../../view/client/cajones.php?idParking='.$_SESSION['pk_parking']);
} else {
    $limite = 'No se puede crear un espacio. Ya has llegado al limite de la capacidad del Parking.';
    header('Location: ../../../view/client/cajones.php?idParking='.$_SESSION['pk_parking'].'&limite='.urlencode($limite).'');
}
