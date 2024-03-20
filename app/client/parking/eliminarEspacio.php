<?php
// Incluimos la clase Espacios para crear el objeto.
session_start();
include(__DIR__ . '/../../../data/class/Espacios.php');

// Establecemos los valores de los setters.
try {
    $deleteSpace = new Espacios();
    $eliminacionExitosa = $deleteSpace->eliminarEspacio($_POST['idespacio']);
    if ($eliminacionExitosa > 0) {
        echo "Espacio eliminado exitosamente.";
        header('Location: ../../../view/client/cajones.php?idParking=' . $_SESSION['pk_parking']);
    }
} catch (\Throwable $e) {
    $errorElimiacion = 'No se puede eliminar un espacio que actualmente esta siendo ocupado.';
    header('Location: ../../../view/client/cajones.php?idParking=' . $_SESSION['pk_parking'] . '&errorEliminacion=' . urlencode($errorElimiacion) . '');
}
