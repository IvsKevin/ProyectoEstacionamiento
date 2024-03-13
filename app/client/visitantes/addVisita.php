<?php
include(__DIR__.'/../../../data/class/visit.php');
include_once(__DIR__.'/../../../data/conexion.php');
include(__DIR__.'/../../../data/class/accesscard.php');

session_start();

$visit = new Visit();
$visit->setCompany($_POST['visit_company']);
$visit->setReason($_POST['visit_reason']);
$visit->setName($_POST['visit_name']);
$visit->setLastName($_POST['visit_lastName']);
$visit->setFkClient($_SESSION['client_id']);

$id = $visit->setVisit();

if ($id > 0) {
    function generateRandomCode($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[mt_rand(0, $max)];
        }

        return $code;
    }

    $QR_code = generateRandomCode();
    $creation_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($creation_date)));
    $conexion = new Conexion();
    $conexion->connect();

    $query_last_visit = "SELECT MAX(pk_visit) AS last_visit_id FROM Visit";
    $result_last_visit = $conexion->execquery($query_last_visit);

    if ($result_last_visit && mysqli_num_rows($result_last_visit) > 0) {
        $row_last_visit = mysqli_fetch_assoc($result_last_visit);
        $last_visit_id = $row_last_visit['last_visit_id'];

        $access_card = new AccessCard();
        $access_card->setQRCode($QR_code);
        $access_card->setCreationDate($creation_date);
        $access_card->setEndDate($end_date);
        $access_card->setCardType('Visitante');
        $access_card->setFKVisit($last_visit_id);
        
        $insert_success = $access_card->insertAccessCardForVisit($QR_code, $creation_date, $end_date, 'Visitante', $last_visit_id);

        if ($insert_success) {
            header('Location: ../../../view/client/visitantes.php');
            exit();
        } else {
            echo 'No se pudo generar la tarjeta de acceso para el visitante.';
        }
    } else {
        echo 'No se pudo obtener el último ID de visita insertado.';
    }
} else {
    echo 'No se ha podido registrar la visita.';
}