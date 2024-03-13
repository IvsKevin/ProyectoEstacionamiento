<?php
include_once(__DIR__.'/../../../data/class/visit.php');

$visit = new Visit();
$visit->setCompany($_POST["visit_company"]);
$visit->setReason($_POST["visit_reason"]);
$visit->setName($_POST["visit_name"]);
$visit->setLastName($_POST["visit_lastName"]);
$visit->setFkClient($_POST["fk_client"]);

// Verifica que todos los datos se hayan establecido correctamente antes de realizar la actualización
if ($visit->getCompany() && $visit->getReason() && $visit->getName() && $visit->getLastName() && $visit->getFkClient()) {
    $id = $visit->updateVisit();
    
    if ($id > 0) {
        header('Location: ../../../view/client/visitantes.php');
        exit();
    } else {
        echo "Error: No se pudo actualizar la visita.";
    }
} else {
    echo "Error: Datos incompletos para la actualización de la visita.";
}
?>
