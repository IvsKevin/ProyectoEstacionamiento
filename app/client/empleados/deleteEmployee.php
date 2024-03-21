<?php
try {
    // Incluimos la clase empleado.
    include(__DIR__ . '/../../../data/class/employee.php');

    // Creamos nuestro objeto
    $employee = new Employee();
    $employee->setID($_POST['idEmpleado']);

    // Llamamos al método de eliminación del empleado y su tarjeta de acceso asociada
    $result = $employee->deleteEmployee();

    // Hacemos una validación rápida para saber si se ha ejecutado correctamente.
    if ($result != "error") {
        $result = "Se completado la elimacion del empleado y se ha desactivado su tarjeta de acceso...";
        // Construye la URL con los parámetros de la entrada
        $url = '../../../view/client/empleados.php?eliminacion=' . urlencode($result);
        header('Location: ' . $url);
    } else {
        // Manejo del error
        $result = "Hubo un problema al eliminar al empleado y su tarjeta de acceso asociada.";
        $url = '../../../view/client/empleados.php?eliminacion=' . urlencode($result);
        header('Location: ' . $url);
    }
} catch (\Throwable $th) {
    // Manejo del error
    $result = "Hubo un problema con el servidor.";
    $url = '../../../view/client/empleados.php?eliminacion=' . urlencode($result);
    header('Location: ' . $url);
}
