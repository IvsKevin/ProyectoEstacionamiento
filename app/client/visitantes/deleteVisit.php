<?php 
    // Definimos nuestro carpeta principal.
    define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoEstacionamientos_3B/');
    define('PROJECT_URL_ROOT', '/ProyectoEstacionamientos_3B/');

    // Incluimos la clase empleado.
    include(PROJECT_ROOT . '/data/class/employee.php');
    include(PROJECT_ROOT . '/data/class/accesscard.php');

    // Creamos nuestro objeto
    $employee = new Employee();
    $employee->setID($_POST['id']);

    // Llamamos al método de eliminación del empleado y su tarjeta de acceso asociada
    $deleted = $employee->deleteEmployee();

    // Hacemos una validación rápida para saber si se ha ejecutado correctamente.
    if ($deleted) {
        header('Location: ' . PROJECT_URL_ROOT . 'view/client/empleados.php');
    } else {
        // Manejo del error
        echo "Hubo un problema al eliminar al empleado y su tarjeta de acceso asociada.";
    }
?>
