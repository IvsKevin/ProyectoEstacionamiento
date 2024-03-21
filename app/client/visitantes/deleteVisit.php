<?php
// Incluimos la clase empleado.
include(__DIR__ . '/../../../data/class/visit.php');

try {
    // Creamos nuestro objeto
    $visit = new Visit();
    $visit->setID($_POST['idVisitante']);

    // Llamamos al método de eliminación del empleado y su tarjeta de acceso asociada
    $result = $visit->deleteVisit();

    // Hacemos una validación rápida para saber si se ha ejecutado correctamente.
    if ($result != "error") {
        $result = "Se completado la elimacion de la visita y se ha desactivado su tarjeta de acceso...";
        // Construye la URL con los parámetros de la entrada
        $url = '../../../view/client/visitantes.php?resultado=' . urlencode($result);
        header('Location: ' . $url);
    } else {
        // Manejo del error
        $result = "Hubo un problema al eliminar a la visita y su tarjeta de acceso asociada.";
        $url = '../../../view/client/visitantes.php?resultado=' . urlencode($result);
        header('Location: ' . $url);
    }
} catch (\Throwable $th) {
    // Manejo del error
    $result = "Hubo un problema con el servidor.";
    $url = '../../../view/client/visitantes.php?resultado=' . urlencode($result);
    header('Location: ' . $url);
}
