
<?php

// Incluimos las clases necesarias
include(__DIR__ . '/../../../data/class/accesscard.php');
include(__DIR__ . '/../../../data/class/employee.php');
include_once(__DIR__ . '/../../../data/conexion.php');

session_start();

// Establecemos los valores de los setters para el nuevo empleado
$employee = new Employee();
$employee->setID($_POST['idEmpleado']);
$employee->setName($_POST["nombreEmpleado"]);
$employee->setLastNameP($_POST["apPaternoEmpleado"]);
$employee->setLastNameM($_POST["apMaternoEmpleado"]);
$employee->setRol($_POST["rolEmpleado"]);
$employee->setTel($_POST["tel"]);

//Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
$id = $employee->updateEmployee();

//Hacemos una validacion rapida para saber si se ha ejecutado correctamente.
if ($id > 0) {
    header('Location: ../../../view/client/empleados.php');
}
